@extends('layouts.backend')
@section('title', 'Create Puppy')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/css/bootstrap-tagsinput.css')}}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    .select2-container--default .select2-selection--single{
      padding: .25rem 0rem;
      border: 2px solid #cecece;
      border-radius: 12px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow{
      height: -webkit-fill-available;
    }

    .select2-container .select2-selection--single{
      height: auto;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
      height: auto;
    }

    /* Container styling */
    .product-gallery {
      display: flex;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 0;
      padding: 20px;
      background: #f4f5f7;
      border: 1px solid #e3e3e3;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      justify-content: flex-start;
      align-items: center;
      min-height: 150px;
      margin: 0 auto;
      flex-wrap: wrap;
    }

    /* Individual image styling */
    .image-item {
      position: relative;
      width: 114px;
      height: 114px;
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 20px;
      margin-bottom: 20px;
    }

    /* Image Styling */
    .image-item img {
      max-width: 100%; /* Scale down if needed */
      max-height: 100%; /* Maintain aspect ratio */
      width: auto; /* Ensure it fits within the container */
      height: auto;
      object-fit: cover; /* Crop image to fill container if necessary */
    }

    /* Remove button styling */
    .remove-btn {
      position: absolute;
      top: 4px;
      right: 4px;
      background-color: lightgray;
      color: white;
      border: none;
      border-radius: 50%;
      width: 14px;
      height: 14px;
      font-size: 10px;
      font-weight: bold;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
    }

    .remove-btn:hover {
      background-color: #ff0000;
    }
