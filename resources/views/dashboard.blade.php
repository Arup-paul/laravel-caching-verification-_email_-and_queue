
@extends('master')



@section('content')

   <div class="well">
   <h4>Logged in Succesfully </h4>
     <p>
     <a href="{{route('categories.index')}}" class="btn btn-info btn-block btn-lg">Category</a>
     </p>
     <hr>
     <p>
        <a href="{{route('posts.index')}}" class="btn btn-info btn-block btn-lg">Post</a>
        </p>

   </div>

@endsection



