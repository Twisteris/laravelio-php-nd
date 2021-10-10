
@extends('layouts.app')

@section('content')
    <div>
        <div class="g78">
            @auth
                <form action="{{route("post.update", $post)}}" method="post" class="g78form_2" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="body" class="sr-only">title</label>
                        <textarea name="title" id="title" cols="30" rows="1" placeholder="Įveskite pavadinima">{{$post->title}}</textarea>

                        @error('body')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" placeholder="Įveskite aprašymą">{{$post->body}}</textarea>

                        @error('body')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <input min="2000-01-01" max="2030-12-31" name="date" id="date" type="date" value="{{$post->date}}" placeholder=""/>
                    </div>

                    <div>
                        <div>
                            <input type="file" name="image">
                        </div>
                        @error('image')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <button class="specific-button" type="submit">Atnaujinti</button>
                    </div>
                </form>
            @endauth


        </div>
    </div>
@endsection
