<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\UserAchievement;
use Session;
use Purifier;
use Image;
use Storage;
use App\Category;
use App\UserSetting;


class ProfileController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }

    public function index(){

		return view('user.profile');
	}

	public function show($id) {


        $user = User::where('username',$id)->first();

		$posts =Post::where([['user_id',$user->id],['status',1]])->orderBy('views','desc')->paginate(10);
        $allPosts = Post::where([['user_id',$user->id],['status',1]])->get();
        $total_view = 0;
        $total_likes = 0;
        foreach ($allPosts as $post) {
            $total_view+=$post->views;
            $total_likes+=$post->likes;
        }

        // converting views to short form
        if($total_likes >=1000 && $total_likes <1000000)
            {
                $show = round(($total_likes/1000),1).'k';
                $total_likes = $show;
            }
        else if( $total_likes >= 1000000 && $total_likes <100000000 )
            {
                $show = round(($total_likes/1000000),1).'M';
                $total_likes = $show;
            }
        // converting likes to short form
        if($total_view >=1000 && $total_view <1000000)
            {
                $show = round(($total_view/1000),1).'k';
                $total_view = $show;
            }
        else if( $total_view >= 1000000 && $total_view <100000000 )
            {
                $show = round(($total_view/1000000),1).'M';
                $total_view = $show;
            }
        // Creating user setting table if not present
        if ( UserSetting::where('user_id',$user->id)->first() == null) {
                $user_setting = new UserSetting;
                $user_setting ->user_id = $user->id;
                $user_setting ->show_social_links = 'on';
                $user_setting ->show_email_id = 'on';
                $user_setting->save(); 
            }

        // $this->userAchievement($user->id);

        // $badgeList = [];
        // $list = UserAchievement::where('user_id',$user->id)->first();

        // if($list->views_10m)
        //     array_push($badgeList,'badge_1k_views.png','badge_10k_views.png','badge_100k_views.png','badge_500k_views.png','badge_1m_views.png','badge_10m_views');
        // else if($list->views_1m)
        //     array_push($badgeList,'badge_1k_views.png','badge_10k_views.png','badge_100k_views.png','badge_500k_views.png','badge_1m_views.png');
        // elseif ($list->views_500k)
        //     array_push($badgeList,'badge_1k_views.png','badge_10k_views.png','badge_100k_views.png','badge_500k_views.png');
        // else if($list->views_100k)
        //     array_push($badgeList,'badge_1k_views.png','badge_10k_views.png','badge_100k_views.png');
        // else if($list->views_10k)
        //     array_push($badgeList,'badge_1k_views.png','badge_10k_views.png');
        // else if($list->views_1k)
        //     array_push($badgeList,'badge_1k_views.png');  

        // if($list->likes_1m)
        //     array_push($badgeList,'badge_1k_likes.png','badge_10k_likes.png','badge_100k_likes.png','badge_500k_likes.png','badge_1m_likes.png','badge_10m_likes');
        // else if($list->likes_500k)
        //     array_push($badgeList,'badge_1k_likes.png','badge_10k_likes.png','badge_100k_likes.png','badge_500k_likes.png','badge_1m_likes.png');
        // elseif ($list->likes_100k)
        //     array_push($badgeList,'badge_1k_likes.png','badge_10k_likes.png','badge_100k_likes.png','badge_500k_likes.png');
        // else if($list->likes_10k)
        //     array_push($badgeList,'badge_1k_likes.png','badge_10k_likes.png','badge_100k_likes.png');
        // else if($list->likes_1k)
        //     array_push($badgeList,'badge_1k_likes.png','badge_10k_likes.png');
        // else if($list->likes_100)
        //     array_push($badgeList,'badge_1k_likes.png');

        // if($list->bookmarks_10m)
        //     array_push($badgeList,'badge_1k_bookmarks.png','badge_10k_bookmarks.png','badge_100k_bookmarks.png','badge_500k_bookmarks.png','badge_1m_bookmarks.png','badge_10m_bookmarks');
        // else if($list->bookmarks_1m)
        //     array_push($badgeList,'badge_1k_bookmarks.png','badge_10k_bookmarks.png','badge_100k_bookmarks.png','badge_500k_bookmarks.png','badge_1m_bookmarks.png');
        // elseif ($list->bookmarks_500k)
        //     array_push($badgeList,'badge_1k_bookmarks.png','badge_10k_bookmarks.png','badge_100k_bookmarks.png','badge_500k_bookmarks.png');
        // else if($list->bookmarks_100k)
        //     array_push($badgeList,'badge_1k_bookmarks.png','badge_10k_bookmarks.png','badge_100k_bookmarks.png');
        // else if($list->bookmarks_10k)
        //     array_push($badgeList,'badge_1k_bookmarks.png','badge_10k_bookmarks.png');
        // else if($list->bookmarks_1k)
        //     array_push($badgeList,'badge_1k_bookmarks.png'); 


        return view('user.show',compact('user', 'posts', 'total_view', 'total_likes'));

	}

    // user achievement 

    public function userAchievement($id)
    {
        $user = User::find($id);
        $posts =Post::where([['user_id',$user->id],['status',1]])->orderBy('views','desc')->paginate(10);
        $user_achieve = UserAchievement::where('user_id',$id)->first() ;

        if($user_achieve == null)
        {
            $create_user_achieve = new UserAchievement;
            $create_user_achieve->user_id = $id;
            $create_user_achieve->save();
        }

        $total_view = 0;
        $total_likes = 0;
        $total_bookmarks = 0;
        foreach ($posts as $post) {
            $total_view+=$post->views;
            $total_likes += $post->likes;
            $total_bookmarks += $post->bookmarks;
        }

        // views achievement
        if($total_view >= 1000)
        {
            if($user_achieve->views_1k == false)
                $user_achieve->views_1k = true;
            if($total_view >= 10000)
            {
                if($user_achieve->views_10k == false)
                    $user_achieve->views_10k = true;

                if($total_view >= 100000)
                {
                    if($user_achieve->views_100k == false)
                        $user_achieve->views_100k = true;

                    if($total_view >= 500000)
                    {
                        if($user_achieve->views_500k == false)
                            $user_achieve->views_500k = true;

                        if($total_view >= 1000000)
                        {
                            if($user_achieve->views_1m == false)
                                $user_achieve->views_1m = true;

                            if($total_view >= 10000000)
                            {
                                if($user_achieve->views_10m == false)
                                    $user_achieve->views_10m =true;
                            }
                        }
                    }
                }
            }
        }

        // likes achievement
        if($total_likes >=100)
        {
            if($user_achieve->likes_100 == false)
                $user_achieve->likes_100 = true;
            if($total_likes >=1000)
            {
                if($user_achieve->likes_1k == false)
                    $user_achieve->likes_1k = true;
                if($total_likes >= 10000)
                {
                    if($user_achieve->likes_10k == false)
                        $user_achieve->likes_10k = true;
                    if($total_likes >= 100000)
                    {
                        if($user_achieve->likes_100k == false)
                            $user_achieve->likes_100k = true;
                        if($total_likes >= 500000)
                        {
                            if($user_achieve->likes_500k == false)
                                $user_achieve->likes_500k = true;
                            if($total_likes >= 1000000)
                            {
                                if($user_achieve->likes_1m == false)
                                    $user_achieve->likes_1m = true;
                            }
                        }
                    }
                }
            }
        }

        // bookmarks achievement
        if($total_bookmarks >=1000)
        {
            if($user_achieve->bookmarks_1k == false)
                $user_achieve->bookmarks_1k = true;
            if($total_bookmarks >= 10000)
            {
                if($user_achieve->bookmarks_10k == false)
                    $user_achieve->bookmarks_10k = true;
                if($total_bookmarks >= 100000)
                {
                    if($user_achieve->bookmarks_100k == false)
                        $user_achieve->bookmarks_100k = true;
                    if($total_bookmarks >= 500000)
                    {
                        if($user_achieve->bookmarks_500k == false)
                            $user_achieve->bookmarks_500k = true;
                        if($total_bookmarks >= 1000000)
                        {
                            if($user_achieve->bookmarks_1m == false)
                                $user_achieve->bookmarks_1m = true;
                            if($total_bookmarks >= 10000000)
                                if($user_achieve->bookmarks_10m == false)
                                    $user_achieve->bookmarks_10m = true;
                        }
                    }
                }
            }
        }

        $user_achieve->save();

    }

	public function edit($id) {

		$user =User::where('username',$id)->first();

		if (Auth::user()->username == $id ) {
			return view('user.edit',compact('user'));
		}
		else{
            Session::flash('success', '!! Unauthorized User !!');
			return redirect('/');
		}
		

	}

	public function update(Request $request, $id) {

		$user = User::where('username',$id)->first();

		//validating the data 
            $this -> validate($request, array(
                'info' => 'required',
                'avatar' => 'sometimes|image|max:2400',
                'coverImage' => 'sometimes|image|max:2400',
                // 'facebook' => 'sometimes|min:7',
                // 'twitter' => 'sometimes|min:7',
                // 'instagram' => 'sometimes|min:7',
                // 'tumblr' => 'sometimes|min:7',
                // 'youtube' => 'sometimes|min:7',
            ));

        //saving the data to the database

        $user->info =  $request->info;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->tumblr = $request->tumblr;
        $user->youtube = $request->youtube;

         // saving images
        if($request->hasFile('avatar') ) {
            // getting image file name
            $avatarImage =$request->file('avatar');
            // setting image file name with time
            $avatarFileName = time(). '.' .$avatarImage->getClientOriginalExtension();
            // setting location for image for saving
            $avatarLocation =public_path('images/user-profile/'. $avatarFileName);
            // resizing image and saving to location
            Image::make($avatarImage)->resize(200,200)->save($avatarLocation);
            // getting old image file name
            $oldAvatar = $user->avatar;
            //update the database
            $user->avatar = $avatarFileName;
            //delete the old image
            if($oldAvatar != 'default-avatar.jpg'){
                Storage::delete('user-profile/'.$oldAvatar);
            }
            
        }

        if ($request->hasFile('coverImage') ) {
            $coverImage = $request->file('coverImage');

            $coverImageFileName = time() . '.' .$coverImage->getClientOriginalExtension();

            $coverImageLocation = public_path('images/user-cover/'.$coverImageFileName);

            Image::make($coverImage)->resize(400,400)->save($coverImageLocation);

            $oldCover = $user->coverImage;

            $user->coverImage = $coverImageFileName;

            if ($oldCover != 'defaultProfileCoverImage.jpg') {
                Storage::delete('user-cover/'.$oldCover);
            }
        }
        
        $user->save();

        Session::flash('success', 'Successfully Saved !');

        return redirect()-> route('profile.show', $user->username);
	}	

}