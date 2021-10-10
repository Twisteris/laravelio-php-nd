@extends('layouts.app')

@section('content')
    <div>
        <div>
            @if (session('status'))
                <div  class="status">
                    {{ session('status') }}
                </div>
            @endif
                <div class="g78">
                    <form action="{{route("login")}}" class="g78form" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="sr-only">El. Paštas</label>
                            <input type="text" name="email" id="email" placeholder="Jūsu El. Paštas">

                            @error('email')
                            <div  class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="sr-only">Slaptažodis</label>
                            <input type="password" name="password" id="password" placeholder="Jūsų slaptažodis">

                            @error('password')
                            <div class="error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember" class="mr-2">
                                <label for="remember">Prisiminti mane</label>
                            </div>
                        </div>

                        <div>
                            <button class="specific-button" type="submit">Prisijungti</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
@endsection
