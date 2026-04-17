@extends('layouts.frontend')
@section('title',$seo['meta_title']??'Blogs | East Coast Puppies')
@section('seo')
    @include('frontend.seo', [ 'description'=>$seo['meta_description']??'', 'schema'=>$seo['schema_code']??'', 'seo'=>$seo??[] ])
@endsection
@section('content')
<!-- Breadscrumb Section -->
<div class="breadcrumb-bar">
  <div class="container">
    <div class="row align-items-center text-center">
      <div class="col-md-12 col-12">
           <h2 class="breadcrumb-title">Our Blog</h2>
          <nav aria-label="breadcrumb" class="page-breadcrumb">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </nav>							
      </div>
    </div>
  </div>
</div>
<!-- /Breadscrumb Section -->

<!-- Blog List -->
<div class="bloglist-section blog-gridpage">
    <div class="container">
      <div class="row">
        @foreach($data as $value)
        <div class="col-lg-4 col-md-4 d-lg-flex">
          <div class="blog grid-blog">
            <div class="blog-image">
              <a href="{{route('blogDetail', $value->slug)}}"><img class="img-fluid" src="{{$value->image}}" alt="{{$value->title}}"></a>
            </div>
            <div class="blog-content">
              <ul class="entry-meta meta-item">
              </ul>
              <h3 class="blog-title"><a href="{{route('blogDetail', $value->slug)}}">{{$value->title}}</a></h3>
              <p class="blog-description">{{Str::limit($value->short_description, 128, '...')}}</p>
              <a class="btn blog-view" href="{{route('blogDetail', $value->slug)}}">View Details <i class="feather-arrow-right"></i></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
           
    <!--Pagination--> 
      {{$data->links('pagination.frontend')}}
    <!--/Pagination-->
     
  </div>				   
</div>			
<!-- /Blog List -->
@endsection