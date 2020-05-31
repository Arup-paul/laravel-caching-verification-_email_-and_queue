
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
       <h2 class="text-info">Add Category</h2>
       <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
        @csrf

       <div class="form-group">
           <label for="id1">Name</label>
       <input type="text" value="{{old('name')}}" class="form-control" name="name" id="id1" placeholder="Enter Category name">
       </div>

       <div class="form-group">
        <label for="id2">Slug</label>
       <select name="status" id="id2" class="form-control">
           <option value="1">Active</option>
           <option value="0">InActive</option>
       </select>
    </div>



    <button type="submit" class="btn btn-info btn-block">Add Category</button>

    </form>
     <br>
    <p>
    <a href="{{route('categories.index')}}" class="btn btn-primary btn-block">Back to Category List</a>
    </p>


   </div>

@endsection



