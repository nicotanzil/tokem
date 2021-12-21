@extends('layouts.index')

@section('title', 'Checkout')

@section('css')
<link rel="stylesheet" href="/css/checkout/checkout.css">
@endsection

@section('content')

<div class="checkout">
  <div class="container">
    <div class="upper-section">
      <div class="title">Your Cart</div>
        <div class="content">
          <ul class="responsive-table">
            <li class="table-header">
              <div class="col col-1 product">Product</div>
              <div class="col col-2">Price</div>
              <div class="col col-3 qty">Qty</div>
              <div class="col col-4 subtotal">Subtotal</div>
              <div class="col col-4"></div>
            </li>
            @foreach ($cartProducts as $product)
              <form action="" method="">
                <li class="table-row">
                  <div class="col col-1">
                    <img src="{{Storage::url($product->image)}}" alt="Product" class="product-image">
                    <span>{{$product->name}}</span>
                  </div>
                  <div class="col col-2">IDR {{$product->price}}</div>
                  <div class="col col-3">
                    <input type="number" name="quantity" id="quantity" value="{{$product->quantity}}" readonly>
                  </div>
                  <div class="col col-4">IDR {{$product->price * $product->quantity}}</div>
                  <input type="hidden" name="productId" value="{{$product->id}}" readonly>
                </li>
              </form>
            @endforeach
          </ul>
            
          <div class="lower-section">
            <p>Ship to : {{ $address }}</p>
            <div class="total">IDR {{$total}}</div>
          </div>
          <div class="end-section">
            <p>
              Please enter the following passcode to checkout: {{ $code }}
            </p>
            <form action="/checkout" method="post">
              @csrf
              <input type="text" name="code" id="code" placeholder="XXXXXX" value={{ old('code') }}>
              @if (session()->has('error-message'))
                <p class="error-message">{{ session('error-message') }}</p>
              @endif
              <div class="button">
                <input type="submit" value="Confirm">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
