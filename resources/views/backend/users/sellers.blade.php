@extends('layouts.backend')
@section('title', 'Sellers')
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
            Sellers & Buyers
          </h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Sellers & Buyers
            </li>
          </ol>
        </div>
        <form action="{{route('users.seller.delete')}}" method="POST" id="del_form" form="del_form">
            {{csrf_field()}}
            <button class="btn btn-outline-danger me-1 mb-3" type="button" id="deleteAll"> <i class="fas fa-trash-alt"></i> Delete </button>        
        </form>
        <a href="javascript:;" class="btn btn-outline-success me-1 mb-3" data-bs-toggle="modal" data-bs-target="#addNewModal">
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
    @if ($errors->has('password'))
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-cross-circle"></em> <strong>{{ $errors->first('password') }}</strong>
    </div>
    @endif
    @if ($errors->has('expiry_date'))
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-cross-circle"></em> <strong>{{ $errors->first('expiry_date') }}</strong>
    </div>
    @endif
    @if ($errors->has('membership_id'))
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-cross-circle"></em> <strong>{{ $errors->first('membership_id') }}</strong>
    </div>
    @endif
    @if ($errors->has('start_date'))
    <div class="alert alert-danger alert-icon">
        <em class="icon ni ni-cross-circle"></em> <strong>{{ $errors->first('start_date') }}</strong>
    </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">All Sellers & Buyers</h3>
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
                <th class="d-none d-md-table-cell">Name</th>
                <th class="d-none d-md-table-cell">Email</th>
                <th class="d-none d-md-table-cell">Membership</th>
                <th class="d-none d-md-table-cell">Expiry Date</th>
                <th class="d-none d-md-table-cell">No. of Puppies</th>
                <th>Status</th>
                <th class="d-none d-sm-table-cell text-center">Added</th>
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
                <td class="d-none d-md-table-cell fs-sm">{{$v->name}}</td>
                <td class="d-none d-md-table-cell fs-sm">{{$v->email}}</td>
                <td class="d-none d-md-table-cell fs-sm">{{$v->membership_title??''}}</td>
                <td class="d-none d-md-table-cell fs-sm">{{ !empty($v->expiry_date) ? \Carbon\Carbon::parse($v->expiry_date)->format('m/d/Y') : '-' }}</td>
                <td class="d-none d-md-table-cell fs-sm">{{$v->products->count()??''}}</td>
                <td>
                    @if($v->is_active==1)
                    <a href="{{route('users.seller.status', $v->id)}}"><span class="badge bg-success">Active</span></a>
                    @else
                    <a href="{{route('users.seller.status', $v->id)}}"><span class="badge bg-danger">Inactive</span></a>
                    @endif
                  </td>
                <td class="d-none d-sm-table-cell text-center fs-sm">{{$v->created_at->format('m/d/Y')}}</td>
                <td class="text-center fs-sm">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#sellerChangePasswordModal" data-password-url="{{ route('users.seller.password', $v->id) }}" data-seller-name="{{ $v->name }}" title="Change password">
                        <i class="fa fa-fw fa-key"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal" data-bs-target="#sellerMembershipExpiryModal" data-expiry-url="{{ route('users.seller.membership.expiry', $v->id) }}" data-user-name="{{ $v->name }}" data-membership-id="{{ $v->membership_id }}" data-start-date="{{ $v->start_date }}" data-expiry-date="{{ $v->expiry_date }}" title="Update membership">
                        <i class="fa fa-fw fa-calendar"></i>
                    </button>
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

<div class="modal fade" id="sellerMembershipExpiryModal" tabindex="-1" role="dialog" aria-labelledby="sellerMembershipExpiryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="sellerMembershipExpiryForm" method="POST" action="">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="sellerMembershipExpiryModalLabel">Update membership</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted fs-sm mb-3" id="sellerMembershipExpiryUserName"></p>
          <div class="mb-3">
            <label class="form-label" for="membership_id">Membership</label>
            <select class="form-control @error('membership_id') is-invalid @enderror" id="membership_id" name="membership_id" required>
              <option value="" disabled selected>Select membership</option>
              @foreach($memberships as $membership)
                <option value="{{ $membership->id }}" data-code="{{ $membership->code }}">{{ $membership->title }}</option>
              @endforeach
            </select>
            @error('membership_id')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="membership_start_date">From date</label>
            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="membership_start_date" name="start_date" required>
            @error('start_date')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-0">
            <label class="form-label" for="membership_expiry_date">Expiry date</label>
            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="membership_expiry_date" name="expiry_date" required>
            @error('expiry_date')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update membership</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="sellerChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="sellerChangePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="sellerChangePasswordForm" method="POST" action="">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="sellerChangePasswordModalLabel">Change password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted fs-sm mb-3" id="sellerChangePasswordSellerName"></p>
          <div class="mb-3">
            <label class="form-label" for="seller_new_password">New password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="seller_new_password" name="password" required autocomplete="new-password">
            @error('password')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-0">
            <label class="form-label" for="seller_new_password_confirmation">Confirm password</label>
            <input type="password" class="form-control" id="seller_new_password_confirmation" name="password_confirmation" required autocomplete="new-password">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update password</button>
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
<script>
  var sellerPwdModal = document.getElementById('sellerChangePasswordModal');
  if (sellerPwdModal) {
    sellerPwdModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      if (!button) return;
      var url = button.getAttribute('data-password-url');
      var name = button.getAttribute('data-seller-name') || '';
      var form = document.getElementById('sellerChangePasswordForm');
      var label = document.getElementById('sellerChangePasswordSellerName');
      if (form && url) form.setAttribute('action', url);
      if (label) label.textContent = name ? ('Seller: ' + name) : '';
    });
    sellerPwdModal.addEventListener('hidden.bs.modal', function () {
      var form = document.getElementById('sellerChangePasswordForm');
      if (form) form.reset();
    });
  }

  var sellerExpiryModal = document.getElementById('sellerMembershipExpiryModal');
  if (sellerExpiryModal) {
    sellerExpiryModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      if (!button) return;
      var url = button.getAttribute('data-expiry-url');
      var name = button.getAttribute('data-user-name') || '';
      var membershipCode = button.getAttribute('data-membership-id') || '';
      var startDate = button.getAttribute('data-start-date') || '';
      var expiryDate = button.getAttribute('data-expiry-date') || '';
      var form = document.getElementById('sellerMembershipExpiryForm');
      var label = document.getElementById('sellerMembershipExpiryUserName');
      var membershipInput = document.getElementById('membership_id');
      var startDateInput = document.getElementById('membership_start_date');
      var dateInput = document.getElementById('membership_expiry_date');
      if (form && url) form.setAttribute('action', url);
      if (label) label.textContent = name ? ('User: ' + name) : '';
      if (membershipInput) {
        membershipInput.value = '';
        Array.prototype.forEach.call(membershipInput.options, function(option) {
          if (option.getAttribute('data-code') === String(membershipCode)) {
            membershipInput.value = option.value;
          }
        });
      }
      if (startDateInput) startDateInput.value = startDate;
      if (dateInput) dateInput.value = expiryDate;
    });
    sellerExpiryModal.addEventListener('hidden.bs.modal', function () {
      var form = document.getElementById('sellerMembershipExpiryForm');
      if (form) form.reset();
    });
  }

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

</script>
@endsection