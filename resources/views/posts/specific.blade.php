@extends('layouts.app')

@section("content")
    <div class="h89">
           <div class="h69">
               <img class="h-image" src="{{asset('/images/'.$post->image)}}" alt="event image">
               <h4>Renginys: {{$post->title}}</h4>
               <h4>Aprasymas: {{$post->body}}</h4>
               @auth
                   @if(Auth()->User()->id === $post->user_id)
                       <form action="{{route("post.destroy", $post)}}" method="post">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="text-red-500">Istrinti</button>
                       </form>
                       <form action="{{route("post.update", $post)}}" method="get">
                           <button type="submit" class="o3">Atnaujinti</button>
                       </form>
                   @endauth
               @endauth

               <h4>Dalivaujantys:</h4>
               <div class="a15">
                   @foreach($guests as $guest)
                       <div class="o13">
                           <h2> {{$guest->name}}</h2>
                           <form action="{{route("post.destroy.guest", [$guest, $post])}}" method="post" class="mr-1">
                               @csrf
                               @method('DELETE')
                               @auth
                                   <button type="submit" class="o3">Ismesti</button>
                               @endauth
                           </form>
                       </div>
                   @endforeach
           </div>
               @guest
                   <div class="h69">

                       <form class="specific-form" action="{{route("post.create", $post)}}" method="post">
                           @csrf
                           <div class="mb-4">
                               <label for="body" class="sr-only">vardas</label>
                               <textarea name="name" id="name" cols="30" rows="1" placeholder="Įveiskite vardą"></textarea>

                               @error('name')
                               <div class="text-red-500 mt-2 text-sm">
                                   {{ $message }}
                               </div>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="body" class="sr-only">el pastas</label>
                               <textarea name="email" id="email" cols="30" rows="4" placeholder="Įveskite el paštą"></textarea>

                               @error('email')
                               <div class="text-red-500 mt-2 text-sm">
                                   {{ $message }}
                               </div>
                               @enderror
                           </div>

                           <div class="mb-4">
                               <label for="body" class="sr-only">telf</label>
                               <textarea name="phone_number" id="phone_number" cols="30" rows="4" placeholder="Įveskite telf nmr"></textarea>

                               @error('phone_number')
                               <div class="text-red-500 mt-2 text-sm">
                                   {{ $message }}
                               </div>
                               @enderror
                           </div>

                           <div>
                               <button class="specific-button" type="submit">Registruotis į renginį</button>
                           </div>
                       </form>
                   </div>
               @endguest

        @if (session('status'))
            <div class="error">
                {{ session('status') }}
            </div>
        @endif

    </div>
@endsection
