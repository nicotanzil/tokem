@extends('layouts.index')

@section('title', 'Our Products')

@section('css')
<link rel="stylesheet" href="/css/product/products.css">
@endsection

@section('content')
<div class="products">
  <div class="container">
    @if(Session::has('success'))
    <div class="success-container">
      <div class="success">{{Session::get('success')}}</div>
    </div>
    @endif
    <div class="upper-section">
      <div class="title">Our Products</div>
      <div class="product-configurations">
        <form action="/products/search" method="get">
          <input type="text" name="search" id="search" placeholder="Search product" autocomplete="off">
          <input type="submit" value="Search" class="button">
        </form>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <a href="/add-product">
          <div class="button">Insert Product</div>
        </a>
        @endif
      </div>
    </div>
    <div class="content">
      @if(isset($keyword))
        @if(count($products) == 0)
        <h3>No Product Match for '{{$keyword}}'</h3>
        @endif
      @endif
      @if(isset($message))
      <div class="success">message {{$message}}</div>
      @endif
      @foreach($products as $product)
      <div class="product-card">
        <a href="/products/{{$product->id}}">
          <div class="upper-content">
            <img src="{{Storage::url($product->image)}}" alt="Product Image" id="preview">
            <span class="name">{{$product->name}}</span>
            <span class="price">IDR {{$product->price}}</span>
            <span class="category">{{$product->category->name}}</span>
          </div>
        </a>
        <div class="lower-content">
          @if($product->quantity <= 0) 
          <span class="notice">The product is unavailable</span>
          @endif
          @if(Auth::check() && Auth::user()->role == 'admin')
          <a href="/update-product/{{$product->id}}">
            <span class="button good">Edit Product</span>
          </a>
          <form action="/product" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{$product->id}}">
            <input type="submit" class="button bad" value="Remove Product"/>
          </form>
          @elseif($product->quantity > 0)
          <form action="/add-cart" method="POST">
          @csrf
            <input type="hidden" name="productId" value="{{$product->id}}">
            <input type="hidden" name="quantity" value="1">
            <input type="submit" value="Add to Cart" class="button good">
          </form>
          @endif
        </div>
      </div>
      @endforeach
    </div>
    {{$products->links()}}
  </div>
</div>

<script>
  var msg = '{{ Session::get('add_product') }}';
  var exist = '{{ Session::has('add_product') }}';
  if(exist){
    alert(msg);
  }

  var msg2 = '{{ Session::get('item_removed') }}';
  var exist2 = '{{ Session::has('item_removed') }}';
  if(exist2){
    alert(msg2);
  }

</script>
@endsection