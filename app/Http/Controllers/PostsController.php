<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        return view("posts.index");
    }

    public function store(Request $request){
        $this->validate($request, [
            'title'=>'required',
            'body' => 'required',
            'date'=> 'required|date|date_format:Y-m-d|after:yesterday',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //get image name
        $imageName = time().'.'.$request->image->extension();
        //move image to public folder
        $request->image->move(public_path('images'), $imageName);

        $request->user()->posts()->create([
            'body' => $request->body,
            'title'=> $request->title,
            'date'=> $request->date,
            'image'=> $imageName
        ]);

        return back();
    }

    public function queryAllPosts(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return $posts;
        return $posts;
    }
    public static function queryAllGuests(){
        $guests = Guest::get();
        return $guests;
    }
}
