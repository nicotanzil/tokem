<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/layouts/header.css">
    <link rel="stylesheet" href="/css/profile/profile.css">
    
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
  @include('layouts.header')
  <div class="container">
        <img src="assets/logo.png" alt="" class="logo-login">
        <h1>Your Profile</h1>
        <form action="/logout" method="post" class="main-form">
            @csrf
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="input-group">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="input-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" value="DUMMY PASSWORD" readonly>
            </div>
            <div class="input-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" cols="67" rows="3" readonly>{{ Auth::user()->address }}</textarea>
                <p>Please write your actual address where you can receive mail</p>
            </div>
            <div class="input-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ Auth::user()->phone }}" readonly>
            </div>
            <hr>
            <div class="input-group-split">
              <a href="/profile/detail" class="first-col">
                <input type="button" value="Update" class="btn-update-profile">
              </a>
              <a href="/logout" class="second-col">
                <input type="submit" value="Sign Out" class="btn-sign-out" class="second-col">
              </a>
            </div>
        </form>
    </div>
    <script>
      var msg = '{{ Session::get('successful_message') }}';
      var exist = '{{ Session::has('successful_message') }}';
      if(exist){
        alert(msg);
      }
    </script>
</body>
</html>

@include('layouts.footer')