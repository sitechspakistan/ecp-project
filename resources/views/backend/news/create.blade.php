@extends('layouts.backend')
@section('title', 'Create News')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/css/bootstrap-tagsinput.css')}}" />
<style>
    .light-fields {
        background: transparent;
        border: 2px solid #cecece;
        padding: 11px;
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
    ul#categories-list {
        padding: 5px;
        height: 200px;
        width: 100%;
        overflow: auto;
    }
    ul#categories-list li {
        padding-bottom: 5px;
    }
    ul#categories-list li .custom-control-label {
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<form action="{{route('news.store')}}" method="POST">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                News
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('news.index')}}">News</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  Create 
                </li>
              </ol>
            </div>
            <button type="submit" class="btn btn-outline-success me-1 mb-3">
                <i class="fa fa-fw fa-save me-1"></i> Save
            </button>        
          </div>
          
        </div>
    </div>
    
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="block block-rounded pb-3 mb-1">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Basic Details</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control light-fields" id="page-title" placeholder="Title" required>
                                @csrf
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <div class="slug-field">
                                    <input type="text" name="slug" class="form-control light-fields" id="page-slug" placeholder="Slug" required>
                                    <a href="javscript:;" class="text-dark" id="generateSlug"><i class="fa fa-refresh"></i></a>
                                </div>
                            </div>
                            <div class="col-md-12 form-group mt-2">
                                <label for="">Short Description</label>
                                <textarea name="short_description" class="form-control"></textarea>
                            </div>                                        
                            <div class="col-md-4 form-group mt-2">
                                <label for="">Publish Date</label>
                                <input name="publish_date" class="form-control" type="date">
                            </div>                                        
                            <div class="col-md-3 form-group mt-2">
                              <label for="">Author</label>
                              <input name="author" class="form-control" type="text">
                            </div>                                        
                            <div class="col-md-3 form-group mt-2">
                                <label for="">No. of Views</label>
                                <input name="views_count" class="form-control" type="number">
                            </div>                                        
                            <div class="col-md-2 form-group mt-2">
                                <label for="">Sort Order</label>
                                <input name="sort_order" class="form-control" type="number" value="{{$sort_order}}">
                            </div>                                        
                        </div>                        
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="description" class="form-control editor"></textarea>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded mt-3">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Seo Data</h3>
                    </div>
                    <div class="block-content">
                      <div class="row justify-content-center">
                        <div class="col-md-12">                          
                            <div class="mb-4">
                                <label class="form-label" for="meta_title">Title</label>
                                <input type="text" class="js-maxlength form-control" id="meta_title" name="meta_title" data-always-show="true" data-placement="top">
                                {{-- <div class="form-text">
                                  55 Character Max
                                </div> --}}
                              </div>                
                              <div class="mb-3">
                                <label class="form-label" for="meta_desc">Description</label>
                                <textarea class="js-maxlength form-control" id="meta_desc" name="meta_description" rows="4" data-always-show="true" data-placement="top"></textarea>
                                {{-- <div class="form-text">
                                  115 Character Max
                                </div> --}}
                              </div>                                            
                        </div>
                      </div>
                      <div class="row justify-content-center">
                        <div class="form-group col-md-4">
                          <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input seo-switch" data-type="og_tag" type="checkbox" id="og-tag" name="seo_meta[og_tag]" value="1">
                            <label class="form-check-label" for="og-tag">og: Open Graph</label>
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input seo-switch" data-type="twitter_tag" type="checkbox" id="twitter-tag" name="seo_meta[twitter_tag]" value="1">
                            <label class="form-check-label" for="twitter-tag">Twitter Tags</label>
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input seo-switch" data-type="schema" type="checkbox" id="schema-tag" name="seo_meta[is_schema]" value="1">
                            <label class="form-check-label" for="schema-tag">Schema Code</label>
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input seo-switch" data-type="tags" type="checkbox" id="meta-tags" name="seo_meta[is_tags]" value="1">
                            <label class="form-check-label" for="meta-tags">Meta Keywords</label>
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input seo-switch" data-type="scripts" type="checkbox" id="script_tags" name="seo_meta[script_tags]" value="1">
                            <label class="form-check-label" for="script_tags">Custom Scripts</label>
                          </div>
                        </div>
                        <div class="form-group col-md-4">
                          <div class="form-check form-switch form-check-inline">
                            <input class="form-check-input seo-switch" data-type="canonicals" type="checkbox" id="is_canonicals" name="seo_meta[is_canonicals]" value="1">
                            <label class="form-check-label" for="is_canonicals">Link Canonicals</label>
                          </div>
                        </div>              
                      </div>
                      <hr>
                      <div class="row mb-4" id="og_tag_div" style="display: none;">
                        <hr>
                        <h5 style="padding-left: 20px;">OG TAGS</h5>
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Title</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="seo_meta[og][title]">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">URL</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="seo_meta[og][url]">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Type</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="seo_meta[og][type]">
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
                                    <input id="og-image" class="form-control input-sm" type="text" name="seo_meta[og][image]">
                                </div>   
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="seo_meta[og][description]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="row mb-4" id="twitter_tag_div" style="display: none;">
                        <hr>
                        <h5 style="padding-left: 20px;">Twitter Tag</h5>
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Title</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="seo_meta[twitter][title]">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">URL</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="seo_meta[twitter][url]">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Card</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="seo_meta[twitter][card]">
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
                                    <input id="twitter-image" class="form-control input-sm" type="text" name="seo_meta[twitter][image]">
                                </div>   
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="seo_meta[twitter][description]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class="row mb-4" id="schema_div" style="display: none;">
                        <hr>
                        <h5 style="padding-left: 20px;">Schema Code</h5>
                        <hr>
                        <div class="col-md-12">
                            <textarea name="schema_code" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        </div>              
                      <div class="row mb-4" id="tags_div" style="display: none;">
                        <hr>
                        <h5 style="padding-left: 20px;">Meta Keywords</h5>
                        <hr>
                        <div class="col-md-12">
                            <input type="text" class="form-control" data-role="tagsinput" name="seo_meta[meta_tags]">
                        </div>
                        </div>
                      <div class="row mb-4" id="scripts_div" style="display: none;">
                        <hr>
                        <h5 style="padding-left: 20px;">Custom Scripts</h5>
                        <hr>
                        <div class="col-md-12">
                          <textarea name="scripts" class="form-control" cols="30" rows="6"></textarea>
                        </div>
                        </div>
                      <div class="row mb-4" id="canonicals_div" style="display: none;">
                        <hr>
                        <h5 style="padding-left: 20px;">Link Canonicals</h5>
                        <hr>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-xs-5 control-label">href</label>
                            <div class="col-xs-12 link-can">
                                <div style="position:relative;margin-top:5px;">
                                    <input type="text" class="form-control" name="seo_meta[canonical][]"
                                        value="">
                                    <button type="button" class="btn btn-sm btn-info add-canonical"
                                        style="position:absolute;top:0px;right:5px;">ADD</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="block block-rounded mb-3">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Categories</h3>
                    </div>
                    <div class="block-content p-1">
                        <ul id="categories-list">
                            @foreach($categories as $cat)
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="catCheck{{$cat->id}}" name="categories[]" value="{{$cat->id}}">
                                    <label class="form-check-label" for="catCheck{{$cat->id}}">{{$cat->title}}</label>
                                  </div>
                                {{-- <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="categories[]" value="{{$cat->id}}" id="catCheck{{$cat->id}}">
                                    <label class="custom-control-label" for="catCheck{{$cat->id}}">{{$cat->title}}</label>
                                </div> --}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Featured Image</h3>
                    </div>
                    <div class="block-content p-1">
                        <div class="form-group">
                            <div class="image-placeholder" data-input="itemPicture" data-preview="itemPimg" id="itemPimg">
                                <img src="{{asset('placeholder.png')}}" class="img-responsive img-selection img-thumbnail img-thumbnail-set">
                            </div>
                            <input type="hidden" id="itemPicture" name="image">
                            <strong>Image Size: <small>1200 × 800 pixels</small></strong>
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
<script src="https://cdn.tiny.cloud/1/zxhbf3x344fzo897fbfckxk8ntaz1ptnmemotgvsasf9e8ko/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('assets_backend/js/bootstrap-tagsinput.min.js')}}"></script>
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
    tinymce.init({
        selector: '.editor',
        plugins: 'anchor autolink charmap emoticons image link lists media searchreplace table visualblocks wordcount media linkchecker code textcolor',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | link image media table | align lineheight | numlist bullist indent outdent | removeformat | code',
        menubar: false,
        file_picker_types: 'image',
        image_dimensions: false,
        relative_urls: false,
        remove_script_host: false,
        file_picker_callback: function(cb, value, meta) {
            var route_prefix = "/filemanager"; // Update it to your Laravel Filemanager URL
            window.open(route_prefix + '?type=' + meta.filetype, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    return item.url;
                }).join(',');
                // set the value of the desired input to image url
                cb(file_path, { alt: items[0].alt || '' });
            };
        }   
    });
</script>
@endsection