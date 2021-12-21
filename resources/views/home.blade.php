@extends('layouts.index')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="/css/home.css">
@endsection

@section('content')
<div class="home">
  <div class="section-1">
    <div class="title">
      <span>Level Up Your</span> 
      <span>Planting Game</span>
    </div>
  </div>
  <div class="section-2">
    <img src="assets/home-bg.jpeg" alt="Home Background" class="home-bg">
  </div>
  <hr class="home-divider">
  <div class="section-3">
    <div class="title">
      <div class="main">One-stop boutique for all your home and office gardening needs</div>
      <div class="description">We provide wide variety of plants and gardening service</div>
    </div>
    <div class="part-1">
      <div class="story">
        <div class="title">Be a plant parent now!</div>
        <div class="description">
          Beautify your surroundings by adding a touch of live plant. 
          We provide any plant to suits your environment, plant-medium,
          and we will guide you through every stop in becoming plant parent.
        </div>
      </div>
      <img src="assets/home-plant-1.webp" alt="Plant">
    </div>
    <div class="part-2">
      <img src="assets/home-plant-2.webp" alt="Plant">
      <div class="story">
        <div class="title">Professional plant care</div>
        <div class="description">
          Make a great working environment by having plants around 
          to provide fresh air and joyous feelings. We will take care
          for everything in your office from installation to maintenance.
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var msg = '{{ Session::get('transaction_success') }}';
  var exist = '{{ Session::has('transaction_success') }}';
  if(exist){
    alert(msg);
    console.log('testing')
  }
</script>

@endsection