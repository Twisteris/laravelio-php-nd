<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        return view("auth.register");
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        //store user
       $user = User::create([
           'name'=>$request->name,
           'email'=> $request->email,
           'password'=> Hash::make($request->password),
           'verification_code' => Hash::make(time()),
       ]);

       MailController::sendRegisterEmail($user->name, $user->email, $user->verification_code);

       if($user != null){
           //sign in the user
           //auth()->attempt($request->only('email', 'password'));
           //redirect
           return back()->with('status', 'Please check your email for verification.');
       }
    }

    public function verifyUser(Request $request){
            $verification_code = \Illuminate\Support\Facades\Request::get('code');
            $user = User::where(['verification_code' => $verification_code])->first();
            if($user != null){
                $user->is_verified = 1;
                $user->save();
                return redirect()->route("home")->with('status', 'Your account is verified. Please login!');
            }
        return redirect()->route("home")->with('status', 'Invalid registration code');

    }
}
