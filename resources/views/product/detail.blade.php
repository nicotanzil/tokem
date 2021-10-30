@extends('layouts.index')

@section('title', 'Add Product')

@section('css')
<link rel="stylesheet" href="/css/product/detail.css">
@endsection

@section('content')
<div class="detail">
  <div class="container">
    <div class="left-container">
      <img src="{{Storage::url($product->image)}}" alt="Product">
    </div>
    <div class="right-container">
      <div class="name">{{$product->name}}</div>
      <div class="description">{{$product->description}}</div>
      <div class="quantity">Stock: {{$product->quantity}}</div>
      <div class="category">Category: {{$product->category->name}}</div>
      @if (Auth::check() && Auth::user()->role == 'member')
      <form action="/add-cart" method="post" class="input-form">
        @csrf
        <input type="number" name="quantity" id="quantity" class="input-quantity">
        <input type="hidden" name="productId" value="{{$product->id}}">
        <input type="submit" value="Add to Cart" class="submit">
      </form>
      @endif
    </div>
  </div>
</div>
@endsection