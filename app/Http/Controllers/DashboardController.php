<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Image;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts);
    }
    public function updateAvatar(Request $request){
      if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . ".jpg";
        Image::make($avatar)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
      }
      return view('welcome', array('user'=> Auth::user()));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'title' => 'required',
          'body' => 'required',
          'tag' => 'required',
          'insta' => 'required',
          'linked' => 'required',
          'twitter' => 'required',
          'fb' => 'required'
        ]);
        $post = Auth::user();
        $post->title = $request->input('title');
        $post->bio = $request->input('body');
        $post->tags = $request->input('tag');
        $post->instagram = $request->input('insta');
        $post->twitter = $request->input('twitter');
        $post->linkedin = $request->input('linked');
        $post->facebook = $request->input('fb');
        $post->save();

        return view('welcome', array('user'=> Auth::user()));
    }
}
