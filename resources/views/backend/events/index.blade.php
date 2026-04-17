@extends('layouts.backend')
@section('title', 'Events')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection
@section('content')
@php
$l_sort = $_GET['sort']??'desc';
@endphp
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">
            Events
          </h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Events
            </li>
          </ol>
        </div>
        <a href="#" class="btn btn-outline-info me-1 mb-3" data-bs-toggle="modal" data-bs-target="#seoModal">
          <i class="fa fa-fw fa-hashtag me-1"></i>SEO
        </a>
        <form action="{{route('events.delete')}}" method="POST" id="del_form" form="del_form">
            {{csrf_field()}}
            <button class="btn btn-outline-danger me-1 mb-3" type="button" id="deleteAll"> <i class="fas fa-trash-alt"></i> Delete </button>        
        </form>
        <a href="{{route('events.create')}}" class="btn btn-outline-success me-1 mb-3">
            <i class="fa fa-fw fa-plus me-1"></i> Add New
        </a>        
      </div>
    </div>
</div>
<div class="content">  
  @if(Session::has('success'))
    <div class="alert alert-success alert-icon">
        <em class="icon ni ni-check-circle"></em> <strong>{{Session::get('success')}}</strong>
    </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">All Events</h3>
        <div class="block-options">
          <div class="dropdown">
            <button type="button" class="btn-block-option" id="dropdown-ecom-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sort By <i class="fa fa-angle-down ms-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-ecom-filters">
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{request()->url().'?sort=desc&limit='.$data->perPage()}}">
                New
              </a>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{request()->url().'?sort=desc&limit='.$data->perPage()}}">
                Old
              </a>
              <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{request()->url().'?sort=title&limit='.$data->perPage()}}">
                Title / Name
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="block-content">
        <!-- Search Form -->
        <form action="{{request()->url()}}">
          <div class="mb-4">
            <div class="input-group">
              <input type="text" class="form-control form-control-alt" id="one-ecom-products-search" name="q" placeholder="Search all items.." value="{{$_GET['q']??''}}">
              <span class="input-group-text bg-body border-0">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>
        </form>
        <!-- END Search Form -->

        <!-- All Products Table -->
        <div class="table-responsive">
          <table class="js-table-checkable table table-hover table-vcenter">
            <thead>
              <tr>
                <th class="text-center" style="width: 70px;">
                  <div class="form-check d-inline-block">
                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                    <label class="form-check-label" for="check-all"></label>
                  </div>
                </th>
                <th class="text-center" style="width: 100px;"></th>
                <th class="d-none d-md-table-cell">Title</th>
                <th class="d-none d-sm-table-cell text-center">Added</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k => $v)
              <tr>
                <td class="text-center">
                  <div class="form-check d-inline-block">
                    <input class="form-check-input checkItem" type="checkbox" value="{{$v->id}}" id="row_{{$v->id}}" name="ids[]" required form="del_form">
                    <label class="form-check-label" for="row_{{$v->id}}"></label>
                  </div>
                </td>
                <td class="text-center fs-sm">
                  <img src="{{$v->image??asset('placeholder.png')}}" class="img-responsive img-thumbnail" alt="*">
                </td>
                <td class="d-none d-md-table-cell fs-sm">{{$v->title}}</td>
                <td class="d-none d-sm-table-cell text-center fs-sm">{{$v->created_at->format('d/m/Y')}}</td>
                <td>
                  @if($v->is_active==1)
                  <span class="badge bg-success">Published</span>
                  @else
                  <span class="badge bg-warning">Draft</span>
                  @endif
                </td>                
                <td class="text-center fs-sm">
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('events.status', $v->id)}}" data-bs-toggle="tooltip" title="{{($v->is_active==1)?'Un-publish':'Publish'}}">
                    <i class="fa fa-fw {{($v->is_active==1)?'fa-eye-slash':'fa-eye'}}"></i>
                  </a>
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('events.edit', $v->id)}}" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa fa-fw fa-pencil"></i>
                  </a>
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('eventsDetail', $v->slug)}}" data-bs-toggle="tooltip" title="View Live" target="_blank">
                    <i class="fa fa-fw fa-external-link"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- END All Products Table -->

        <!-- Pagination -->
        {{$data->links('pagination.custom')}}        
      </div>
    </div>
    <!-- END All Products -->
