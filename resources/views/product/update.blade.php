@extends('layouts.index')

@section('title', 'Update Product')

@section('css')
<link rel="stylesheet" href="/css/product/update.css">
@endsection

@section('defer-script')
<script>
  const image = document.getElementById("image");
  image.onchange = e => {
    const [file] = image.files;
    if(file) {
      preview.src = URL.createObjectURL(file);
    }
  }
</script>
@endsection

@section('content')
<div class="update-product">
  <div class="container">
    <div class="upper-section">
      <div class="name">{{$product->name}}</div>
    </div>
    <div class="form-section">
      <div class="image-container">
        <img src="{{Storage::url($product->image)}}" alt="Product Image" id="preview">
      </div>
      <form action="/product" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="id" value="{{$product->id}}"/>
        <div class="input">
          <label for="image">Image</label>
          <input type="file" id="image" name="image">
        </div>
        <hr>
        <div class="input">
          <label for="description">Description</label>
          <textarea type="text" name="description" id="description">{{$product->description}}</textarea>
        </div>
        <hr>
        <div class="input">
          <label for="price">Price</label>
          <input type="number" name="price" id="price" value="{{$product->price}}">
        </div>
        <hr>
        <div class="input">
          <label for="quantity">Product Quantity</label>
          <input type="number" name="quantity" id="quantity" value="{{$product->quantity}}">
        </div>
        <hr>
        @if($errors->any())
          @if($errors->has('image'))
            <script>alert("{{$errors->first('image')}}")</script>
          @endif
        <div class="error-container">
            @foreach ($errors->all() as $error)
                <div class="error">{{$error}}</div>
            @endforeach
          </div>
        @endif
        <div class="button-input">
          <input type="submit" value="Update" class="submit">
          <a href="/products">
            <input value="Cancel" class="cancel">
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection