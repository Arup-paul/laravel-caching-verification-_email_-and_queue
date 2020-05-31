
@extends('master')



@section('content')

<h2>{{$category->name}}</h2>

<p>
    ID: {{$category->id}}
</p>

<p>
    Slug: {{$category->slug}}
</p>
<p>
    Status: {{$category->status == 1 ? 'Active' : 'InActive'}}
</p>
<p>
    Created at: {{$category->created_at}}
</p>

<h2>Posts under {{$category->name}}</h2>

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
      @foreach($category->posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$category->name}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->status == 1 ? 'Active' : 'Inactive'}}</td>
            <td>
            <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">Details</a>
            </td>
        </tr>
         @endforeach

    </tbody>
</table>

<div>
<a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-block">Edit</a>
</div>
<div>
    <br>
<form action="{{route('categories.delete',$category->id)}}" method="post" onsubmit="return confirm('Are You Sure')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-block">Delete</button>
</form>
    </div>

    <hr>
    <br>
    <p>
    <a href="{{route('categories.index')}}" class="btn btn-primary btn-block">Back to Category List</a>
    </p>

@endsection



