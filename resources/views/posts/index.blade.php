
@extends('layouts.app')

@section('content')
    <div class="h89">
        <div class="auth_form_post">
            @auth
                <form class="g28" action="{{ route('posts') }}" method="post" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="body" class="sr-only">pavadinimas</label>
                        <textarea name="title" id="title" cols="30" rows="1" placeholder="Pavadinimas"></textarea>

                        @error('body')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="sr-only">aprasymas</label>
                        <textarea name="body" id="body" cols="30" rows="4" placeholder="Įrašykite renginio aprašymą"></textarea>

                        @error('body')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <input min="2000-01-01" max="2030-12-31" name="date" id="date" type="date"  placeholder=""/>
                    </div>

                    <div>
                        <div>
                            <input type="file" name="image" class="form-control">
                        </div>
                        @error('image')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <button class="specific-button" type="submit">Sukūrti renginį</button>
                    </div>
                </form>
            @endauth


        </div>
    </div>
@endsection
