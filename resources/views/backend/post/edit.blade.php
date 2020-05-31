
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
       <h2 class="text-info">Update Category</h2>
       <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT ')

       <div class="form-group">
           <label for="id1">Name</label>
       <input type="text" value="{{$category->name}}" class="form-control" name="name" id="id1" >
       </div>

       <div class="form-group">
        <label for="id2">Slug</label>
       <select name="status" id="id2" class="form-control">
           <option value="1" @if ($category->status==1) selected @endif>Active</option>
           <option value="0" @if ($category->status==0 ) selected @endif>InActive</option>
       </select>
    </div>



    <button type="submit" class="btn btn-info btn-block">Update Category</button>

    </form>
     <br>
    <p>
    <a href="{{route('categories.index')}}" class="btn btn-primary btn-block">Back to Category List</a>
    </p>


   </div>

@endsection



