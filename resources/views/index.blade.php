
@extends('master')

{{-- @section('slide')

@include('partial.slide')


@endsection --}}

@section('content')


<h3 class="pb-4 mb-4 font-italic border-bottom">
    From the Firehose
  </h3>
   @foreach ($article as $single)

  <div class="blog-post">
  <h2 class="blog-post-title">{{$single->title}}</h2>
    <p class="blog-post-meta">{{$single->created_at->format('F d,Y')}} {{$single->created_at->diffForHumans()}} by <a href="#">{{$single->user->name}}</a> on <a href="#">{{$single->category->name}}</a></p>

  </div><!-- /.blog-post -->

  @endforeach


  {{-- {!! $article->links()!!} --}}

@endsection



