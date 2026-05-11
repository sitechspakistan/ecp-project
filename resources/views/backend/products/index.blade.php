@extends('layouts.backend')
@section('title', 'Puppies')
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
            Puppies
          </h1>
          {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            Multiple style options to match your preferences.
          </h2> --}}
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Puppies
            </li>
          </ol>
        </div>
        <a href="{{route('products.create')}}" class="btn btn-outline-success me-1 mb-3">
            <i class="fa fa-fw fa-plus me-1"></i> Create Product
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
        <h3 class="block-title">All Puppies</h3>
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
              <input type="text" class="form-control form-control-alt" id="one-ecom-products-search" name="q" placeholder="Search all products.." value="{{$_GET['q']??''}}">
              <span class="input-group-text bg-body border-0">
                <i class="fa fa-search"></i>
              </span>
            </div>
          </div>
        </form>
        <!-- END Search Form -->

        <!-- All Products Table -->
        <div class="table-responsive">
          <table class="table table-borderless table-striped table-vcenter">
            <thead>
              <tr>
                <th class="text-center" style="width: 100px;">ID</th>
                <th class="d-none d-md-table-cell">Title</th>
                <th class="d-none d-md-table-cell">Breed</th>
                <th class="d-none d-md-table-cell">Seller</th>
                <th class="d-none d-sm-table-cell text-center">Added</th>
                <th>Status</th>
                <th>Featured</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k => $v)
              @if($v->is_home==1)
                <td class="text-center fs-sm">
                  <a class="fw-semibold" href="{{route('products.edit', $v->id)}}">
                    <strong>{{$v->id}}</strong>
                  </a>
                </td>
                <td class="d-none d-md-table-cell fs-sm">
                  <a href="{{route('products.edit', $v->id)}}">{{$v->title}}</a>
                </td>
                <td class="d-none d-md-table-cell fs-sm">
                  <a href="{{route('products.edit', $v->id)}}">{{$v->category->title ?? 'N/A'}}</a>
                </td>
                <td class="d-none d-md-table-cell fs-sm">
                  <a href="{{route('products.edit', $v->id)}}">{{$v->user->name ?? 'N/A'}}</a>
                </td>
                <td class="d-none d-sm-table-cell text-center fs-sm">{{$v->created_at->format('m/d/Y')}}</td>
                <td>
                  <span class="badge bg-success">Published</span>
                </td>  
                <td>
                  @if($v->is_featured==1)
                  <span class="badge bg-success">Featured</span>
                  @else
                  <span class="badge bg-warning">Not Featured</span>
                  @endif
                </td>
                <td class="text-center fs-sm">
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('products.status', $v->id)}}" data-bs-toggle="tooltip" title="{{($v->is_active==1)?'Un-publish':'Publish'}}">
                    <i class="fa fa-fw {{($v->is_active==1)?'fa-eye-slash':'fa-eye'}}"></i>
                  </a>
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('products.edit', $v->id)}}" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa fa-fw fa-pencil"></i>
                  </a>
                  <a class="btn btn-sm btn-alt-secondary" href="{{url('/')}}" data-bs-toggle="tooltip" title="View">
                    <i class="fa fa-fw fa-external-link"></i>
                  </a>                                    
                </td>
              </tr>
              @else
              <tr>
                <td class="text-center fs-sm">
                  <a class="fw-semibold" href="{{route('products.edit', $v->id)}}">
                    <strong>{{$v->id}}</strong>
                  </a>
                </td>
                <td class="d-none d-md-table-cell fs-sm">
                  <a href="{{route('products.edit', $v->id)}}">{{$v->title}}</a>
                </td>
                <td class="d-none d-md-table-cell fs-sm">{{$v->category->title}}</td>
                <td class="d-none d-md-table-cell fs-sm">{{$v->user->name ?? 'N/A'}}</td>
                <td class="d-none d-sm-table-cell text-center fs-sm">{{$v->created_at->format('m/d/Y')}}</td>
                <td>
                  @if($v->is_active==1)
                    <span class="badge bg-success">Published</span>
                  @else
                    <span class="badge bg-warning">Draft</span>
                  @endif
                </td>                
                <td>
                  @if($v->is_featured==1)
                    <span class="badge bg-success">Featured</span>
                  @else
                    <span class="badge bg-warning">Not Featured</span>
                  @endif
                </td>
                <td class="text-center fs-sm">
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('products.status', $v->id)}}" data-bs-toggle="tooltip" title="{{($v->is_active==1)?'Un-publish':'Publish'}}">
                    <i class="fa fa-fw {{($v->is_active==1)?'fa-eye-slash':'fa-eye'}}"></i>
                  </a>
                  <a class="btn btn-sm btn-alt-secondary" href="{{route('products.edit', $v->id)}}" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa fa-fw fa-pencil"></i>
                  </a>                
                  <a class="btn btn-sm btn-alt-danger delete-this" data-url="{{route('products.delete', $v->id)}}" href="javascript:void(0)" data-bs-toggle="tooltip" title="Delete">
                    <i class="fa fa-fw fa-times text-danger"></i>
                  </a>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- END All Products Table -->

        <!-- Pagination -->
        {{$data->links('pagination.custom')}}
        {{-- <nav aria-label="Photos Search Navigation">
          <ul class="pagination pagination-sm justify-content-end mt-2">
            <li class="page-item">
              <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                Prev
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="javascript:void(0)">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0)">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0)">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0)">4</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:void(0)" aria-label="Next">
                Next
              </a>
            </li>
          </ul>
        </nav> --}}
        <!-- END Pagination -->
      </div>
    </div>
    <!-- END All Products -->
</div>
@endsection
@section('customScripts')
<script src="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  $('.delete-this').click(function(){
    var _url = $(this).data('url');
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
          location.href = _url;
        } else {
          console.log('Deletion canceled');
        }
      });
  });
</script>
@endsection