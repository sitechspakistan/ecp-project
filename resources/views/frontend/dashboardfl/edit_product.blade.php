@extends('layouts.frontend')
@section('title', 'Edit Puppies | East Coast Puppies')

@section('customStyles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{
            border-color: transparent #666 #666 transparent;
            border-width: 0 2px 2px 0px;
        }
        /* General Dropzone Styles */
        .dropzone {
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            display: block;
            position: relative;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            height: 200px;
            padding: 5px 10px;
            font-size: 14px;
            line-height: 22px;
            color: #777;
            background-color: #FFF;
            background-image: none;
            text-align: center;
            border: 2px solid #E5E5E5;
            -webkit-transition: border-color .15s linear;
            transition: border-color .15s linear;
        }
        .dropzone .dropzone-message{
            position: relative;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .dropzone .dropzone-message span.file-icon {
            font-size: 50px;
            color: #CCC;
        }
        .dropzone .dropzone-message p {
            margin: 5px 0 0;
        }
        .dropzone:hover {
            background-size: 30px 30px;
            background-image: -webkit-linear-gradient(135deg, #F6F6F6 25%, transparent 25%, transparent 50%, #F6F6F6 50%, #F6F6F6 75%, transparent 75%, transparent);
            background-image: linear-gradient(-45deg, #F6F6F6 25%, transparent 25%, transparent 50%, #F6F6F6 50%, #F6F6F6 75%, transparent 75%, transparent);
            -webkit-animation: stripes 2s linear infinite;
            animation: stripes 2s linear infinite;
        }
        .dropzone img{
            top: 50%;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
            position: relative;
            max-width: 100%;
            max-height: 100%;
            background-color: #FFF;
            -webkit-transition: border-color .15s linear;
            transition: border-color .15s linear;
        }
        .hide-input {
            /* opacity:0;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0; */
            display:none;
        }

        /* Image Preview Container */
        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        .preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 0 20px 0 0;
        }
        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .remove-btn {
            position: absolute;
            background-color: rgba(255, 0, 0, 0.7);
            color: #fff;
            border: none;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 18px;
            cursor: pointer;
            display: flex;
            top: 5px;
            right: 5px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            font-size: 11px;
        }

        @-webkit-keyframes stripes {
            from {
                background-position: 0 0
            }

            to {
                background-position: 60px 30px
            }
        }

        @keyframes stripes {
            from {
                background-position: 0 0
            }

            to {
                background-position: 60px 30px
            }
        }
    </style>
@endsection

@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Edit Puppies</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Puppies</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->

    <!-- Edit Puppies Content -->
    <div class="dashboard-content">
        <div class="container">
            @include('frontend.includes.dashboard_menu')
            <div class="profile-content">
                <div class="messages-form">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('frontproducts.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4>Basic information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <input type="hidden"  name="sort_order" value="{{ $product->sort_order ?? 0 }}">
                                    <input type="hidden" name="shipping" value="{{ $product->shipping ?? 0 }}">
                                    <!-- <input type="hidden" name="quantity" value="0"> -->

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control pass-input" placeholder="Name" name="title" id="page-title" required value="{{ $product->title ?? '' }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control pass-input select2" required>
                                            <option value="" disabled selected style="visible:hidden">No Category</option>
                                            @foreach($categories as $k => $category)
                                            <optgroup label="{{ ($k === 1) ? 'DOGS BREED' : (($k === 2) ? 'PET PRODUCT' : (($k === 3) ? 'PET SUPPLIES' : '')) }}">
                                                @foreach($category as $cat)
                                                <option value="{{$cat->id}}" @if($product->category_id == $cat->id) selected @endif>{{$cat->title}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">State <span class="text-danger">*</span></label>
                                        <select name="state_id" class="form-control pass-input select2 state" required>
                                            <option value="" disabled selected style="visible:hidden">Select Any</option>
                                            @foreach($states as $k => $state)
                                                <option value="{{$k}}" @if($product->state_id == $k) selected @endif>{{$state}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">City <span class="text-danger">*</span></label>
                                        <select name="location_id" class="form-control pass-input select2 city" required>
                                            <option value="" disabled selected style="visible:hidden">Select Any</option>
                                            @foreach($cities as $k => $city)
                                                <option value="{{$k}}" @if($product->location_id == $k) selected @endif>{{$city}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Min Offer Price <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control pass-input" placeholder="Cost Price" required step=".1" name="cost_price" value="{{ $product->cost_price ?? 0 }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Sell Price <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control pass-input" placeholder="Sell Price" required min="1" step=".1" name="sell_price" value="{{ $product->sell_price ?? 0 }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Quantity <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control pass-input" placeholder="Quantity" required min="1" name="quantity" value="{{ $product->quantity ?? 0 }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Gender <span class="text-danger">*</span></label>
                                        <select name="gender" class="form-control pass-input" required>
                                            <option value="" disabled selected style="visible:hidden">Select Any</option>
                                            <option value="male" @if($product->gender == 'male') selected @endif>Male</option>
                                            <option value="female">Female</option>
                                            <option value="female" @if($product->gender == 'female') selected @endif>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Color/Markings</label>
                                        <input type="text" name="color_markings" class="form-control pass-input" placeholder="Color/Markings" value="{{ $product->color_markings ?? '' }}">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Potential</label>
                                        <select name="potential" class="form-control pass-input">
                                            <option value="">Select</option>
                                            <option value="Show" @selected(old('potential', $product->potential ?? '') === 'Show')>Show</option>
                                            <option value="Pet" @selected(old('potential', $product->potential ?? '') === 'Pet')>Pet</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Champion Bloodlines</label>
                                        <select name="champion_bloodlines" class="form-control pass-input">
                                            <option value="No" @selected(old('champion_bloodlines', $product->champion_bloodlines ?? 'No') === 'No')>No</option>
                                            <option value="Yes" @selected(old('champion_bloodlines', $product->champion_bloodlines ?? 'No') === 'Yes')>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Champion Sired</label>
                                        <select name="champion_sired" class="form-control pass-input">
                                            <option value="No" @selected(old('champion_sired', $product->champion_sired ?? 'No') === 'No')>No</option>
                                            <option value="Yes" @selected(old('champion_sired', $product->champion_sired ?? 'No') === 'Yes')>Yes</option>
                                        </select>
                                    </div>
                                    @php
                                        $vaccDef = is_numeric($product->vaccinations ?? null) && (int) $product->vaccinations === 1 ? '1' : '0';
                                        $hcDef = is_numeric($product->health_certificate ?? null) && (int) $product->health_certificate === 1 ? '1' : '0';
                                        $hrDef = is_numeric($product->health_record ?? null) && (int) $product->health_record === 1 ? '1' : '0';
                                    @endphp
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Vaccinations &amp; Deworming</label>
                                        <select name="vaccinations" class="form-control pass-input">
                                            <option value="0" @selected(old('vaccinations', $vaccDef) == '0')>No</option>
                                            <option value="1" @selected(old('vaccinations', $vaccDef) == '1')>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Health Certificate</label>
                                        <select name="health_certificate" class="form-control pass-input">
                                            <option value="0" @selected(old('health_certificate', $hcDef) == '0')>No</option>
                                            <option value="1" @selected(old('health_certificate', $hcDef) == '1')>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Health Record</label>
                                        <select name="health_record" class="form-control pass-input">
                                            <option value="0" @selected(old('health_record', $hrDef) == '0')>No</option>
                                            <option value="1" @selected(old('health_record', $hrDef) == '1')>Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Age</label>
                                        <input type="date" class="form-control pass-input" name="age" value="{{ $product->age ?? '' }}" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Product Listing Date</label>
                                        <input type="date" class="form-control pass-input" name="product_listing" value="{{ $product->product_listing ?? '' }}" />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Date Photographed <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control pass-input" name="photo_date" value="{{ $product->photo_date ?? '' }}" required />
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Size <span class="text-danger">*</span></label>
                                        <select name="size" class="form-control pass-input">
                                            <option value="" disabled selected style="visible:hidden">Select Any</option>
                                            <option value="small" @if($product->size == 'small') selected @endif>Small</option>
                                            <option value="medium" @if($product->size == 'medium') selected @endif>Medium</option>
                                            <option value="large" @if($product->size == 'large') selected @endif>Large</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-4 form-group">
                                        <label class="col-form-label">Available Color</label>
                                        <input type="text" name="avaiable_color" class="form-control pass-input" placeholder="Available Color" value="{{ ($data['avaiable_color'])??'' }}">
                                    </div> --}}
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label"></label>
                                        <ul>
                                            <li>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="health_warranty" @if($product->health_warranty*1 == 1) checked @endif>
                                                    <span class="checkmark"></span> Health Warranty
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>Product Description</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-md-12 form-group">
                                        <label class="col-form-label">Short Description</label>
                                        <textarea class="form-control pass-input" rows="10" placeholder="Short Description" name="short_description"></textarea>
                                    </div> -->
                                    <div class="col-md-12 form-group mb-2">
                                        <label class="col-form-label">Description</label>
                                        <textarea class="form-control pass-input editor" placeholder="Description" name="description">{{ $product->description ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>SEO</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="col-form-label">Meta title</label>
                                        <input type="text" class="form-control pass-input" name="meta_title" placeholder="Meta title" value="{{ $product->meta_title ?? '' }}">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="col-form-label">Meta description</label>
                                        <textarea class="form-control pass-input" name="meta_description" rows="4" placeholder="Meta description">{{ $product->meta_description ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-0">
                                        <label class="col-form-label">Meta keywords</label>
                                        <input type="text" class="form-control pass-input" name="seo_meta[meta_tags]" placeholder="e.g. puppy, breed, for sale (comma-separated)" value="{{ data_get($product->seo_meta, 'meta_tags', '') }}">
                                        <input type="hidden" name="seo_meta[is_tags]" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card media-section">
                            <div class="card-header">
                                <h4>Media Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Featured Product Image Section -->
                                    <div class="col-lg-6 col-md-6 featured-img1" style="position:relative;">
                                        <h6 class="media-title">Product Image <span class="text-danger">*</span></h6>
                                        <input type="file" name="image" accept="image/*" class="hide-input image-upload" id="featuredFile" onchange="handleFeaturedImage(event)">
                                        <div id="featuredDropzone" class="media-image dropzone">
                                            @if(isset($product->image))
                                                <img src="{{ url($product->image) }}" alt="{{ $product->title ?? '' }}" />
                                            @else
                                                <div class="dropzone-message">
                                                    <span class="file-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                                    <p>Drag & Drop image here or click to upload</p>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <div id="featuredPreview" class="preview-container"></div> --}}
                                    </div>
                                </div>

                                <!-- Gallery Upload Section -->
                                <div class="gallery-media" style="position:relative;">
                                    <h6 class="media-title">Gallery</h6>
                                    <div id="galleryDropzone" class="galleryimg-upload dropzone">
                                        <div class="dropzone-message">
                                            <span class="file-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                            <p>Drag & Drop image here or click to upload</p>
                                        </div>
                                    </div>
                                    <input type="file" accept="image/*" multiple class="hide-input image-upload" id="galleryFile" onchange="handleGalleryImages(event)" name="gallery[]">
                                    <!-- Hidden input to track existing gallery images -->
                                    <input type="hidden" name="existing_gallery" id="existingGallery" value="{{ isset($product->gallery) ? json_encode($product->gallery) : '[]' }}">
                                    <!-- Hidden input to track removed gallery images -->
                                    <input type="hidden" name="removed_gallery" id="removedGallery" value="[]">
                                    <div id="galleryPreview" class="galleryimg-upload">
                                        @if(isset($product->gallery))
                                            @foreach($product->gallery as $key => $gallery)
                                                <div class="preview-item" data-gallery-path="{{ $gallery }}" data-is-existing="true">
                                                    <img class="img-fluid" src="{{ url($gallery) }}" alt="{{ $product->title ?? '' }}"/>
                                                    <button type="button" class="remove-btn"><i class="feather-trash-2"></i></button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                    {{-- <div class="card">
                        <div class="card-header">
                            <h4>Product Gallery</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">
                                <!-- Custom Dropzone -->
                                <div id="customDropzone" class="dropzone">
                                <p>Drag & Drop images here or click to upload</p>
                                <input id="fileInput" type="file" multiple accept="image/*" onchange="previewImages(event)" name="gallery[]">
                                </div>
                                <div id="previewContainer" class="preview-container row mt-3"></div>
                            </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Puppies Content -->
@endsection

@section('customScripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.tiny.cloud/1/0yvf3vk68hoq40p5mad0iy4otzessy9gdxx3hplqo6kf2plj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('assets_backend/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

    function initEditor() {
        tinymce.init({
          selector: '.editor',
          plugins: 'anchor autolink charmap emoticons image link lists media searchreplace table visualblocks wordcount media linkchecker code textcolor',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | link image media table | align lineheight | numlist bullist indent outdent | removeformat | code',
          menubar: false,
          file_picker_types: 'image',
          image_dimensions: false,
          relative_urls: false,
          remove_script_host: false,
          branding: false,
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

    //   $(".state").select2({
    //     placeholder: "Choose Any",
    //     ajax: {
    //         url: "{{ url('fetch-states') }}", // Ensure the URL is a string, not Blade syntax
    //         dataType: 'json',
    //         delay: 250, // Delay the request to avoid flooding the server
    //         data: function (params) {
    //           console.log(params);
    //           return {
    //             term: params.term // Pass the search term to the server
    //           };
    //         },
    //         processResults: function (data) {
    //           return {
    //               results: data.map(function (item) {
    //                   return {
    //                       id: item.id, // Adjust the property name to match your data
    //                       text: item.name // Adjust the property name to match your data
    //                   };
    //               })
    //           };
    //         }
    //     },
    //     minimumInputLength: 3 // Trigger the request after 3 characters
    //   });

    //   $(".location").select2({
    //     placeholder: "Choose Any",
    //     ajax: {
    //         url: "{{ url('fetch-cities') }}", // Ensure the URL is a string, not Blade syntax
    //         dataType: 'json',
    //         delay: 250, // Delay the request to avoid flooding the server
    //         data: function (params) {
    //           console.log(params);
    //           return {
    //             term: params.term // Pass the search term to the server
    //           };
    //         },
    //         processResults: function (data) {
    //           return {
    //               results: data.map(function (item) {
    //                   return {
    //                       id: item.id, // Adjust the property name to match your data
    //                       text: item.name // Adjust the property name to match your data
    //                   };
    //               })
    //           };
    //         }
    //     },
    //     minimumInputLength: 3 // Trigger the request after 3 characters
    //   });

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
{{-- Dropzone --}}
<script>
    const featuredDropzone = document.getElementById("featuredDropzone");
  const galleryDropzone = document.getElementById("galleryDropzone");

  // Handle Featured Image
  featuredDropzone.addEventListener("click", () => {
    document.getElementById("featuredFile").click();
  });

  featuredDropzone.addEventListener("dragover", (e) => {
    e.preventDefault();
    featuredDropzone.style.backgroundColor = "#e0f7fa";
  });

  featuredDropzone.addEventListener("dragleave", () => {
    featuredDropzone.style.backgroundColor = "#f9f9f9";
  });

  featuredDropzone.addEventListener("drop", (e) => {
    e.preventDefault();
    featuredDropzone.style.backgroundColor = "#f9f9f9";
    handleFeaturedImage({ target: { files: e.dataTransfer.files } });
  });

  function handleFeaturedImage(event) {
    const file = event.target.files[0];
    if (!file || !file.type.startsWith("image/")) return;

    const reader = new FileReader();
    reader.onload = (e) => {
      const previewContainer = document.getElementById("featuredPreview");
      previewContainer.innerHTML = ""; // Clear previous preview
      const previewItem = document.createElement("div");
      previewItem.className = "preview-item";

      const img = document.createElement("img");
      img.src = e.target.result;

      previewItem.appendChild(img);
      previewContainer.appendChild(previewItem);
    };
    reader.readAsDataURL(file);
  }

  // Handle Gallery Images
  galleryDropzone.addEventListener("click", () => {
    document.getElementById("galleryFile").click();
  });

  galleryDropzone.addEventListener("dragover", (e) => {
    e.preventDefault();
    galleryDropzone.style.backgroundColor = "#e0f7fa";
  });

  galleryDropzone.addEventListener("dragleave", () => {
    galleryDropzone.style.backgroundColor = "#f9f9f9";
  });

  galleryDropzone.addEventListener("drop", (e) => {
    e.preventDefault();
    galleryDropzone.style.backgroundColor = "#f9f9f9";
    handleGalleryImages({ target: { files: e.dataTransfer.files } });
  });

  function handleGalleryImages(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById("galleryPreview");

    [...files].forEach((file) => {
      if (!file.type.startsWith("image/")) return;

      const reader = new FileReader();
      reader.onload = (e) => {
        const previewItem = document.createElement("div");
        previewItem.className = "preview-item";

        const img = document.createElement("img");
        img.className = "img-fluid";
        img.src = e.target.result;

        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.className = "remove-btn";
        removeBtn.innerHTML = "<i class='feather-trash-2'></i>";

        previewItem.appendChild(img);
        previewItem.appendChild(removeBtn);
        previewContainer.appendChild(previewItem);
      };
      reader.readAsDataURL(file);
    });
  }

  // Handle removal of gallery images
  document.addEventListener('click', function(e) {
    const galleryPreview = document.getElementById('galleryPreview');
    if (galleryPreview && e.target.closest('#galleryPreview .remove-btn')) {
      const removeBtn = e.target.closest('.remove-btn');
      const previewItem = removeBtn.closest('.preview-item');
      if (previewItem) {
        // Check if this is an existing image from database
        const isExisting = previewItem.getAttribute('data-is-existing') === 'true';
        const galleryPath = previewItem.getAttribute('data-gallery-path');
        
        if (isExisting && galleryPath) {
          // Track removed existing images
          const removedGalleryInput = document.getElementById('removedGallery');
          let removedGallery = [];
          try {
            removedGallery = JSON.parse(removedGalleryInput.value || '[]');
          } catch (e) {
            removedGallery = [];
          }
          
          // Add to removed list if not already there
          if (!removedGallery.includes(galleryPath)) {
            removedGallery.push(galleryPath);
            removedGalleryInput.value = JSON.stringify(removedGallery);
          }
        }
        
        // Remove from DOM
        previewItem.remove();
      }
    }
  });
</script>
@endsection

@section('customScripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $(document).on('click','.addToCart',function(){
            $this = $(this);
            var btntext = $this.html(); $this.text("Adding..");
            $this.removeClass('addToCart');
            var qty = $(this).attr('data-qty');
            if(qty==0){
                toastr["error"]("Quantity can't be zero");
                $this.html(btntext);
                return false;
            }
            var discount = $(this).attr('data-discount');
            var discount_price = $(this).attr('data-discount_price');
            var offer_id = $(this).attr('data-offer_id');
            var data = {'_token':"{{csrf_token()}}",'product_id':$(this).data('id'),'qty':qty,'discount':discount,'discount_price':discount_price,'offer_id':offer_id};
            $.ajax({
                url:'{{route("addToCart")}}',
                type: 'post',
                data: data,
                success: function(data){
                    if(data.status=="added") {
                        location.href = "{{route('cartPage')}}";
                    }else if(data.status=="error"){
                        toastr["error"](data.msg);
                    }
                    $this.html(btntext);
                    $this.addClass('addToCart');
                }
            })
        })
    </script>


@endsection
