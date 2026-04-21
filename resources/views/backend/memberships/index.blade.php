@extends('layouts.backend')
@section('title', 'Memberships')
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
        <h1 class="h3 fw-bold mb-1">Memberships</h1>
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item"><a class="link-fx" href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Memberships</li>
        </ol>
      </div>
      {{-- <a href="{{route('memberships.create')}}" class="btn btn-outline-success me-1 mb-3">
        <i class="fa fa-fw fa-plus me-1"></i> Create Membership
      </a> --}}
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
      <h3 class="block-title">All Memberships</h3>
    </div>
    <div class="block-content">
      <form action="{{request()->url()}}">
        <div class="mb-4">
          <div class="input-group">
            <input type="text" class="form-control form-control-alt" name="q" placeholder="Search memberships.." value="{{$_GET['q']??''}}">
            <span class="input-group-text bg-body border-0"><i class="fa fa-search"></i></span>
          </div>
        </div>
      </form>

      <div class="table-responsive">
        <table class="js-table-checkable table table-hover table-vcenter">
          <thead>
            <tr>
              <th>Code</th>
              <th>Title</th>
              <th>Button</th>
              {{-- <th>User Type</th> --}}
              <th>Price</th>
              <th>Duration</th>
              <th>Default</th>
              {{-- <th>Featured Eligible</th> --}}
              <th>Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $v)
            <tr>
              <td>{{$v->code}}</td>
              <td>{{$v->title}}</td>
              <td>{{ $v->btn_txt ?? '-' }}</td>
              {{-- <td class="text-capitalize">{{$v->user_type}}</td> --}}
              <td>${{number_format((float)$v->price, 2)}}</td>
              <td>{{$v->duration_value}} {{$v->duration_type}}</td>
              <td>{!! $v->is_default ? '<span class="badge bg-info">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
              {{-- <td>{!! $v->is_featured_eligible ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td> --}}
              <td>
                @if($v->is_active==1)
                  <span class="badge bg-success">Active</span>
                @else
                  <span class="badge bg-warning">Inactive</span>
                @endif
              </td>
              <td class="text-center">
                <a class="btn btn-sm btn-alt-secondary" href="{{route('memberships.status', $v->id)}}" data-bs-toggle="tooltip" title="{{($v->is_active==1)?'Deactivate':'Activate'}}">
                  <i class="fa fa-fw {{($v->is_active==1)?'fa-eye-slash':'fa-eye'}}"></i>
                </a>
                <a class="btn btn-sm btn-alt-secondary" href="{{route('memberships.edit', $v->id)}}" data-bs-toggle="tooltip" title="Edit">
                  <i class="fa fa-fw fa-pencil"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{$data->links('pagination.custom')}}
    </div>
  </div>
</div>
@endsection
@section('customScripts')
<script src="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  One.helpersOnLoad(['one-table-tools-sections']);
</script>
@endsection
