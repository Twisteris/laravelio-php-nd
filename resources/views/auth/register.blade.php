@extends('layouts.app')

@section("content")
    <div>
        @if (session('status'))
            <div  class="status">
                {{ session('status') }}
            </div>
        @endif
        <div class="g78">
            <form class="g78form" action="{{route("register")}} " method="post">
                @csrf
                <div>
                    <label for="name" class="sr-only">Vardas</label>
                    <input type="text" name="name" id="name" placeholder="Jūsu vardas">

                    @error('name')
                    <div  class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <label for="email" class="sr-only">El. paštas</label>
                    <input type="text" name="email" id="email" placeholder="Jūsu El. paštas">

                    @error('email')
                    <div  class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <label for="password" class="sr-only">Slaptažodis</label>
                    <input type="password" name="password" id="password" placeholder="Jūsu Slaptažodis">

                    @error('password')
                    <div  class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Pakartokite slaptažodį">

                    @error('password_confirmation')
                    <div  class="error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <button class="specific-button" type="submit">Registruotis</button>
                </div>
            </form>
        </div>
    </div>
@endsection
