@extends('layouts.backend')
@section('title', 'Coupons')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection
@section('content')
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
      <div class="flex-grow-1">
        <h1 class="h3 fw-bold mb-1">Coupons</h1>
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item"><a class="link-fx" href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item" aria-current="page">Coupons</li>
        </ol>
      </div>
      <form action="{{route('coupons.delete')}}" method="POST" id="del_form" form="del_form">
        @csrf
        <button class="btn btn-outline-danger me-1 mb-3" type="button" id="deleteAll"><i class="fas fa-trash-alt"></i> Delete</button>
      </form>
      <a href="{{route('coupons.create')}}" class="btn btn-outline-success me-1 mb-3">
        <i class="fa fa-fw fa-plus me-1"></i> Create Coupon
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
      <h3 class="block-title">All Coupons</h3>
    </div>
    <div class="block-content">
      <form action="{{request()->url()}}" method="get">
        <div class="row mb-4">
          <div class="col-md-4 mb-2 mb-md-0">
            <div class="input-group">
              <input type="text" class="form-control form-control-alt" name="q" placeholder="Search by code or title.." value="{{request('q','')}}">
              <span class="input-group-text bg-body border-0"><i class="fa fa-search"></i></span>
            </div>
          </div>
          <div class="col-md-3 mb-2 mb-md-0">
            <select class="form-control" name="blocked" onchange="this.form.submit()">
              <option value="">Blocked / Free (all)</option>
              <option value="blocked" {{request('blocked')==='blocked'?'selected':''}}>Blocked</option>
              <option value="free" {{request('blocked')==='free'?'selected':''}}>Free</option>
            </select>
          </div>
          <div class="col-md-3 mb-2 mb-md-0">
            <select class="form-control" name="status" onchange="this.form.submit()">
              <option value="">Status (all)</option>
              <option value="active" {{request('status')==='active'?'selected':''}}>Active</option>
              <option value="inactive" {{request('status')==='inactive'?'selected':''}}>Inactive</option>
            </select>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-alt-secondary w-100">Filter</button>
          </div>
        </div>
      </form>

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
              <th>Code</th>
              <th>Title</th>
              <th>Discount Type</th>
              <th>Discount Value</th>
              <th>Website</th>
              <th>Status</th>
              <th>Blocked</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $v)
            <tr>
              <td class="text-center">
                <div class="form-check d-inline-block">
                  <input class="form-check-input checkItem" type="checkbox" value="{{$v->id}}" id="row_{{$v->id}}" name="ids[]" form="del_form">
                  <label class="form-check-label" for="row_{{$v->id}}"></label>
                </div>
              </td>
              <td class="fw-semibold">{{$v->code}}</td>
              <td>{{$v->title}}</td>
              <td class="text-capitalize">{{$v->discount_type}}</td>
              <td>
                @if($v->discount_type === 'percentage')
                  {{rtrim(rtrim(number_format((float)$v->discount_value, 2), '0'), '.')}}%
                @else
                  ${{number_format((float)$v->discount_value, 2)}}
                @endif
              </td>
              <td>
                @if($v->show_on_website)
                  <span class="badge bg-info">Yes</span>
                @else
                  <span class="badge bg-secondary">No</span>
                @endif
              </td>
              <td>
                @if($v->status === 'active')
                  <span class="badge bg-success">Active</span>
                @else
                  <span class="badge bg-warning">Inactive</span>
                @endif
              </td>
              <td>
                @if($v->is_blocked)
                  <span class="badge bg-danger">Yes</span>
                @else
                  <span class="badge bg-success">No</span>
                @endif
              </td>
              <td class="text-center">
                <a class="btn btn-sm btn-alt-secondary" href="{{route('coupons.edit', $v->id)}}" data-bs-toggle="tooltip" title="Edit">
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
  One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);
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
          }
        });
      }
      else {
        One.helpers('jq-notify', {type: 'warning', icon: 'fa fa-exclamation me-1', message: 'Select one or more item'});
      }
  });
</script>
@endsection
