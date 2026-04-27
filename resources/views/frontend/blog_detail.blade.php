@extends('layouts.frontend')
@section('title',(!empty($data->meta_title))?$data->meta_title:$data['title'].' | East Coast Puppies')
@section('seo')
    @include('frontend.seo', [ 'description'=>$data->meta_description??'', 'schema'=>$data['schema_code']??'', 'seo'=>$data['seo_meta']??[] ])
@endsection
@section('content')

<!--Blog Banner-->
<div class="blogbanner" style="background-image: url({{ asset($data->image) }})">   
  <div class="blogbanner-content">
    <h1>{{$data['title']}}</h1>
    <ul class="entry-meta meta-item">
        <li>
        <div class="post-author">
            <div class="post-author-img">
              <img src="{{asset('assets_frontend')}}/img/profiles/avatar-01.jpg" alt="author">
          </div>
          <a href="javascript:void(0)"><span> {{$data['author']}} </span></a>
        </div>
        </li>
        <li class="date-icon"><i class="fa-solid fa-calendar-days"></i> {{$data['publish_date']??$data['created_at']->format('m/d/Y')}}</li>
    </ul>
  </div>		            
</div>	
<!--/Blog Banner-->

<!--Blog Content-->
<div class="blogdetail-content">
   <div class="container">

    {!! $data['description']??'' !!}

   <div class="share-postsection">
        <div class="row">
         <div class="col-lg-4">
           <div class="sharelink">
            <a href="javasvript:void();" class="share-img"><i class="fas fa-light fa-share-nodes"></i></a>
            <a href="javasvript:void();" class="share-text">Share</a>
         </div>
       </div>
       <div class="col-lg-8">
          <div class="tag-list">
              <ul class="tags">
                @foreach($categories as $cat)
                  {{-- <li>
                    <li><a href="{{route('blogsPage')}}?category={{$cat->id}}">{{$cat->title}}</a></li>
                  </li> --}}
                  <li>{{$cat->title}}</li>
                @endforeach						   							
           </ul>
          </div>						
       </div>					 
      </div>
   </div>
   <div class="blogdetails-pagination">
       <ul>
          @if(isset($recents[0]))
            <li>
              <a href="{{route('blogDetail', $recents[0]->slug)}}" class="prev-link"><i class="fas fa-regular fa-arrow-left"></i> Previous Post</a>
              <a href="{{route('blogDetail', $recents[0]->slug)}}"><h3>{{ $recents[0]->title }}</h3> </a>
            </li>
          @endif

          @if(isset($recents[1]))
            <li>
              <a href="{{route('blogDetail', $recents[1]->slug)}}" class="next-link">Next Post <i class="fas fa-regular fa-arrow-right"></i> </a>
              <a href="{{route('blogDetail', $recents[1]->slug)}}"><h3>{{ $recents[1]->title }}</h3> </a>
            </li>
          @endif					
     </ul>				
   </div>
   <div class="card review-sec  mb-0">
     <div class="card-header  align-items-center">
       <img src="{{asset('assets_frontend')}}/img/review.svg" alt="review">
       <h4>{{ count($reviews) }} Reviews</h4>
     </div>
     <div class="card-body">
         <div class="review-list">
             <ul class="">
           <li class="review-box feedbackbox mb-0">
             <div class="review-details">
                <h6>Leave feedback about this</h6>
               </div>
             <div class="card-body">
               <form class="" action="{{ route('blogReview.store', $data->id) }}" method="post">
                  @csrf
                  <input type="hidden" value="{{ $data->id }}" name="blog_id" />
                 <div class="form-group">
                     <input type="text" class="form-control" placeholder="Title" name="title">
                 </div>
                 <div class="namefield">
                   <div class="form-group">
                      <input type="text" class="form-control" placeholder="Name*" required name="name">
                   </div>
                   <div class="form-group me-0">
                      <input type="email" class="form-control" placeholder="Email*" required name="email">
                   </div>
                 </div>
                 <div class="form-group">
                        <textarea rows="4" class="form-control" placeholder="Write a Review*" required name="review"></textarea>
                 </div>
                 {{-- <div class="reviewbox-rating">
                     <p><span> Rating</span> 
                                               <i class="fas fa-star filled"></i>
                          <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                     <i class="fas fa-star filled"></i>
                   </p>
                 </div> --}}
                 <div class="submit-section">
                   <button class="btn btn-primary submit-btn" type="submit"> Submit Review</button>
                 </div>
               </form>
             </div>
           </li>
         </ul>
       </div>
     </div>
   </div>
 </div>		
</div>   
<!--/Blog Content-->
@endsection