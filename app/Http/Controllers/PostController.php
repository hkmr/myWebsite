<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Category;
use Purifier;
use Image;
use Storage;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use App\Notifications\PostLike;
use App\Notifications\PostBookmark;


class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        //excrating all the posts from database and stroing into variable
        $posts = Post::orderBy('id','desc')->where('user_id',Auth::user()->id)->paginate(10);
        $populars = Post::orderBy('views', 'desc')->paginate(5);
        $categories = Category::orderBy('created_at','desc')->take(4)->get();
        $user = User::all();

        //returning a view and passing it to the variable
        return view('posts.index')->withPosts($posts)->withPopulars($populars)->withCategories($categories)->withUser($user);
    }


    // favorite posts
    public function favoritePost(Post $post)
    {
        Auth::user()->favorites()->attach($post->id);

        $post->increment('likes');

        $user = User::where('id',$post->user_id)->first();
        if(Auth::id() != $user->id)
        {
            $user->notify(new PostLike( Auth::user(), $post ));
        }

        return back();
    }

    // unfavorite posts
    public function unFavoritePost(Post $post)
    {
        Auth::user()->favorites()->detach($post->id);
        $post->decrement('likes');
        return back();
    }

    // Bookmark posts
    public function bookmarkPost(Post $post)
    {
        Auth::user()->bookmarks()->attach($post->id);

        $post->increment('bookmarks');

        $user = User::where('id',$post->user_id)->first();

        $user->notify(new PostBookmark( Auth::user(), $post ));

        return back();
    }
    // unbookmark posts
    public function unBookmarkPost(Post $post)
    {
        Auth::user()->bookmarks()->detach($post->id);
        $post->decrement('bookmarks');
        return back();
    }

    // creating new post
    public function create()
    {
        $categories = Category::all();

        return view('posts.create')->withCategories($categories);
    }

    // storing post request
    public function store(Request $request)
    {   
        // validating the form data before storing into database

        $this -> validate($request, array(
                'status'        =>  'required',
                'title'         =>  'required|max:255|unique:posts,title',
                // 'slug'          =>  'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'   =>  'required|integer',
                'body'          =>  'required',
                'featured_image'=>  'sometimes|image|max:1012'
            ));

        //Storing the data to the database

        $post = new Post;
        $replace =array(" ","?","/","[","]","<",">","{","}","|","^","`",";",":","@","&","=","+","$",",","'",".");
        $slug = str_ireplace($replace , "-", $request->title);

        $post ->status          =$request->status;
        $post -> title          =$request->title;
        $post -> slug           =$slug;
        $post -> category_id    =$request->category_id;        
        $post -> user_id        =auth()->user()->id;
        $post -> body           =Purifier::clean($request->body);

        // saving images
        if($request->hasFile('featured_image')) {

            $image =$request->file('featured_image');
            $fileName = time(). '.' .$image->getClientOriginalExtension();
            $location =public_path('images/blog/'. $fileName);
            Image::make($image)->resize(800,400)->save($location);

            $post->image = $fileName;
        }

        Category::where('id', $request->category_id)->increment('total_posts');
        
        $post ->save(); //for saving the items

        if ($request->status == 1) {
            Session::flash('success' , 'Story published !');
        }
        else{
            Session::flash('success', 'Story saved');
        }

        //after submiting redirect to show

        return redirect()->route('posts.show', $post->id);

    }

    // showing single post
    public function show($id)
    {   
        $post = Post::find($id);
        $comments = Comment::where('post_id' , $post->id)->get();
        $agent = new Agent();

        if ($post->user_id == Auth::user()->id) {

            return view('posts.show' , compact('post', 'comments','agent'));
        }
        else {

            return redirect('/');
        }

         //finding post using post id
        
    }

    // edit post
    public function edit($id)
    {
        //storing the post into the variable
        $post = Post::find($id);    

        if ($post->user_id == Auth::user()->id) {
            
            $categories = Category::all();
            $cats =array();

            foreach ($categories as $category) {
                $cats[$category->id] = $category->name;
            }


            //returing the view
            return view('posts.edit')->withPost($post)->withCategories($cats);

        }
        else {
            return redirect('/');
        }
    }

    // update post after edit
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

            //validating the data 
            $this -> validate($request, array(
                'status' => 'required',
                'title' => 'required|max:255',
                // 'slug' =>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
                'category_id' => 'required|integer',
                'body' => 'required',
                'featured_image' => 'image|max:1000'
            ));

        $replace =array(" ","?","/","[","]","<",">","{","}","|","^","`",";",":","@","&","=","+","$",",","'",".");
        $slug = str_ireplace($replace , "-", $request->title);
        //saving the data to the database

        $post->status = $request->status;
        $post->title = $request->input('title');
        $post->slug =$slug;
        $post->category_id =$request->input('category_id');
        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasFile('featured_image')) {
            //adding new photo
            $image =$request->file('featured_image');
            $fileName = time(). '.' .$image->getClientOriginalExtension();
            $location =public_path('images/blog/'. $fileName);
            Image::make($image)->resize(800,400)->save($location);
            $oldFileName =$post->image;

            // update the database
            $post->image = $fileName; 

            // delete the old fileName
            Storage::delete('images/blog/'.$oldFileName);
        }

        $post->save();     

        //setting flash massage to display success Msg
        Session::flash('success', 'Successfully Saved !');

        //redirect with flash msg to show the post
        return redirect()-> route('posts.show', $post->id);

    }

    // deleting posts
    public function destroy($id)
    {
        
        //deleting the post
        $post = Post::find($id);
        
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post has been Successfully deleted');

        return redirect()-> route('posts.index');
    }
}
