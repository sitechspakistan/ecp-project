@extends('layouts.backend')
@section('title', 'Editing Category')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/css/components.css')}}" />
<link rel="stylesheet" href="{{asset('assets_backend/css/bootstrap-tagsinput.css')}}" />
<style>
    .light-fields {
        background: transparent;
        border: 2px solid #cecece;
        /* padding: 11px; */
        border-radius: 12px;
    }
    .slug-field {
        position: relative;
    }
    .slug-field a {
        position: absolute;
        top: 11px;
        right: 17px;
    }    
</style>
@endsection
@section('content')
<form action="{{route('products-categories.update', $data['id'])}}" method="POST">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                Categories
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('products-categories.index')}}">Categories</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  Edit 
                </li>
              </ol>
            </div>
            <button type="submit" class="btn btn-outline-success me-1 mb-3">
                <i class="fa fa-fw fa-save me-1"></i> Save
            </button>        
          </div>
          <hr>
          <div class="row">
            <div class="col-md-3">
              <label for="">Category Type</label>
                <select name="category_type" class="form-control light-fields" required>
                    <option value="" selected disabled style="display:none">Select Any</option>
                    <option value="1" {{ (isset($data['category_type']) && $data['category_type'] === 1)?'selected':'' }}>DOGS BREED</option>
                    <option value="2" {{ (isset($data['category_type']) && $data['category_type'] === 2)?'selected':'' }}>PET SUPPLIES</option>
                    <option value="3" {{ (isset($data['category_type']) && $data['category_type'] === 3)?'selected':'' }}>PET PRODUCT</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control light-fields" id="page-title" placeholder="Title" required value="{{ ($data->title)??'' }}">
                @csrf
            </div>
            <div class="col-md-3">
              <label for="">Slug <a href="javscript:;" class="text-dark" id="generateSlug"><i class="fa fa-refresh"></i></a></label>
                <div class="slug-field">
                  <input type="text" name="slug" class="form-control light-fields" id="page-slug" placeholder="Slug" required value="{{ ($data->slug)??'' }}">
                </div>
            </div>
            <div class="form-group col-md-3">
              <label class="form-label">Image <span class="text-danger">*</span></label>
              <div class="input-group pull-left">
                  <span class="input-group-btn">
                      <a data-input="image" class="btn btn-success image-placeholder" style="padding:7px 10px;"><i class="fa-solid fa-cloud-arrow-up"></i> Choose</a>
                  </span>
                  <input id="image" class="form-control light-fields input-sm" type="text" name="image" required value="{{ ($data->image)??'' }}">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group pb-1">
                <label for="">Sort Order</label>
                <input type="number" class="form-control light-fields" placeholder="Sort Order" required value="0" min="0" step="1" name="sort_order" value="{{ ($data->sort_order)??'' }}">
              </div>
            </div>
            <div class="col-md-6">
              <label for="">Short Description</label>
              <textarea name="short_description" class="form-control light-fields">{{ ($data->short_description)??'' }}</textarea>
            </div>
          </div>
        </div>
    </div>
    
    <div class="content">
        @if(Session::has('success'))
        <div class="alert alert-success alert-icon">
            <em class="icon ni ni-check-circle"></em> <strong>{{Session::get('success')}}</strong>
        </div>
        @endif
        
        <div class="block block-rounded mt-3">
          <div class="block-header block-header-default">
            <h3 class="block-title">Seo Data</h3>
          </div>
          <div class="block-content">
            <div class="row justify-content-center">
              <div class="col-md-12">                          
                  <div class="mb-4">
                      <label class="form-label" for="meta_title">Title</label>
                      <input type="text" class="js-maxlength form-control" id="meta_title" name="meta_title" data-always-show="true" data-placement="top" value="{{$data['meta_title']}}">
                    </div>                
                    <div class="mb-3">
                      <label class="form-label" for="meta_desc">Description</label>
                      <textarea class="js-maxlength form-control" id="meta_desc" name="meta_desc" rows="4" data-always-show="true" data-placement="top">{{$data['meta_desc']}}</textarea>
                    </div>                                            
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="form-group col-md-3">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="og_tag" type="checkbox" id="og-tag" name="seo_meta[og_tag]" value="1" {{(isset($data['seo_meta']['og_tag']) && $data['seo_meta']['og_tag']=='1')?'checked':''}}>
                  <label class="form-check-label" for="og-tag">og: Open Graph</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="twitter_tag" type="checkbox" id="twitter-tag" name="seo_meta[twitter_tag]" value="1" {{(isset($data['seo_meta']['twitter_tag']) && $data['seo_meta']['twitter_tag']=='1')?'checked':''}}>
                  <label class="form-check-label" for="twitter-tag">Twitter Tags</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="tags" type="checkbox" id="meta-tags" name="seo_meta[is_tags]" value="1" {{(isset($data['seo_meta']['is_tags']) && $data['seo_meta']['is_tags']=='1')?'checked':''}}>
                  <label class="form-check-label" for="meta-tags">Meta Keywords</label>
                </div>
              </div>
              <div class="form-group col-md-3">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="canonicals" type="checkbox" id="is_canonicals" name="seo_meta[is_canonicals]" value="1" {{(isset($data['seo_meta']['is_canonicals']) && $data['seo_meta']['is_canonicals']=='1')?'checked':''}}>
                  <label class="form-check-label" for="is_canonicals">Link Canonicals</label>
                </div>
              </div>
            </div>
            <hr>
            <div class="row mb-4" id="og_tag_div" @if(isset($data['seo_meta']['og_tag'])) @if($data['seo_meta']['og_tag'] == null) style="display:none;" @endif @else style="display:none;" @endif>
                <hr>
                <h5 style="padding-left: 20px;">OG TAGS</h5>
                <hr>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="seo_meta[og][title]" value="{{$data['seo_meta']['og']['title']??''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">URL</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="seo_meta[og][url]" value="{{$data['seo_meta']['og']['url']??''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="seo_meta[og][type]" value="{{$data['seo_meta']['og']['type']??''}}">
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
                            <input id="og-image" class="form-control input-sm" type="text" name="seo_meta[og][image]" value="{{$data['seo_meta']['og']['image']??''}}">
                        </div>   
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="seo_meta[og][description]">{{$data['seo_meta']['og']['description']??''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
              <div class="row mb-4" id="twitter_tag_div"  @if(isset($data['seo_meta']['twitter_tag'])) @if($data['seo_meta']['twitter_tag'] == null) style="display:none;" @endif @else style="display:none;" @endif>
                <hr>
                <h5 style="padding-left: 20px;">Twitter Tag</h5>
                <hr>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="seo_meta[twitter][title]" value="{{$data['seo_meta']['twitter']['title']??''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">URL</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="seo_meta[twitter][url]" value="{{$data['seo_meta']['twitter']['url']??''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Card</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="seo_meta[twitter][card]" value="{{$data['seo_meta']['twitter']['card']??''}}">
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
                            <input id="twitter-image" class="form-control input-sm" type="text" name="seo_meta[twitter][image]" value="{{$data['seo_meta']['twitter']['image']??''}}">
                        </div>   
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-12">
                            <textarea class="form-control" name="seo_meta[twitter][description]">{{$data['seo_meta']['twitter']['description']??''}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4" id="tags_div" @if(isset($data['seo_meta']['is_tags'])) @if($data['seo_meta']['is_tags'] == null) style="display:none;" @endif @else style="display:none;" @endif>
              <hr>
              <h5 style="padding-left: 20px;">Meta Keywords</h5>
              <hr>
              <div class="col-md-12">
                  <input type="text" class="form-control" data-role="tagsinput" name="seo_meta[meta_tags]" value="{{$data['seo_meta']['meta_tags']??''}}">
              </div>
            </div>
            <div class="row mb-4" id="canonicals_div" @if(isset($data['seo_meta']['is_canonicals'])) @if($data['seo_meta']['is_canonicals'] == null) style="display:none;" @endif @else style="display:none;" @endif>
              <hr>
              <h5 style="padding-left: 20px;">Link Canonicals</h5>
              <hr>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-xs-5 control-label">href</label>
                  <div class="col-xs-12 link-can">
                    @if(isset($data['seo_meta']['canonical']) && is_array($data['seo_meta']['canonical']) && count($data['seo_meta']['canonical'])>0)
                        @foreach($data['seo_meta']['canonical'] as $cc=>$can)
                        <div style="position:relative;margin-top:5px;">
                            <input type="text" class="form-control" name="seo_meta[canonical][]" value="{{($can)??''}}">
                            @if($cc==0)
                            <button type="button" class="btn btn-sm btn-info add-canonical" style="position:absolute;top:0px;right:5px;">ADD</button>
                            @else
                            <button type="button" class="btn btn-xs btn-danger remove-canonical" style="position:absolute;top:0px;right:5px;"><i class="fa fa-times"></i></button>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <div style="position:relative;margin-top:5px;">
                            <input type="text" class="form-control" name="seo_meta[canonical][]" value="">
                            <button type="button" class="btn btn-sm btn-info add-canonical" style="position:absolute;top:0px;right:5px;">ADD</button>
                        </div>
                    @endif
                </div>
                </div>
              </div>
            </div>              
          </div>
        </div>
    </div>
</form>
@endsection
@section('customScripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
    $(document).on('click','#generateSlug',function(){
        $("#page-slug").val(convertToSlug($('#page-title').val()));
    });
    function convertToSlug(Text) {
        return Text
            .toLowerCase()
            .replace(/[^\w ]+/g,'')
            .replace(/ +/g,'-')
            ;
    }    
    $('.image-placeholder').filemanager('image');
    $('.seo-switch').click(function(){
      if($(this).is(':checked')) {
        $("#"+$(this).data('type')+'_div').show(300);
      } else {
        $("#"+$(this).data('type')+'_div').hide(300);
      }
    });
    $('.add-canonical').on('click',function(){
        var html = `<div style="position:relative;margin-top:5px;"><input type="text" class="form-control" name="seo_meta[canonical][]">
                    <button type="button" class="btn btn-xs btn-danger remove-canonical" style="position:absolute;top:0px;right:5px;"><i class="fa fa-times"></i></button></div>`; 
        $(this).parents('.link-can').append(html);
    });
    $(document).on('click', '.remove-canonical', function(){
        $(this).parent().remove();
    });
</script>
@endsection