<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        return view("auth.login");
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where("email", "=", $request->email)->first();
        if($user->is_verified === 0){
            return back()->with('status', 'Invalid login details');
        }

        if(!auth()->attempt($request->only("email", "password"), $request->remember)){
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('home');

    }

    public function credentials($request){
        return array_merge($request->only($this->name(), 'password'), ["is_verified"=> 1]);
    }
}

