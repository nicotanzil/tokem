<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/layouts/header.css">
    <link rel="stylesheet" href="/css/login/login.css">

     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    @include('layouts.header')
    <img src="assets/logo.png" alt="" class="logo-login">
    <h1>Sign in to your account</h1>
    @if (session()->has('success'))
        <p class="flash-message">{{ session('success') }}</p>
    @endif
    @if (session()->has('error-message'))
        <p class="error">{{ session('error-message') }}</p>
    @endif
    <div class="container">
        <form action="/login" method="post">
            @csrf
            <div class="input-group">
                <label for="email">Email address</label>
                <i class="fas fa-key icon"></i>
                <input type="email" id="email" name="email" value="{{ $email }}">
                @if ($errors->has('email'))
                    <p class="error-message">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <i class="fas fa-key icon"></i>
                <input type="password" name="password" id="password">
                @if ($errors->has('password'))
                    <p class="error-message">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="remember-email">
                <input type="checkbox" name="remember_email" id="remember_email">
                <label for="remember_email">Remember Email</label>
            </div>
            <div class="input-group">
                <input type="submit" value="Sign In" class="btn-sign-in">
            </div>
            <p><span>Or</span></p>
        </form>
        <a href="/register">
            <button class="btn-register">Register</button>
        </a>
    </div>

    <script>
        var msg = '{{ Session::get('cart_must_login') }}';
        var exist = '{{ Session::has('cart_must_login') }}';
        if(exist){
          alert(msg);
        }
    </script>
</body>
</html>

@include('layouts.footer')