</div>
<div class="modal" id="seoModal" tabindex="-1" role="dialog" aria-labelledby="seoModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{route('events.seo')}}" method="POST">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">SEO Data for Events</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">

            <div class="row justify-content-center">
              <div class="col-md-12">                          
                <div class="mb-4">
                    <label class="form-label" for="meta_title">Title</label>
                    <input type="text" class="js-maxlength form-control" id="meta_title" name="seo_data[meta_title]" data-always-show="true" data-placement="top" value="{{$seo['meta_title']??''}}">
                    {{-- <div class="form-text">
                      55 Character Max
                    </div> --}}
                  </div>                
                  <div class="mb-3">
                    <label class="form-label" for="meta_description">Description</label>
                    <textarea class="js-maxlength form-control" id="meta_description" name="seo_data[meta_description]" rows="4" data-always-show="true" data-placement="top">{{$seo['meta_description']??''}}</textarea>
                    {{-- <div class="form-text">
                      115 Character Max
                    </div> --}}
                  </div>                                            
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="og_tag" type="checkbox" id="og-tag" name="seo_data[og_tag]" value="1" {{(isset($seo['og_tag']) && $seo['og_tag']=='1')?'checked':''}}>
                  <label class="form-check-label" for="og-tag">og: Open Graph</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="twitter_tag" type="checkbox" id="twitter-tag" name="seo_data[twitter_tag]" value="1" {{(isset($seo['twitter_tag']) && $seo['twitter_tag']=='1')?'checked':''}}>
                  <label class="form-check-label" for="twitter-tag">Twitter Tags</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="schema" type="checkbox" id="schema-tag" name="seo_data[is_schema]" value="1" {{(isset($seo['is_schema']) && $seo['is_schema']=='1')?'checked':''}}>
                  <label class="form-check-label" for="schema-tag">Schema Code</label>
                </div>
              </div>
            </div>
            <hr>
            <div class="row mb-4" id="og_tag_div" @if(isset($seo['og_tag'])) @if($seo['og_tag'] == null) style="display:none;" @endif @else style="display:none;" @endif>
              <hr>
              <h5 style="padding-left: 20px;">OG TAGS</h5>
              <hr>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-md-3 control-label">Title</label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="seo_data[og][title]" value="{{$seo['og']['title']??''}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">URL</label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="seo_data[og][url]" value="{{$seo['og']['url']??''}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Type</label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="seo_data[og][type]" value="{{$seo['og']['type']??''}}">
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="form-label">OG Image</label>
                      <div class="input-group pull-left">
                          <span class="input-group-btn">
                              <a data-input="og-image" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                          </span>
                          <input id="og-image" class="form-control input-sm" type="text" name="seo_data[og][image]" value="{{$seo['og']['image']??''}}">
                      </div>   
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Description</label>
                      <div class="col-md-12">
                          <textarea class="form-control" name="seo_data[og][description]">{{$seo['og']['description']??''}}</textarea>
                      </div>
                  </div>
              </div>
          </div>
            <div class="row mb-4" id="twitter_tag_div"  @if(isset($seo['twitter_tag'])) @if($seo['twitter_tag'] == null) style="display:none;" @endif @else style="display:none;" @endif>
              <hr>
              <h5 style="padding-left: 20px;">Twitter Tag</h5>
              <hr>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-md-3 control-label">Title</label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="seo_data[twitter][title]" value="{{$seo['twitter']['title']??''}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">URL</label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="seo_data[twitter][url]" value="{{$seo['twitter']['url']??''}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Card</label>
                      <div class="col-md-12">
                          <input type="text" class="form-control" name="seo_data[twitter][card]" value="{{$seo['twitter']['card']??''}}">
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="form-label">Image</label>
                      <div class="input-group pull-left">
                          <span class="input-group-btn">
                              <a data-input="twitter-image" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                          </span>
                          <input id="twitter-image" class="form-control input-sm" type="text" name="seo_data[twitter][image]" value="{{$seo['twitter']['image']??''}}">
                      </div>   
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 control-label">Description</label>
                      <div class="col-md-12">
                          <textarea class="form-control" name="seo_data[twitter][description]">{{$seo['twitter']['description']??''}}</textarea>
                      </div>
                  </div>
              </div>
          </div>
            <div class="row mb-4" id="schema_div" @if(isset($seo['is_schema'])) @if($seo['is_schema'] == null) style="display:none;" @endif @else style="display:none;" @endif>
              <hr>
              <h5 style="padding-left: 20px;">Schema Code</h5>
              <hr>
              <div class="col-md-12">
                  <textarea name="seo_data[schema_code]" class="form-control" cols="30" rows="10">{!! $seo['schema_code']??'' !!}</textarea>
              </div>
            </div>
          </div>
          <div class="block-content block-content-full text-end bg-body">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary" style="width: 100%;">Save</button>
          </div>          
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('customScripts')
<!-- Page JS Helpers (Table Tools helpers) -->
<script>One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);</script>
<script src="{{asset('assets_backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
  $(document).on('click','#deleteAll',function(e){
      if($('.checkItem').is(':checked')){
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $("#del_form").submit();            
          } else {
            console.log('Deletion canceled');
          }
        });          
      } 
      else {
        One.helpers('jq-notify', {type: 'warning', icon: 'fa fa-exclamation me-1', message: 'Select one or more item'});
      }
  });
  $('.image-placeholder').filemanager('image');
    $('.seo-switch').click(function(){
      if($(this).is(':checked')) {
        $("#"+$(this).data('type')+'_div').show(300);
      } else {
        $("#"+$(this).data('type')+'_div').hide(300);
      }
    });
</script>
@endsection