</style>
@endsection
@section('content')
<form action="{{route('products.store')}}" method="POST">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                Puppies
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('products.index')}}">Puppies</a>
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
          <hr>
          <div class="row">
            
            
        </div>
      </div>
    </div>

    <div class="content">
      <div class="block block-rounded mt-3">
        <div class="block-header block-header-default">
          <h3 class="block-title">Puppy Data</h3>
        </div>
        <div class="block-content">
          <div class="row">
            <div class="form-group col-md-4 mb-2">
              <label>Puppy Name <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control light-fields input-sm" id="page-title" placeholder="Puppy Name" required>
              @csrf
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Puppy Slug <span class="text-danger">*</span></label>
              <div class="slug-field">
                  <input type="text" name="slug" class="form-control light-fields input-sm" id="page-slug" placeholder="Puppy Slug" required>
                  <a href="javscript:;" class="text-dark" id="generateSlug"><i class="fa fa-refresh"></i></a>
              </div>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Category <span class="text-danger">*</span></label>
                <select name="category_id" class="form-control light-fields input-sm select2" required>
                  <option value="" disabled selected style="visible:hidden">No Category</option>
                  @foreach($categories as $k => $category)
                    <optgroup label="{{ ($k === 1) ? 'DOGS BREED' : (($k === 2) ? 'PET PRODUCT' : (($k === 3) ? 'PET SUPPLIES' : '')) }}">
                      @foreach($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">State <span class="text-danger">*</span></label>
                <select name="state_id" class="form-control light-fields input-sm select2 state" required>
                  <option value="" disabled selected style="visible:hidden">No State</option>
                  @foreach($states as $k => $state)
                    <option value="{{$k}}">{{$state}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">City <span class="text-danger">*</span></label>
              <select name="location_id" class="form-control light-fields input-sm select2 city" required>
                <option value="" disabled selected style="visible:hidden">No City</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Puppy Image <span class="text-danger">*</span></label>
              <div class="input-group pull-left">
                  <span class="input-group-btn">
                      <a data-input="image" class="btn btn-success image-placeholder" style="padding:7px 10px;"><i class="fa-solid fa-cloud-arrow-up"></i> Choose</a>
                  </span>
                  <input id="image" class="form-control light-fields input-sm" type="text" name="image" required>
              </div>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Sort Order</label>
              <input type="number" class="form-control light-fields input-sm" placeholder="Sort Order" required value="0" min="0" step="1" name="sort_order">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Min Offer Price <span class="text-danger">*</span></label>
              <input type="number" class="form-control light-fields input-sm" placeholder="Cost Price" required step=".1" name="cost_price">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Sell Price <span class="text-danger">*</span></label>
              <input type="number" class="form-control light-fields input-sm" placeholder="Sell Price" required min="1" step=".1" name="sell_price">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Shipping <span class="text-danger">*</span></label>
              <input type="text" class="form-control light-fields input-sm" placeholder="Shipping" required name="shipping">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Quantity <span class="text-danger">*</span></label>
              <input type="number" class="form-control light-fields input-sm" placeholder="Quantity" required step="1" value="1" name="quantity">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Gender <span class="text-danger">*</span></label>
              <select name="gender" class="form-control light-fields input-sm" required>
                <option value="" disabled selected style="visible:hidden">Select Any</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Color/Markings</label>
              <input type="text" name="color_markings" class="form-control light-fields input-sm" placeholder="Color/Markings">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Potential</label>
              <select name="potential" class="form-control light-fields input-sm">
                <option value="">Select</option>
                <option value="Show">Show</option>
                <option value="Pet">Pet</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Champion Bloodlines</label>
              <select name="champion_bloodlines" class="form-control light-fields input-sm">
                <option value="No" @selected(old('champion_bloodlines', 'No') === 'No')>No</option>
                <option value="Yes" @selected(old('champion_bloodlines', 'No') === 'Yes')>Yes</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Champion Sired</label>
              <select name="champion_sired" class="form-control light-fields input-sm">
                <option value="No" @selected(old('champion_sired', 'No') === 'No')>No</option>
                <option value="Yes" @selected(old('champion_sired', 'No') === 'Yes')>Yes</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Vaccinations &amp; Deworming</label>
              <select name="vaccinations" class="form-control light-fields input-sm">
                <option value="0">No</option>
                <option value="1" selected>Yes</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Age</label>
              <input type="date" class="form-control light-fields input-sm" name="age" />
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Puppy Listing Date</label>
              <input type="date" class="form-control light-fields input-sm" name="product_listing" />
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Date Photographed <span class="text-danger">*</span></label>
              <input type="date" class="form-control light-fields input-sm" name="photo_date" required />
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Size <span class="text-danger">*</span></label>
              <select name="size" class="form-control light-fields input-sm">
                <option value="" disabled selected style="visible:hidden">Select Any</option>
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Available Color</label>
              <input type="text" name="avaiable_color" class="form-control light-fields input-sm" placeholder="Available Color">
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Health Certificate</label>
              <select name="health_certificate" class="form-control light-fields input-sm">
                <option value="0">No</option>
                <option value="1" selected>Yes</option>
              </select>
            </div>
            <div class="form-group col-md-4 mb-2">
              <label class="form-label">Health Record</label>
              <select name="health_record" class="form-control light-fields input-sm">
                <option value="0">No</option>
                <option value="1" selected>Yes</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label class="form-label" for="health_warranty">Health Warranty</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="health_warranty" name="health_warranty">
              </div>
            </div>
            <div class="form-group col-md-4">
              <label class="form-label" for="is_featured">Featured</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="block block-rounded mt-3">
        <div class="block-header block-header-default">
          <h3 class="block-title">Puppy Description</h3>
        </div>
        <div class="block-content">
          <div class="row justify-content-center">
            <!-- <div class="form-group col-md-12 mb-2">
              <label class="form-label">Short Description</label>
              <textarea class="form-control light-fields input-sm" placeholder="Short Description" name="short_description"></textarea>
            </div> -->
            <div class="col-md-12 form-group mb-2">
              <label class="form-label">Description</label>
              <textarea class="form-control light-fields input-sm editor" placeholder="Description" name="description"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="block block-rounded mt-3">
        <div class="block-header block-header-default">
          <h3 class="block-title">Puppy Gallery</h3>
          <button type="button" class="btn btn-sm btn-outline-primary multiimage-placeholder" data-input="thumbnail" data-preview="holder"><i class="fa-solid fa-cloud-arrow-up"></i> Upload</button>
        </div>
        <div class="block-content">
          <input id="thumbnail" class="form-control" type="hidden" name="gallery">
          <div id="holder" class="product-gallery mb-2">
          </div>
        </div>
      </div>
    </div>
    
    <div class="content">
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
                    <label class="form-label" for="meta_description">Description</label>
                    <textarea class="js-maxlength form-control" id="meta_description" name="meta_description" rows="4" data-always-show="true" data-placement="top"></textarea>
                    {{-- <div class="form-text">
                      115 Character Max
                    </div> --}}
                  </div>                                            
            </div>
          </div>
          <div class="row">
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
                            <a data-input="og-image" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa-solid fa-cloud-arrow-up"></i> Choose</a>
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
                            <a data-input="twitter-image" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa-solid fa-cloud-arrow-up"></i> Choose</a>
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
    {{-- </div> --}}
</form>
@endsection
@section('customScripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.tiny.cloud/1/0yvf3vk68hoq40p5mad0iy4otzessy9gdxx3hplqo6kf2plj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="{{asset('assets_backend/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).on('click','#generateSlug',function(){
        $("#page-slug").val(convertToSlug($('#page-title').val()));
    });
    $(document).on('change','#page-title',function(){
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
    $('.multiimage-placeholder').filemanager('image',{ multiple: true });
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

    function initEditor() {
        tinymce.init({
            selector: '.editor',
            plugins: 'anchor autolink charmap emoticons image link lists media searchreplace table visualblocks wordcount media linkchecker code textcolor paste',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | link image media table | align lineheight | numlist bullist indent outdent | removeformat | code | copyButton pasteButton',
            menubar: false,
            file_picker_types: 'image',
            image_dimensions: false,
            relative_urls: false,
            remove_script_host: false,
            branding: false,
            contextmenu: 'copyButton pasteButton link',
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
            },
            setup: function (editor) {
              editor.ui.registry.addButton('copyButton', {
                  text: 'Copy',
                  icon: 'copy',
                  onAction: function () {
                    const selectedText = editor.selection.getContent({ format: 'text' });
                
                    if (!selectedText) {
                      alert('Please select some text to copy.');
                      return;
                    }
                
                    navigator.clipboard.writeText(selectedText)
                      .catch(() => alert('Clipboard copy failed. Use Ctrl+C instead.'));
                  }
                });
        
              editor.ui.registry.addButton('pasteButton', {
                text: 'Paste',
                icon: 'paste',
                onAction: function () {
                  navigator.clipboard.readText()
                    .then(text => {
                      if (text) {
                        editor.insertContent(text);
                      } else {
                        alert('Clipboard is empty.');
                      }
                    })
                    .catch(() => alert('Paste blocked. Use Ctrl+V instead.'));
                }
              });
        
              // Context menu items
              editor.ui.registry.addMenuItem('copyButton', {
                text: 'Copy',
                icon: 'copy',
                onAction: function () {
                    const selectedText = editor.selection.getContent({ format: 'text' });
                
                    if (!selectedText) {
                      alert('Please select some text to copy.');
                      return;
                    }
                
                    navigator.clipboard.writeText(selectedText)
                      .catch(() => alert('Clipboard copy failed. Use Ctrl+C instead.'));
                }
              });
        
              editor.ui.registry.addMenuItem('pasteButton', {
                text: 'Paste',
                icon: 'paste',
                onAction: () => {
                  navigator.clipboard.readText().then(text => {
                    if (text) {
                      editor.insertContent(text);
                    } else {
                      alert('Clipboard is empty.');
                    }
                  }).catch(() => {
                    alert('Paste blocked. Use Ctrl+V instead.');
                  });
                }
              });
            }
          });

    }

    $(document).ready(function(){
      initEditor();

      $('.select2').select2({
        placeholder: "Choose Any",
      });

      $(document).on('change', '.state', function() {
          var stateId = $(this).val();

          // Clear previous options
          $('.city').empty().append('<option value="">Loading...</option>');

          $.ajax({
          url: "{{ url('get-cities') }}/" + stateId,
          type: 'GET',
          success: function(response) {
              // Clear and append new city options
              $('.city').empty().append('<option value="">Select City</option>');
              $.each(response, function(index, city) {
              $('.city').append('<option value="' + index + '">' + city + '</option>');
              });

              // Refresh select2
              $('.city').trigger('change');
          },
          error: function(xhr) {
              $('.city').empty().append('<option value="">Error loading cities</option>');
              console.error("Failed to load cities:", xhr.responseText);
          }
          });
      });

      // $(".location").select2({
      //   placeholder: "Choose Any",
      //   ajax: {
      //       url: "{{ url('fetch-cities') }}", // Ensure the URL is a string, not Blade syntax
      //       dataType: 'json',
      //       delay: 250, // Delay the request to avoid flooding the server
      //       data: function (params) {
      //         console.log(params);
      //         return {
      //           term: params.term // Pass the search term to the server
      //         };
      //       },
      //       processResults: function (data) {
      //         return {
      //             results: data.map(function (item) {
      //                 return {
      //                     id: item.id, // Adjust the property name to match your data
      //                     text: item.name // Adjust the property name to match your data
      //                 };
      //             })
      //         };
      //       }
      //   },
      //   minimumInputLength: 3 // Trigger the request after 3 characters
      // });

      $(document).on('click','.file-remove',function(e){
        var values = $('#thumbnail').val().split(',');
        var click_value = $(e.target).data('url');
        if(values.includes(click_value)){
          values.splice(values.indexOf(click_value), 1);
        }
        var file_path = values.map(function (item) {
          return item;
        }).join(',');
        $('#thumbnail').val('').val(file_path).trigger('change');
        $(e.target).parent().remove();
      })

    })
</script>
@endsection