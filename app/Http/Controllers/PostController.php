<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post){
        $guests = array();
        $all_guests =unserialize($post->guest_id);
        if($all_guests){
            foreach($all_guests as $guestId){
                $guestInfo = Guest::where('id',"=", $guestId)->first();
                array_push($guests, $guestInfo);
            }
        }

        //dd($guests);

        return view('posts.specific', [
            'post'=>$post,
            'guests'=>$guests,
        ]);
    }

    public function store(Request $request, Post $post){


        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|max:10',
        ]);

        //dd($post->title);

        //get all guests from post, if entered email exists in the guest array, we notify that the user has already registered for the event
        $all_guests =unserialize($post->guest_id);

        if($all_guests){
            foreach($all_guests as $guestId){
                $guestInfo = Guest::where('id',"=", $guestId)->first();
                if($guestInfo->email === $request->email){
                    return back()->with('status', 'Guest with this email is already attending current event.');
                }
            }
        }

        $guests = Guest::get();
        $guest = null;
        $alreadyExists = false;
        foreach($guests as $_guest){
            if($_guest->email === $request->email){
                $alreadyExists = true;
                if($_guest->name !== $request->name){
                    return back()->with('status', 'Guest with this email is already registered under a different name.');
                }

                if($_guest->phone_number !== $request->phone_number){
                    return back()->with('status', 'Guest with this email is already registered under a different phone number.');
                }

                $guest = Guest::where('email',"=", $request->email)->first();
                break;
            }
        }

        if($alreadyExists === false){
            //dd("USER DOESN'T EXIST");
            $guest = Guest::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'phone_number'=> $request->phone_number,
            ]);
        }

        if($all_guests){
            //if someone is attending the event
            array_push($all_guests, $guest->id);
            $serialized_all_guests = serialize($all_guests);
            $post->guest_id = $serialized_all_guests;
            $post->save();
        }else{
            //if noone is attending the event
            $all_guests = array($guest->id);
            $serialized_all_guests = serialize($all_guests);
            $post->guest_id = $serialized_all_guests;
            $post->save();
        }

        return redirect()->route("home");
    }

    public function destroy(Post $post){
        if(!auth()->user()){
            return redirect()->route("login");
        }
        if(!$post->ownedBy(auth()->user())){
            return redirect()->route("home");
        }
        $post->delete();
        return redirect()->route("home");
    }

    public function removeGuest(Guest $guest, Post $post){
        if(!auth()->user()){
            return redirect()->route("login");
        }

        if(!$post->ownedBy(auth()->user())){
            return back()->with('status', "You cannot kick guest in other people's events");
        }

        $all_guests =unserialize($post->guest_id);

        if (($key = array_search($guest->id, $all_guests)) !== false) {
            unset($all_guests[$key]);
        }

        $serialized_all_guests = serialize($all_guests);
        $post->guest_id = $serialized_all_guests;
        $post->save();
        return back();
    }

    public function updateView(Post $post){
        //dd($post->id);
        return view('posts.update', [
            'post'=>$post,
        ]);
    }

    public function update(Request $request, Post $post){

        if(!auth()->user()){
            return redirect()->route("login");
        }

        if(!$post->ownedBy(auth()->user())){
            return redirect()->route("home");
        }


        $this->validate($request, [
            'body' => 'required',
            'title'=>'required',
            'date'=> 'required|date|date_format:Y-m-d|after:yesterday',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->date = $request->date;
        $post->image = $imageName;
        $post->save();
        return redirect()->route("home");
    }
}
