@extends('layouts.backend')
@section('title', 'Edit Album')
@section('customStyles')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
    ul#albumGallery {
        display: flex;
        flex-wrap: wrap;
        direction: ltr;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 8px;
    }

    ul#albumGallery li {
        width: 150px;
        height: 150px;
        border: 1px solid #cecece;
        border-radius: 10px;
        padding: 5px;
        position: relative;
    }

    a.remove-gal {
        background-color: red;
        width: 96%;
        display: block;
        text-align: center;
        color: #fff;
        font-size: 12px;
        text-decoration: none;
        border-radius: 20px;
        position: absolute;
        bottom: 3px;
        left: 3px;
    }

    ul#albumGallery li.add-gal a {
        text-decoration: none;
        color: #c9c9c9;
        font-size: 50px;
        text-align: center;
        font-weight: 100;
    }

    ul#albumGallery li.add-gal {
        text-align: center;
        align-content: center;
    }

    img.img-responsive.img-selection.img-thumbnail.img-thumbnail-set {}

    ul#albumGallery li img {
        width: 100%;
        border: none;
        height: 119px;
        object-fit: contain;
    }
    .sortable-placeholder {
        border: 2px dashed #cecece;
        background-color: #f0f0f0;
        height: 150px;
        width: 150px;
        margin: 5px;
        border-radius: 10px;
    }
</style>
@endsection
@section('content')
<form action="{{route('albums.update', $data['id'])}}" method="POST" id="albumForm">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                Album
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('albums.index')}}">Album</a>
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
                <div class="col-md-6">
                    <input type="text" name="title" class="form-control light-fields" id="page-title" placeholder="Page Title" required value="{{$data['title']}}">
                    @csrf
                </div>
                <div class="col-md-6">
                    <div class="slug-field">
                        <input type="text" name="slug" class="form-control light-fields" id="page-slug" placeholder="Page Slug" required value="{{$data['slug']}}">
                        <a href="javscript:;" class="text-dark" id="generateSlug"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>                
                <div class="col-md-12 mt-2">
                    <input type="text" name="description" class="form-control light-fields" placeholder="Description" value="{{$data['description']}}">
                </div>                
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Gallery <small>(Ideal Sizes should be 500 x 335 pixels)</small></h3>
                    </div>
                    <div class="block-content block-content-full">
                        <ul id="albumGallery">
                            @if(!empty($data['gallery']))
                            @foreach($data['gallery'] as $k => $gal)
                            <li>
                                <div class="image-placeholder" data-input="galInp-{{$k}}" data-preview="galItem-{{$k}}" id="galItem-{{$k}}">
                                    <img src="{{$gal}}" class="img-responsive img-selection img-thumbnail img-thumbnail-set">
                                </div>
                                <input type="hidden" id="galInp-{{$k}}" name="gallery[]" value="{{$gal}}">
                                <a href="javascript:;" class="remove-gal"><i class="fa fa-times"></i> remove</a>
                            </li>
                            @endforeach
                            @endif
                            <li class="add-gal">
                                <a href="javascript:;" id="addGal"><i class="fa fa-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">                
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                      <h3 class="block-title">Featured Image</h3>
                    </div>
                    <div class="block-content p-1">
                        <div class="form-group">
                            <div class="image-placeholder" data-input="itemPicture" data-preview="itemPimg" id="itemPimg">
                                <img src="{{$data['image']}}" class="img-responsive img-selection img-thumbnail img-thumbnail-set">
                            </div>
                            <input type="hidden" id="itemPicture" name="image" value="{{$data['image']}}">
                            <strong>Image Size: <small>500 x 335 pixels</small></strong>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
@section('customScripts')
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).on('click','#generateSlug',function() {
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
    $("#albumGallery").sortable({
        placeholder: "sortable-placeholder",
        cursor: "move",
        cancel: ".add-gal"
    });
    $("#albumGallery").disableSelection();
</script>
<script>
    $('#addGal').click(function(){
        var um = Math.floor(Math.random() * 99999);
        $("#albumGallery").prepend(`<li>
            <div class="image-placeholder" data-input="galInp-`+um+`" data-preview="galItem-`+um+`" id="galItem-`+um+`">
                <img src="{{asset('placeholder.png')}}" class="img-responsive img-selection img-thumbnail img-thumbnail-set">
            </div>
            <input type="hidden" id="galInp-`+um+`" name="gallery[]">
            <a href="javascript:;" class="remove-gal"><i class="fa fa-times"></i> remove</a>
        </li>`);
        $('.image-placeholder').filemanager('image');
        $("#albumGallery").sortable({
            placeholder: "sortable-placeholder",
            cursor: "move",
            cancel: ".add-gal"
        });
        $("#albumGallery").disableSelection();
    });
    $(document).on('click', '.remove-gal', function(){
        $(this).parent().remove();
    });
</script>
@endsection