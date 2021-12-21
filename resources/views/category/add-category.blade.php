@extends('layouts.index')

@section('title', 'Add Category')

@section('css')
<link rel="stylesheet" href="/css/category/add-category.css">
@endsection

@section('content')
<div class="add-category">
  <div class="container">
    <div class="upper-section">
      @foreach($categories as $category)
      <div class="category">{{$category->name}}</div>
      @endforeach
    </div>
    <div class="content">
      <div class="title">Add New Category</div>
      <form action="/categories" method="post">
      @csrf
        <div class="input">
          <label for="name">Category Name</label>
          <input type="text" name="name" id="name">
        </div>
        <input type="submit" value="Submit">
        @if($errors->any())
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
      </form>
    </div>
  </div>
</div>
@endsection