@extends('layouts.index')

@section('title', 'Transaction')

@section('css')
<link rel="stylesheet" href="/css/transaction/transaction.css">
@endsection

@section('content')
<div class="transaction">
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
        @foreach ($list_products as $products)
          @for ($i = 0; $i < count($products)-2 ; $i++)
            @if ($i == 0)
              <p class="date">Transaction Date : {{ $products[$i]->created_at }}</p>
            @endif
              <form action="" method="">
                <li class="table-row">
                  <div class="col col-1">
                    <img src="{{Storage::url($products[$i]->image)}}" alt="Product" class="product-image">
                    <span>{{$products[$i]->name}}</span>
                  </div>
                  <div class="col col-2">IDR {{$products[$i]->price}}</div>
                  <div class="col col-3">
                    <input type="number" name="quantity" id="quantity" value="{{$products[$i]->quantity}}" readonly>
                  </div>
                  <div class="col col-4">IDR {{$products[$i]->quantity*$products[$i]->price}}</div>
                  <input type="hidden" name="productId" value="{{$products[$i]->product_id}}" readonly>
                </li>
              </form>
          @endfor
          <div class="lower-section">
            <div></div>
            <div class="total">IDR {{$products['total']}}</div>
          </div>
          <hr>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection

