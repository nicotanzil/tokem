@extends('layouts.index')

@section('title', 'Add Product')

@section('css')
<link rel="stylesheet" href="/css/product/add.css">
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
<div class="add-product">
  <div class="container">
    <div class="image-container">
      <img src="#" alt="Product Image" id="preview">
    </div>
    <form action="/product" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="input">
        <label for="image">Image</label>
        <input type="file" id="image" name="image">
      </div>
      <hr>
      <div class="input">
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name">
      </div>
      <hr>
      <div class="input">
        <label for="description">Description</label>
        <textarea type="text" name="description" id="description"></textarea>
      </div>
      <hr>
      <div class="input">
        <label for="price">Price</label>
        <input type="number" name="price" id="price">
      </div>
      <hr>
      <div class="input">
        <label for="quantity">Product Quantity</label>
        <input type="number" name="quantity" id="quantity">
      </div>
      <hr>
      <div class="input">
        <label for="category_id">Category ID</label>
        <select name="category_id" id="category_id">
          @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
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
      @if(Session::has('success'))
        <div class="success-container">
          <div class="success">{{Session::get('success')}}</div>
        </div>
      @endif
      <div class="button-input">
        <input type="submit" value="Insert" class="submit">
        <a href="/products">
          <input value="Cancel" class="cancel">
        </a>
      </div>
    </form>
  </div>
</div>
@endsection