@extends('layouts.index')

@section('title', 'Cart')

@section('css')
<link rel="stylesheet" href="/css/cart/cart.css">
@endsection

@section('content')

<div class="carts">
  <div class="container">
    <div class="upper-section">
    @if (count($cartProducts) == 0)
      <div class="title">Your cart is empty</div>
    @else
      <div class="title">Your Cart</div>
    @endif
    @error('quantity')
      <div class="error">{{$message}}</div>
    @enderror
    </div>
    @if (count($cartProducts) != 0)
      <div class="content">
        <ul class="responsive-table">
          <li class="table-header">
            <div class="col col-1">Product</div>
            <div class="col col-2">Price</div>
            <div class="col col-3">Qty</div>
            <div class="col col-4">Subtotal</div>
            <div class="col col-4"></div>
          </li>
          @foreach ($cartProducts as $product)
          <form action="/cart" method="post">
          @csrf
          @method('PUT')
            <li class="table-row">
              <div class="col col-1">
                <img src="{{Storage::url($product->image)}}" alt="Product" class="product-image">
                <span>{{$product->name}}</span>
              </div>
              <div class="col col-2">IDR {{$product->price}}</div>
              <div class="col col-3">
                <input type="number" name="quantity" id="quantity" value="{{$product->quantity}}">
              </div>
              <div class="col col-4">IDR {{$product->price * $product->quantity}}</div>
              <input type="hidden" name="productId" value="{{$product->product_id}}">
              <div class="col col-4"><input type="submit" class="button" value="Update Cart"></div>
            </li>
          </form>
            @endforeach
          </ul>
          <div class="lower-section">
            <div class="button">
              <a href="/checkout">Checkout</a>
            </div>
            <div class="total">IDR {{$total}}</div>
          </div>
      </div>
    @endif
    
  </div>
</div>
@endsection
