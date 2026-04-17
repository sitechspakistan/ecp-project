@extends('layouts.frontend')
@section('title', 'Edit Blog | East Coast Puppies')

@section('customStyles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets_backend/css/bootstrap-tagsinput.css')}}" />

    <style>
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{
            border-color: transparent #666 #666 transparent;
            border-width: 0 2px 2px 0px;
        }
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
        .bootstrap-tagsinput{width:100%;}
        input::file-selector-button {
            min-height: 52px;
        }
    </style>
@endsection

@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Edit Blog</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->

    <!-- Edit Blog Content -->
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

                    <form action="{{route('frontblog.update', $blog['id'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4>Basic information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <input type="hidden"  name="sort_order" value="{{ ($blog->sort_order)??'' }}">
                                    <input type="hidden" name="views_count" value="{{ ($blog->views_count)??'' }}">

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control pass-input" placeholder="Title" name="title" id="page-title" required value="{{ ($blog->title)??'' }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Publish Date</label>
                                        <input type="date" class="form-control pass-input" placeholder="Publish Date" name="publish_date" value="{{ ($blog->publish_date)??'' }}">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Author</label>
                                        <input type="text" class="form-control pass-input" placeholder="Author" name="author" value="{{ ($blog->author)??'' }}">
                                    </div>

                                    <!-- Featured Product Image Section -->
                                    <div class="col-lg-6 col-md-6 featured-img1" style="position:relative;">
                                        <h6 class="media-title">Featured Image <span class="text-danger">*</span></h6>
                                        <input type="file" name="image" accept="image/*" class="hide-input image-upload" id="featuredFile" onchange="handleFeaturedImage(event)">
                                        <div id="featuredDropzone" class="media-image dropzone">
                                            @if(isset($blog->image))
                                                <img src="{{ url($blog->image) }}" alt="{{ ($blog->title)??'' }}" />
                                            @else
                                                <div class="dropzone-message">
                                                    <span class="file-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                                    <p>Drag & Drop image here or click to upload</p>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- <div id="featuredPreview" class="preview-container"></div> --}}
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label class="col-form-label label-heading">Category </label>
                                           <div class="row category-listing">
                                            <div class="col-lg-4">
                                                 <ul>
                                                    @foreach($categories as $k => $cat)
                                                        <li>
                                                            <label class="custom_check" for="catCheck{{$cat->id}}">
                                                                <input type="checkbox" id="catCheck{{$cat->id}}" name="categories[]" value="{{$cat->id}}" {{(in_array($cat->id, $current_cats))?'checked':''}}>
                                                                <span class="checkmark"></span> {{$cat->title}}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4>Blog Description</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="col-form-label">Short Description</label>
                                        <textarea class="form-control pass-input" rows="10" placeholder="Short Description" name="short_description">{{ ($blog->short_description)??'' }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-2">
                                        <label class="col-form-label">Description</label>
                                        <textarea class="form-control pass-input editor" placeholder="Description" name="description">{!! ($blog->description)??'' !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="card">
                            <div class="card-header">
                                <h4>Blog Seo</h4>
                            </div>
                            <div class="card-body">

                                <!-- Meta -->
                                <div class="row">
                                    <hr>
                                        <h5 style="padding-left: 20px;">Meta TAGS</h5>
                                    <hr>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Title</label>
                                        <input type="text" class="js-maxlength form-control pass-input" placeholder="Meta Title" id="meta_title" name="seo_meta[meta_title]" data-always-show="true" data-placement="top">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="col-form-label">Description</label>
                                        <textarea class="js-maxlength form-control pass-input" id="meta_desc" name="seo_meta[meta_description]" rows="4" data-always-show="true" data-placement="top"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="col-form-label">Keywords</label>
                                        <input type="text" class="form-control pass-input" data-role="tagsinput" name="seo_meta[meta_tags]">
                                    </div>
                                </div>

                                <!-- OG -->
                                <div class="row mb-4" id="og_tag_div">
                                    <hr>
                                    <h5 style="padding-left: 20px;">OG TAGS</h5>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control pass-input" name="seo_meta[og][title]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">URL</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control pass-input" name="seo_meta[og][url]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Type</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control pass-input" name="seo_meta[og][type]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">OG Image</label>
                                            <input type="file" class="form-control" name="seo_meta[og][image]" style="padding: 6px 12px;">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control pass-input" name="seo_meta[og][description]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Twitter -->
                                <div class="row mb-4" id="twitter_tag_div">
                                    <hr>
                                    <h5 style="padding-left: 20px;">Twitter Tag</h5>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Title</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control pass-input" name="seo_meta[twitter][title]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">URL</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control pass-input" name="seo_meta[twitter][url]">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Card</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control pass-input" name="seo_meta[twitter][card]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="seo_meta[twitter][image]" style="padding: 6px 12px;">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Description</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control pass-input" name="seo_meta[twitter][description]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}

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
    <!-- /Edit Blog Content -->
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

    const featuredDropzone = document.getElementById("featuredDropzone");

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
            const previewContainer = document.getElementById("featuredDropzone");
            previewContainer.innerHTML = ""; // Clear previous preview

            const img = document.createElement("img");
            img.src = e.target.result;

            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection
