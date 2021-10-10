<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nd</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        *{margin: 0;padding: 0; box-sizing: border-box;}
        body{height: 100vh}

        .h458 {background-color: #272727; width: 100vw; height: 7vh; margin-left:auto; margin-right:auto; display: flex;}
        .h458 .g59d a {color: #EFF6EE; font-size: 1.4rem;}
        .h458 .g59d {width: 60%; display: flex; justify-content: space-evenly; align-items: center}

        .h458 .g8c2 a {color: #EFF6EE; font-size: 1.8rem; padding: 5px}
        .h458 .g8c2 {width: 25%; display: flex; justify-content: space-around; align-items: center}

        .h458 .g8c2 .logoutBtn {background-color:#EFF6EE; color: #272727; font-size: 1.2rem; font-weight: 600; padding: 3px; border: none; border-radius: 3px}
        .h458 .g8c2 p {color: #EFF6EE; font-size: 1.5rem; margin-top: 13px}

        .latest-image {  height: 90%; width: 90%}

        .g52dd h2,h4 {color: #272727;}
        .g52dd form button{color: #CDD6D7; font-size: 1.7rem; border: none;text-decoration: underline; background-color: transparent}
        .g52dd input {width: 180px; text-align: center; margin-left: auto; margin-right: auto;}


        .a11 {margin-left: auto;margin-right: auto;width: 90vw; height: 90vh; display: flex;flex-direction: column; justify-content: center; margin-top: 20px}
        .a12 {width: 100%; height: 100%; display:flex; justify-content: center; align-items: start; margin: 5px}
        .a13 { width: 100%; display: flex; flex-direction: column; justify-content: center; align-items:center}
        .a14 {background-color: transparent; color: #272727; font-size: 1.4rem; font-weight: 700; padding: 2px; border: 2px solid #272727; border-radius: 3px}
        .a15 {overflow-y: scroll; height: 120px}
        .a16{height: 200px;width: 200px;}

        .g78{display: flex;justify-content: center;align-items: center;height: 100%; margin-top: 120px;}
        .g78form {height: 250px;width:300px;display: flex;flex-direction: column;justify-content: space-around;align-items: center;}
        .g78form_2 {height: 350px;width:300px;display: flex;flex-direction: column;justify-content: space-around;align-items: center;}
        .g78 button {background-color: transparent; color: #272727; font-size: 1.2rem; font-weight: 600; padding: 3px; border: 1px solid black; border-radius: 3px}

        .errorG5{color: red;max-width: 180px;}
        .status{color:red; font-size: 2rem; margin-left:auto; margin-right: auto}
        .o13{display: flex;}
        .o3{color: red; margin-left: 10px}

        .h89 {margin-left: auto;margin-right: auto;width: 90vw; height: 90vh; display: flex;flex-direction: column; justify-content: center; align-items: center}
        .h69 { width: 400px; text-align: center}
        .h-image{ height: 120px}
        .h69 button {background-color: transparent; color: #272727; font-size: 1.2rem; font-weight: 600; padding: 3px; border: 1px solid black; border-radius: 3px; margin: 3px}

        .f54{width: 90vw; margin-left: auto; margin-right: auto; display: flex; justify-content: space-around; margin-top: 30px}
        .f54 button {background-color: transparent; color: #272727; font-size: 0.8rem; font-weight: 600; padding: 1px; border: 1px solid black; border-radius: 3px}
        .f55 {display:flex;flex-direction:column; justify-content: space-around; text-align: center; width: 250px; height: 300px; margin-top: 90px;  overflow: hidden;}
        .f56 {  position: absolute;
            left: 50%;
            bottom: 20%;
            transform: translate(-50%, -50%);
        }

        .g28 { display: flex; flex-direction: column; justify-content: space-between; align-items: center; height: 350px}
        .g28 button {background-color: transparent; color: #272727; font-size: 1.2rem; font-weight: 600; padding: 3px; border: 1px solid black; border-radius: 3px}

    </style>
</head>
<body class="bg-gray-200">
<div class="h458">
  <div class="g59d">
      <a  href="{{route("home")}}">Pagrindinis</a>
      <a  href="{{route("posts")}}">Sukurti projekta</a>
  </div>

    <div class="g8c2">
        @auth
            <p>{{ auth()->user()->name }}</p>
            <form action="{{route("logout")}}" method="post" class="p-3 inline">
                @csrf
                <button class="logoutBtn" type="submit">Atsijungti</button>
            </form>
        @endauth

        @guest
            <a href="{{route("register")}}">Registruotis</a>
             <a href="{{route("login")}}">Prisijungti</a>
        @endguest
    </div>
</div>
@yield('content')
</body>
</html>
