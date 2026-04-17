@extends('layouts.backend')
@section('title', 'Orders')
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
            Orders
          </h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Orders
            </li>
          </ol>
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
        <h3 class="block-title">All Orders</h3>
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
                <th class="d-none d-md-table-cell">Order No</th>
                <th class="d-none d-md-table-cell">Order Date</th>
                <th class="d-none d-md-table-cell">User</th>
                <th class="d-none d-md-table-cell">Order Status</th>
                <th class="d-none d-md-table-cell">Order Type</th>
                <th class="d-none d-md-table-cell text-right">Amount</th>
                <th class="d-none d-sm-table-cell">Created At</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $k => $v)
              <tr>
                <td>
                  {{ ($v->order_no)??'' }}
                </td>
                <td>
                  {{ (Carbon\Carbon::parse($v->created_at)->format('d/m/Y'))??'' }}
                </td>
                <td>
                  <p class="mb-0"><small>{{ ($v->user->name)??'' }} <p class="mb-0"><small>({{ ($v->user->email)??'' }})</small></p></small></p>
                </td>
                <td>
                  @if($v->order_status=='pending' || $v->order_status=='cancelled')
                    <span class="badge bg-danger text-capitalize">{{ $v->order_status }}</span>
                  @else
                    <span class="badge bg-success text-capitalize">{{ $v->order_status }}</span>
                  @endif
                </td>
                <td>
                  @if($v->order_type === 'product')
                    Products
                  @else
                    Membership @if(isset($v->membership_details['title']))<small>({{ ($v->membership_details['title'])??'' }})</small>@endif
                  @endif
                </td>
                <td>
                  $ {{ number_format(($v->order_total_amount)??0, 2) }}
                </td>
                <td>
                  {{ (Carbon\Carbon::parse($v->created_at)->format('d/m/Y h:m:s'))??'' }}
                </td>            
                <td class="text-center fs-sm">
                  <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#ViewModal{{$v->id}}">
                    <i class="fa fa-fw fa-eye"></i>
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

    <!-- Modal -->
      @foreach($data as $k => $v)
        <div class="modal" id="ViewModal{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="ViewModal{{$v->id}}" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                  <h3 class="block-title">View Order Details</h3>
                  <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                      <i class="fa fa-fw fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="block-content fs-sm">
                  <div class="row">

                    <div class="col-md-4 mb-2">
                      <table class="table table-bordered table-striped">
                        <tr>
                          <th colspan="100%" class="text-center">Order Details</th>
                        </tr>
                        <tr>
                          <th><strong>Order No: </strong></th>
                          <td>{{ ($v->order_no)??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>Order Date: </strong></th>
                          <td>{{ (Carbon\Carbon::parse($v->created_at)->format('d/m/Y'))??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>Order Status: </strong></th>
                          <td>
                            @if($v->order_status=='pending' || $v->order_status=='cancelled')
                              <span class="badge bg-danger text-capitalize">{{ $v->order_status }}</span>
                            @else
                              <span class="badge bg-success text-capitalize">{{ $v->order_status }}</span>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <th><strong>Order Amount: </strong></th>
                          <td>$ {{ number_format(($v->order_total_amount)??0, 2) }}</td>
                        </tr>
                        <tr>
                          <th><strong>Payment Method: </strong></th>
                          <td>{{ $v->payment_type }}</td>
                        </tr>
                      </table>
                    </div>

                    <div class="col-md-4 mb-2">
                      <table class="table table-bordered table-striped">
                        <tr>
                          <th colspan="100%" class="text-center">User Detail</th>
                        </tr>
                        <tr>
                          <th><strong>Name: </strong></th>
                          <td>{{ ($v->user->name)??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>Email: </strong></th>
                          <td>{{ ($v->user->email)??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>Phone: </strong></th>
                          <td>
                            {{ ($v->user->phone)??'-' }}
                          </td>
                        </tr>
                        <tr>
                          <th><strong>Country </strong></th>
                          <td>{{ ($v->user->country)??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>City: </strong></th>
                          <td>{{ ($v->user->city)??'-' }}</td>
                        </tr>
                      </table>
                    </div>

                    <div class="col-md-4 mb-2">
                      <table class="table table-bordered table-striped">
                        <tr>
                          <th colspan="100%" class="text-center">Shipping Detail</th>
                        </tr>
                        <tr>
                          <th><strong>Address: </strong></th>
                          <td>{{ ($v->shipping->address)??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>Country: </strong></th>
                          <td>{{ ($v->shipping->country)??'-' }}</td>
                        </tr>
                        <tr>
                          <th><strong>City: </strong></th>
                          <td>
                            {{ ($v->shipping->city)??'-' }}
                          </td>
                        </tr>
                        <tr>
                          <th><strong>Postal\/Zip Code </strong></th>
                          <td>{{ ($v->shipping->postal)??'-' }}</td>
                        </tr>
                      </table>
                    </div>

                    <div class="col-md-12">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                          </tr>
                        </thead>
                        @if($v->order_type === 'product')
                          <tbody>
                            @if(isset($v->orderdetail))
                              @foreach($v->orderdetail as $detail)
                                <tr>
                                  <td>{{ ($detail->title)??'' }}</td>
                                  <td>${{ number_format(($detail->price)??0, 2) }}</td>
                                  <td>{{ ($detail->qty)??'' }}</td>
                                  <td>${{ number_format(($detail->amount)??0, 2) }}</td>
                                </tr>
                              @endforeach
                            @else
                                <tr>
                                  <td class="text-center">No Record Found</td>
                                </tr>
                            @endif
                          </tbody>
                        @else
                          <tbody>
                            @if(isset($v->membership_details))
                              <tr>
                                <td>{{ ($v->membership_details['title'])??'' }}</td>
                                <td>${{ number_format(($v->membership_details['price'])??0, 2) }}</td>
                                <td>1</td>
                                <td>${{ number_format(($v->membership_details['price'])??0, 2) }}</td>
                              </tr>
                            @endif
                          </tbody>
                        @endif
                      </table>
                    </div>

                  </div>
                </div>         
              </div>
            </div>
          </div>
        </div>
      @endforeach
    <!-- Modal -->
</div>
@endsection
@section('customScripts')
<!-- Page JS Helpers (Table Tools helpers) -->
<script>One.helpersOnLoad(['one-table-tools-checkable', 'one-table-tools-sections']);</script>
<script src="{{asset('assets_backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
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