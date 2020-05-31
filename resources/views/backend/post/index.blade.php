
@extends('master')



@section('content')

   <div class="well">
       <h2>Post List</h2>
       @if (session()->has('msg'))
<div class="alert alert-{{session('type')}}">
     {{session('msg')}}
</div>
@endif
       <p>
       <a href="{{route('posts.create')}}" class="btn btn-success">
         Add Post
    </a>
       </p>
       <table class="table table-bordered table-condensed">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Post Title</th>
                   <th>Category</th>
                   <th>Author</th>
                   <th>Status</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
             @foreach($posts as $post)
               <tr>
                   <td>{{$post->id}}</td>
                   <td>{{$post->title}}</td>
                   <td>{{$post->category->name}}</td>
                   <td>{{$post->user->name}}</td>
                   <td>{{$post->status == 1 ? 'Active' : 'Inactive'}}</td>
                   <td>
                   <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">Details</a>
                   </td>
               </tr>
                @endforeach

           </tbody>
       </table>
       {!!$posts->links() !!}


   </div>

@endsection



