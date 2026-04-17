@extends('layouts.backend')
@section('title', 'Activity Logs')
@section('customStyles')

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
            Activity Logs
          </h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Activity Logs
            </li>
          </ol>
        </div>                        
      </div>
    </div>
</div>
<div class="content">  
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">All Logs</h3>
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
                {{-- <th class="text-center" style="width: 100px;"></th> --}}
                <th class="d-none d-md-table-cell">IP Address</th>
                <th class="d-none d-md-table-cell">User</th>
                <th class="d-none d-md-table-cell">Activity</th>
                <th class="d-none d-sm-table-cell text-end">Timestamp</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k => $v)
              <tr>                                
                  <td class="d-none d-md-table-cell fs-sm">{{ $v->user_ip }}</td>
                <td class="d-none d-md-table-cell fs-sm">{{ $v->user->name ?? 'System' }}</td>
                <td class="d-none d-md-table-cell fs-sm">{{ $v->description }}</td>
                <td class="d-none d-sm-table-cell text-end fs-sm">{{$v->created_at->format('d M Y h:i:a')}}</td>
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

@endsection
@section('customScripts')
<!-- Page JS Helpers (Table Tools helpers) -->
<script>One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);</script>
@endsection