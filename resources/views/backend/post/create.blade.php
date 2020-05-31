
@extends('master')



@section('content')

@if ($errors->any())
<div class="alert alert-danger">
      @if ($errors->count() == 1)
          {{$errors->first()}}
      @else
       <ul>
           @foreach($errors->all() as $error)
       <li>{{$error}}</li>
       @endforeach
       </ul>
       @endif
</div>

@endif
@if (session()->has('msg'))
<div class="alert alert-{{session('type')}}">
     {{session('msg')}}
</div>
@endif
   <div class="well">
       <h2 class="text-info">Add Post</h2>
       <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf

       <div class="form-group">
           <label for="id1">Post Title</label>
       <input type="text" value="{{old('title')}}" class="form-control" name="title" id="id1" placeholder="Enter Post Title">
       </div>
       <div class="form-group">
        <label for="id1">Post Content</label>
        <textarea name="content" id="" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="id2">Category</label>
       <select name="category_id" id="id2" class="form-control">
        <option>--Select Category--</option>
           @foreach($categories as $category)

       <option value="{{$category->id}}">{{$category->name}}</option>
       @endforeach
       </select>
    </div>

       <div class="form-group">
        <label for="id2">Slug</label>
       <select name="status" id="id2" class="form-control">
           <option value="1">Active</option>
           <option value="0">InActive</option>
       </select>
    </div>



    <button type="submit" class="btn btn-info btn-block">Add Post</button>

    </form>
     <br>
    <p>
    <a href="{{route('posts.index')}}" class="btn btn-primary btn-block">Back to Post List</a>
    </p>


   </div>

@endsection



