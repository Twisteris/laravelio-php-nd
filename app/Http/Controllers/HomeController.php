<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends PostsController
{
    public function index(){
        $posts = PostsController::queryAllPosts();
        $guests = PostsController::queryAllGuests();
        return view("home", [
            'posts'=>$posts,
            'guests'=>$guests,
        ]);
    }
}
