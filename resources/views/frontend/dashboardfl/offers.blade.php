@extends('layouts.frontend')
@section('title', 'Offers | East Coast Puppies')

@section('customStyles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">Offers</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Offers</li>
                            </ol>
                        </nav>							
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->

    <!-- Offers Content -->
    <div class="dashboard-content">		
        <div class="container">
            @include('frontend.includes.dashboard_menu')
            <div class="row dashboard-info reviewpage-content">

                <div class="col-lg-6 d-flex">
                    <div class="card dash-cards">
                        <div class="card-header">
                            <h4>Visitor Offer</h4>
                        </div>	
                        <div class="card-body">
                            <table class="listing-table datatable dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Product Price</th>
                                        <th>Offer</th>
                                        <!-- <th>Status</th>
                                        <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($offers) && count($offers) > 0)
                                        @foreach($offers as $k => $offer)
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>{{ ($offer->user->name)??'-' }}</td>
                                                <td>{{ ($offer->product->title)??'-' }}</td>
                                                <td>{{ number_format(($offer->product->sell_price)??0,2) }}</td>
                                                <td>{{ number_format(($offer->offer)??0,2) }}</td>
                                                <!-- <td>
                                                    @if($offer->status === 1)
                                                        <span class="status-text">Accepted</span>
                                                    @elseif($offer->status === 2)
                                                        <span class="status-text unpublish">Rejected</span>
                                                    @elseif($offer->status === 3)
                                                        <span class="status-text">Ordered</span>
                                                    @else
                                                        <span class="status-text unpublish">Pending</span>
                                                    @endif
                                                </td>
                                                <td style="display: flex;flex-direction: row;justify-content: space-evenly;align-items: center;}">
                                                    @if($offer->status === 0)
                                                        <a href="{{ route('accept_offer', $offer->id) }}?status=accept" class="action-btn btn-edit" style="border-radius: 0;width: 20px;height: 20px;margin: 0 0px 0 0;"><small><i class="fa-solid fa-check"></i></small></a>
                                                        <a href="{{ route('accept_offer', $offer->id) }}?status=reject" class="action-btn btn-trash" style="border-radius: 0;width: 20px;height: 20px;margin: 0 0px 0 0;background: #c10037;"><small><i class="fa-solid fa-xmark"></i></small></a>
                                                    @endif
                                                </td> -->
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="100%" class="text-center">No Record Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>								
                        </div>							
                    </div>						 
                </div>
                
                <div class="col-lg-6 d-flex">
                    <div class="card dash-cards">
                        <div class="card-header">
                            <h4>Your Offer</h4>
                        </div>	
                        <div class="card-body">
                            <table class="listing-table datatable dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Product Price</th>
                                        <th>Offer</th>
                                        <!-- <th>Status</th>
                                        <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($my_offers) && count($my_offers) > 0)
                                        @foreach($my_offers as $k => $my_offer)
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>{{ ($my_offer->productuser->name)??'-' }}</td>
                                                <td>{{ ($my_offer->product->title)??'-' }}</td>
                                                <td>{{ number_format(($my_offer->product->sell_price)??0,2) }}</td>
                                                <td>{{ number_format(($my_offer->offer)??0,2) }}</td>
                                                <!-- <td>
                                                    @if($my_offer->status === 1)
                                                        <span class="status-text">Accepted</span>
                                                    @elseif($my_offer->status === 2)
                                                        <span class="status-text unpublish">Rejected</span>
                                                    @elseif($my_offer->status === 3)
                                                        <span class="status-text">Ordered</span>
                                                    @else
                                                        <span class="status-text unpublish">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($my_offer->status === 1)
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary addToCart" data-bs-toggle="tooltip" title="Add To Cart" data-id="{{$my_offer->product_id}}" data-qty="1" data-discount="1" data-discount_price="{{ $my_offer->offer }}" data-offer_id="{{ $my_offer->id }}"><i class="fa-solid fa-cart-plus"></i></a>
                                                    @endif
                                                </td> -->
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="100%" class="text-center">No Record Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>							
                        </div>								
                    </div>							 
                </div>	
            </div> 					
        </div>		
    </div>		
    <!-- /Offers Content -->
@endsection

@section('customScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        $(document).on('click','.addToCart',function(){
            $this = $(this); 
            var btntext = $this.html(); $this.text("Adding..");
            $this.removeClass('addToCart');
            var qty = $(this).attr('data-qty');
            if(qty==0){
                toastr["error"]("Quantity can't be zero");
                $this.html(btntext);
                return false;
            }
            var discount = $(this).attr('data-discount');
            var discount_price = $(this).attr('data-discount_price');
            var offer_id = $(this).attr('data-offer_id');
            var data = {'_token':"{{csrf_token()}}",'product_id':$(this).data('id'),'qty':qty,'discount':discount,'discount_price':discount_price,'offer_id':offer_id};
            $.ajax({
                url:'{{route("addToCart")}}',
                type: 'post',
                data: data,
                success: function(data){
                    if(data.status=="added") {
                        location.href = "{{route('cartPage')}}";
                    }else if(data.status=="error"){
                        toastr["error"](data.msg);
                    }
                    $this.html(btntext);
                    $this.addClass('addToCart');
                }
            })
        })
    </script>
@endsection