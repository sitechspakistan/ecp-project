@extends('layouts.backend')
@section('title', 'Editing Page')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/css/components.css')}}" />
<link rel="stylesheet" href="{{asset('assets_backend/css/bootstrap-tagsinput.css')}}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    .select2-container--default .select2-selection--multiple{
      background: transparent;
      border: 2px solid #cecece;
      padding: 11px;
      border-radius: 12px;
    }    
</style>
@endsection
@section('content')
<form action="{{route('pages.update', $data['id'])}}" method="POST">
    @csrf
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                Pages
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('pages.index')}}">Pages</a>
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
            <div class="col-md-3">
                <input type="text" name="title" class="form-control light-fields" id="page-title" placeholder="Page Title" required value="{{$data['title']}}">
                @csrf
            </div>
            <div class="col-md-2">
                <div class="slug-field">
                    <input type="text" name="slug" class="form-control light-fields" id="page-slug" placeholder="Page Slug" required value="{{$data['slug']}}">
                    <a href="javscript:;" class="text-dark" id="generateSlug"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <select name="parent_id" class="form-control light-fields">
                    <option value="">No Parent</option>
                    @foreach($pages as $p)
                    <option value="{{$p->id}}" {{($data['parent_id']==$p->id)?'selected':''}}>{{$p->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
              @php
                $activeMemberships = \App\Models\Membership::where('is_active', 1)->orderBy('code')->get();
                $selectedMemberships = array_map('strval', $data['memberships'] ?? []);
              @endphp
              <select name="memberships[]" class="form-control select2 light-fields" multiple>
                {{-- <option value="" disabled selected style="display:none">Required Membership</option> --}}
                @foreach($activeMemberships as $membership)
                  <option value="{{ $membership->code }}" @if(in_array((string) $membership->code, $selectedMemberships)) selected @endif>
                    {{ $membership->title }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-1">
                <a href="javascript:;" class="btn btn-info me-1 mb-3" data-bs-toggle="modal" data-bs-target="#comps-modal"><i class="fa fa-fw fa-plus me-1"></i></a>
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
        <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Page Editor</h3>
            </div>
            <div class="block-content" id="page-components">
                @if(!empty($components))
                @foreach($components as $key => $comp)
                    @component("backend.components.{$comp->type}",[ 'rand'=>$key,'meta'=>$comp['meta'] ]) {{$comp->title}} @endcomponent
                @endforeach
                @else
                <div id="no-comps">
                    <h1>Add your first component by <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#comps-modal">clicking here</a></h1>
                </div>
                @endif
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
                      <input type="text" class="js-maxlength form-control" id="meta_title" name="meta_title" data-always-show="true" data-placement="top" value="{{$data['meta_title']}}">
                      {{-- <div class="form-text">
                        55 Character Max
                      </div> --}}
                    </div>                
                    <div class="mb-3">
                      <label class="form-label" for="meta_desc">Description</label>
                      <textarea class="js-maxlength form-control" id="meta_desc" name="meta_desc" rows="4" data-always-show="true" data-placement="top">{{$data['meta_desc']}}</textarea>
                      {{-- <div class="form-text">
                        115 Character Max
                      </div> --}}
                    </div>                                            
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="og_tag" type="checkbox" id="og-tag" name="seo_meta[og_tag]" value="1" {{(isset($data['seo_meta']['og_tag']) && $data['seo_meta']['og_tag']=='1')?'checked':''}}>
                  <label class="form-check-label" for="og-tag">og: Open Graph</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="twitter_tag" type="checkbox" id="twitter-tag" name="seo_meta[twitter_tag]" value="1" {{(isset($data['seo_meta']['twitter_tag']) && $data['seo_meta']['twitter_tag']=='1')?'checked':''}}>
                  <label class="form-check-label" for="twitter-tag">Twitter Tags</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="schema" type="checkbox" id="schema-tag" name="seo_meta[is_schema]" value="1" {{(isset($data['seo_meta']['is_schema']) && $data['seo_meta']['is_schema']=='1')?'checked':''}}>
                  <label class="form-check-label" for="schema-tag">Schema Code</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="tags" type="checkbox" id="meta-tags" name="seo_meta[is_tags]" value="1" {{(isset($data['seo_meta']['is_tags']) && $data['seo_meta']['is_tags']=='1')?'checked':''}}>
                  <label class="form-check-label" for="meta-tags">Meta Keywords</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="scripts" type="checkbox" id="script_tags" name="seo_meta[script_tags]" value="1" {{(isset($data['seo_meta']['script_tags']) && $data['seo_meta']['script_tags']=='1')?'checked':''}}>
                  <label class="form-check-label" for="script_tags">Custom Scripts</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input seo-switch" data-type="canonicals" type="checkbox" id="is_canonicals" name="seo_meta[is_canonicals]" value="1" {{(isset($data['seo_meta']['is_canonicals']) && $data['seo_meta']['is_canonicals']=='1')?'checked':''}}>
                  <label class="form-check-label" for="is_canonicals">Link Canonicals</label>
                </div>
              </div>
              <div class="form-group col-md-4">
                <div class="form-check form-switch form-check-inline">
                  <input class="form-check-input" type="checkbox" id="is_login" name="is_login" value="1" {{(isset($data['is_login']) && $data['is_login']=='1')?'checked':''}}>
                  <label class="form-check-label" for="is_login">On Login</label>
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
            <div class="row mb-4" id="schema_div" @if(isset($data['seo_meta']['is_schema'])) @if($data['seo_meta']['is_schema'] == null) style="display:none;" @endif @else style="display:none;" @endif>
              <hr>
              <h5 style="padding-left: 20px;">Schema Code</h5>
              <hr>
              <div class="col-md-12">
                  <textarea name="schema_code" class="form-control" cols="30" rows="10">{!! $data['schema_code']??'' !!}</textarea>
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
              <div class="row mb-4" id="scripts_div" @if(isset($data['seo_meta']['script_tags'])) @if($data['seo_meta']['script_tags'] == null) style="display:none;" @endif @else style="display:none;" @endif>
                <hr>
                <h5 style="padding-left: 20px;">Custom Scripts</h5>
                <hr>
                <div class="col-md-12">
                  <textarea name="seo_meta[scripts]" class="form-control" cols="30" rows="6">{!! $data['seo_meta']['scripts']??'' !!}</textarea>
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
          <div class="block block-rounded mt-3">
            <div class="block-header block-header-default">
              <h3 class="block-title">Custom CSS</h3>
            </div>
            <div class="block-content">
              <div class="row justify-content-center">
                <div class="form-group mb-4 col-md-12">
                  <textarea name="custom_css" class="form-control" cols="30" rows="10">{!! $data['custom_css']??'' !!}</textarea>              
                </div>
              </div>
            </div>
            </div>
    </div>
</form>
<div class="modal fade" id="comps-modal" tabindex="-1" role="dialog" aria-labelledby="comps-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-slideup" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Select Components</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
            @component('backend.pages.components') @endcomponent
          </div>          
        </div>
      </div>
    </div>
</div>
<div class="modal" id="icons-modal" tabindex="-1" role="dialog" aria-labelledby="icons-modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Icons List</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
            <ul class="p-icons-list">
                <li><a class="add-icon"><i class="fa fa-bell"></i></a> fa fa-bell</li>
                <li><a class="add-icon"><i class="fa fa-book"></i></a> fa fa-book</li>
                <li><a class="add-icon"><i class="fa fa-calendar"></i></a> fa fa-calendar</li>
                <li><a class="add-icon"><i class="fa fa-camera"></i></a> fa fa-camera</li>
                <li><a class="add-icon"><i class="fa fa-check"></i></a> fa fa-check</li>
                <li><a class="add-icon"><i class="fa fa-cog"></i></a> fa fa-cog</li>
                <li><a class="add-icon"><i class="fa fa-comments"></i></a> fa fa-comments</li>
                <li><a class="add-icon"><i class="fa fa-envelope"></i></a> fa fa-envelope</li>
                <li><a class="add-icon"><i class="fa fa-file"></i></a> fa fa-file</li>
                <li><a class="add-icon"><i class="fa fa-flag"></i></a> fa fa-flag</li>
                <li><a class="add-icon"><i class="fa fa-folder"></i></a> fa fa-folder</li>
                <li><a class="add-icon"><i class="fa fa-globe"></i></a> fa fa-globe</li>
                <li><a class="add-icon"><i class="fa fa-heart"></i></a> fa fa-heart</li>
                <li><a class="add-icon"><i class="fa fa-home"></i></a> fa fa-home</li>
                <li><a class="add-icon"><i class="fa fa-lock"></i></a> fa fa-lock</li>
                <li><a class="add-icon"><i class="fa fa-music"></i></a> fa fa-music</li>
                <li><a class="add-icon"><i class="fa fa-paperclip"></i></a> fa fa-paperclip</li>
                <li><a class="add-icon"><i class="fa fa-pencil"></i></a> fa fa-pencil</li>
                <li><a class="add-icon"><i class="fa fa-phone"></i></a> fa fa-phone</li>
                <li><a class="add-icon"><i class="fa fa-power-off"></i></a> fa fa-power-off</li>
                <li><a class="add-icon"><i class="fa fa-search"></i></a> fa fa-search</li>
                <li><a class="add-icon"><i class="fa fa-shopping-cart"></i></a> fa fa-shopping-cart</li>
                <li><a class="add-icon"><i class="fa fa-star"></i></a> fa fa-star</li>
                <li><a class="add-icon"><i class="fa fa-table"></i></a> fa fa-table</li>
                <li><a class="add-icon"><i class="fa fa-tag"></i></a> fa fa-tag</li>
                <li><a class="add-icon"><i class="fa fa-thumbs-down"></i></a> fa fa-thumbs-down</li>
                <li><a class="add-icon"><i class="fa fa-thumbs-up"></i></a> fa fa-thumbs-up</li>
                <li><a class="add-icon"><i class="fa fa-trash"></i></a> fa fa-trash</li>
                <li><a class="add-icon"><i class="fa fa-user"></i></a> fa fa-user</li>
                <li><a class="add-icon"><i class="fa fa-users"></i></a> fa fa-users</li>
                <li><a class="add-icon"><i class="fa fa-video-camera"></i></a> fa fa-video-camera</li>
                <li><a class="add-icon"><i class="fa fa-wrench"></i></a> fa fa-wrench</li>
            </ul>
          </div>          
        </div>
      </div>
    </div>
</div>
@endsection
@section('customScripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.tiny.cloud/1/0yvf3vk68hoq40p5mad0iy4otzessy9gdxx3hplqo6kf2plj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Required Membership",
        containerCssClass: 'myContainerCssClass'
      });
    });
</script>
@include('backend.pages.comp_scripts')
@endsection