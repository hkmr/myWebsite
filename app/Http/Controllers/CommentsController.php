<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Session;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostComment;

class CommentsController extends Controller
{

    public function __construct(){

        $this->middleware('auth', ['except' => 'store']);
    }


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request, $post_id)
    {
        // if Authenticated user
        if ( Auth::check() ) {
            $this->validate($request, array(
            'comment'   => 'required|min:2|max:2000'
            ));

            $post = Post::find($post_id);

            $comment = new Comment();
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->email = Auth::user()->email;
            $comment->comment = $request->comment;
            $comment->approved = true;
            $comment->post()->associate($post);

            $comment->save();

            // sending notification
            $user = User::where('id',$post->user_id)->first();

            if(Auth::id() != $post->user_id)
                $user->notify(new PostComment( Auth::user(), $post, $request->comment ));

        }
        // if Guest user
        else {
            $this->validate($request, array(
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'comment'   => 'required|min:2|max:2000'
            ));

            $post = Post::find($post_id);

            $comment = new Comment();
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->comment = $request->comment;
            $comment->approved = true;
            $comment->post()->associate($post);

            $comment->save();

            // $user = {'name': $request->name, 'email': $request->email};

            // $user->notify(new PostComment( $user, $post, $request->comment ));
        }  


        // displaying success message
        Session('success', 'Comment posted successfully!');

        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required'));

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Comment successfully updated!');

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function delete($id) 
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);
    }


    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();

        Session::flash('success', 'Comment deleted successfully!');

        return redirect()->route('posts.show', $post_id);
    }
}
