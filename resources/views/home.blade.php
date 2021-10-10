@extends('layouts.app')

@section("content")
    <div class="f54">
        @if($posts->count())
            @foreach($posts as $post)
                <div class="f55">
                    <h2>{{$post->title}}</h2>
                    <h4>{{$post->body}}</h4>
                    <form action="{{route("post", $post)}}" method="get" class="mr-1">
                        <button type="submit" class="specific-button" >Registracija į renginį</button>
                    </form>
                    <input name="date" id="date" type="date" class="form-control" placeholder="Date of birth" disabled="true" value="{{$post->date}}"/>
                </div>
            @endforeach
           <div class="f56"> {{$posts->links()}}</div>
        @else
            <p>Nėra jokiu renginių.</p>
        @endif
    </div>
@endsection
