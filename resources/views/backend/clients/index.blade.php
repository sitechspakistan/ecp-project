@extends('layouts.backend')
@section('title', 'Clients')
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
            Clients
          </h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Clients
            </li>
          </ol>
        </div>
        <form action="{{route('clients.delete')}}" method="POST" id="del_form" form="del_form">
            {{csrf_field()}}
            <button class="btn btn-outline-danger me-1 mb-3" type="button" id="deleteAll"> <i class="fas fa-trash-alt"></i> Delete </button>        
        </form>
        <a href="javascript:;" class="btn btn-outline-success me-1 mb-3"  data-bs-toggle="modal" data-bs-target="#addNewModal">
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
        <h3 class="block-title">All Clients</h3>
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
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('clients.status', $v->id)}}" data-bs-toggle="tooltip" title="{{($v->is_active==1)?'Un-publish':'Publish'}}">
                    <i class="fa fa-fw {{($v->is_active==1)?'fa-eye-slash':'fa-eye'}}"></i>
                  </a>
                  <a class="btn btn-sm btn-alt-secondary edit-client" data-url="{{route('clients.update', $v->id)}}" data-title="{{$v->title}}" data-image="{{$v->image}}" data-order="{{$v->sort_order}}" data-link="{{$v->link}}" href="javascript:;" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa fa-fw fa-pencil"></i>
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
<div class="modal" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{route('clients.store')}}" method="POST">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Add New Client</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">            
            <div class="form-group">
                <label for="">Image</label>
                <div class="input-group pull-left">
                    <span class="input-group-btn">
                        <a data-input="imgClient" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                    </span>
                    <input id="imgClient" class="form-control input-sm" type="text" name="image" required>
                </div>
            </div>
            <div class="form-group pb-1">
              <label for="">Name</label>
              <input type="text" class="form-control" placeholder="Title" name="title" required>
            </div>
            <div class="form-group pb-1">
              <label for="">Link</label>
              <input type="text" class="form-control" placeholder="Link" name="link">
            </div>
            <div class="form-group pb-1">
              <label for="">Sort Order</label>
              <input type="number" class="form-control" placeholder="Sort Order" required value="0" min="0" step="1" name="sort_order">
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
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="editForm" method="POST">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Editing <span id="editTitle"></span></h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">            
            <div class="form-group">
                <label for="">Image</label>
                <div class="input-group pull-left">
                    <span class="input-group-btn">
                        <a data-input="editImg" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                    </span>
                    <input id="editImg" class="form-control input-sm" type="text" name="image" required>
                </div>
            </div>
            <div class="form-group pb-1">
              <label for="">Name</label>
              <input type="text" class="form-control" placeholder="Title" name="title" required id="edit-title">
            </div>
            <div class="form-group pb-1">
              <label for="">Link</label>
              <input type="text" class="form-control" placeholder="Link" name="link" id="edit-link">
            </div>
            <div class="form-group pb-1">
              <label for="">Sort Order</label>
              <input type="number" class="form-control" placeholder="Sort Order" required value="0" min="0" step="1" name="sort_order" id="edit-order">
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
  $('.image-placeholder').filemanager('image');
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
  $('.edit-client').click(function(){
    $("#editForm").attr('action', $(this).data('url'));
    $("#editImg").val($(this).data('image'));
    $("#edit-title").val($(this).data('title'));
    $("#editTitle").text($(this).data('title'));
    $("#edit-order").val($(this).data('order'));
    $("#edit-link").val($(this).data('link'));
    $("#editModal").modal('show');
  });
</script>
@endsection