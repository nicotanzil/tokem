<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/layouts/header.css">
    <link rel="stylesheet" href="/css/register/register.css">

     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    @include('layouts.header')
    <div class="container">
        <img src="assets/logo.png" alt="" class="logo-login">
        <h1>Create your account</h1>
        <form action="/register" method="post">
            @csrf
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
                @if ($errors->has('name'))
                    <p class="error-message">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="input-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email">
                @if ($errors->has('email'))
                    <p class="error-message">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="input-group-split">
                <div class="first-col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="second-col">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                </div>
            </div>
            @if($errors->has('password'))
                <p class="error-message">{{ $errors->first('password') }}</p>
            @endif
            <div class="input-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" cols="67" rows="3"></textarea>
                @if ($errors->has('address'))
                    <p class="error-message">{{ $errors->first('address') }}</p>
                @endif
                <p>Please write your actual address where you can receive mail</p>
            </div>
            <div class="input-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone">
                @if ($errors->has('phone'))
                    <p class="error-message">{{ $errors->first('phone') }}</p>
                @endif
            </div>
            <hr>
            <div class="input-group">
                <input type="submit" value="Create Account" class="btn-create-account">
            </div>
        </form>
    </div>
</body>
</html>

@include('layouts.footer')