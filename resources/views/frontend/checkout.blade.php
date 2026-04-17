@extends('layouts.frontend')
@section('title', 'Checkout | East Coast Puppies')
@section('customStyles')
    <style>
        .proceedbtn{
            background-color: #df965e;
            border: 1px solid #df965e;
            color: #fff;
            box-shadow: inset 0 0 0 #fff;
            border-radius: 4px;
            padding: 11px 19px;
            font-weight: 600;
            text-align: center;
            -webkit-transition: all 0.7s;
            -moz-transition: all 0.7s;
            -o-transition: all 0.7s;
            transition: all 0.7s;
            line-height: normal;
        }
        .proceedbtn:hover{
            background-color: #fff;
            border: 1px solid #df965e;
            box-shadow: inset 0 70px 0 0 #ffffff;
            color: #df965e;
            -webkit-transition: all 0.7s;
            -moz-transition: all 0.7s;
            -o-transition: all 0.7s;
            transition: all 0.7s;
        }
    </style>
@endsection
@section('content')

    <!-- Breadscrumb Section -->
		<div class="breadcrumb-bar">
			<div class="container">
				<div class="row align-items-center text-center">
		    		<div class="col-md-12 col-12">
			    	    <h2 class="breadcrumb-title">Checkout</h2>
				    	<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Checkout</li>
							</ol>
						</nav>							
					</div>
				</div>
			</div>
		</div>
	<!-- /Breadscrumb Section -->
		
    <!-- Dashboard Content -->
        <div class="dashboard-content">		
            <div class="container">

                @if(Auth::check())
                <div class="alert alert-success">
                <small>Welcome! You are checking out as <strong>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</strong></small>
                </div>
                @else
                <div class="alert alert-warning">
                    <small>You are checking out as a guest. Have an account? <a href="{{route('frontfront.login')}}">Sign in</a> Or you can create an account during checkout.</small>
                </div>
                @endif

                <form action="{{route('proceed_order')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="panel panel-default f-default">
                                <div class="panel-heading panel-heading1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <h3 class="panel-title">Account Information</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row p0">
                                        <div class="col-md-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="user[first_name]" placeholder="First Name" required="" value="{{ (Auth::user()->name)??'' }}">                                  
                                        </div>
                                        <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="user[email]" placeholder="Email Address" required="" value="{{ (Auth::user()->email)??'' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row p0">
                                        <div class="col-md-6">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="user[phone]" placeholder="Phone" required="" value="{{ (Auth::user()->phone)??'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default f-default">
                                <div class="panel-heading panel-heading1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <h3 class="panel-title">Shipping Information</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row p0">
                                        <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea class="form-control" name="shipping[address]" placeholder="Enter Address" required="">{{ (Auth::user()->address)??'' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row p0">
                                        <div class="col-md-6">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="shipping[country]" value="{{ (Auth::user()->country)??'' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="shipping[city]" value="{{ (Auth::user()->city)??'' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row p0">
                                        <div class="col-md-12">
                                        <label>Postal/Zip Code</label>
                                        <input type="text" class="form-control" name="shipping[postal]" class="form-control" placeholder="Postal/Zip Code" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="payment" name="payment" value="stripe" required="">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                            <div class="panel panel-default f-default">
                                <div class="panel-heading panel-heading1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <h3 class="panel-title">Order
                                        </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" id="cart-div" style="position: relative;">
                                    <table class="table shot-table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th style="font-size: 14px;">Item</th>
                                            <th style="font-size: 14px;">Price</th>
                                            {{-- <th style="font-size: 14px;">Discount</th> --}}
                                            {{-- <th style="font-size: 14px;">Discounted Price</th> --}}
                                            <th style="font-size: 14px;text-align:right;">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key => $cart)
                                        @php
                                            $discount = 0;
                                            if(isset($cart['discount'])){
                                            $discount = $cart['discount'];
                                            }
                                        @endphp
                                        <tr>
                                            {{-- <td><a href="#"><i class="glyphicon glyphicon-remove"></i></a></td> --}}
                                            <td style="padding: 5px;">{{$key+1}}</td>
                                            <td style="padding: 5px;"><a href="#">{{$cart['title']}} x {{$cart['qty']}}</a>
                                            <input type="hidden" name="items[product_id][]" value="{{$cart['product']}}">
                                            <input type="hidden" name="items[qty][]" value="{{$cart['qty']}}">
                                            <input type="hidden" name="items[title][]" value="{{$cart['title']}}">
                                            <input type="hidden" name="items[type][]" value="{{$cart['type']??''}}">
                                            <input type="hidden" name="items[price][]" value="{{$cart['price']}}">
                                            <input type="hidden" name="items[discount][]" value="{{$discount}}">
                                            <input type="hidden" name="items[original_price][]" value="{{$cart['original_price']}}">
                                            <input type="hidden" name="items[offer_id][]" value="{{$cart['offer_id']}}">
                                            <input type="hidden" name="items[currency_symbol][]" value="{{(isset($cart['currency_symbol']))?$cart['currency_symbol']:'$'}}">
                                            </td>
                                            {{-- {{ dd($cart) }} --}}
                                            {{-- <td>@if(isset($cart['discount'])) <del>{{ ($cart['currency_symbol'])??'$' }} {{number_format(($cart['price']+$cart['discount']),2)}}</del><br>{{ ($cart['currency_symbol'])??'$' }} {{number_format($cart['discount'],2)}} @else {{ ($cart['currency_symbol'])??'$' }} {{number_format($cart['total'],2)}} @endif</td> --}}
                                            {{-- <td>{{ ($cart['currency_symbol'])??'$' }} {{number_format(($cart['price']+$discount),2)}}</td> --}}
                                            {{-- <td>
                                            @if(isset($cart['discount_type']) && $cart['discount_type'] == 'percentage')
                                                {{ $discount }}%
                                            @else
                                                {{ ($cart['currency_symbol'])??'$' }} {{number_format(($discount),2)}}
                                            @endif
                                            
                                            </td> --}}
                                            <td>
                                            {{ ($cart['currency_symbol'])??'$' }} {{number_format(($cart['price']),2)}}
                                            </td>
                                            <td style="text-align:right">
                                            {{ ($cart['currency_symbol'])??'$' }} {{number_format(($cart['total']),2)}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            <th>Total</th>
                                            <th colspan="2" style="text-align: right;">$ {{number_format(cartTotal(),2)}}
                                            <input type="hidden" name="order_total_amount" value="{{ (isset($total))?$total:cartTotal() }}">
                                            </th>
                                        </tr>  
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="panel panel-default f-default">
                                <div class="panel-heading panel-heading1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <h3 class="panel-title">Additional Information</h3>
                                        </div>
                                    </div>
                                    <!-- <h3 class="panel-title">Additional Information</h3> -->
                                </div>
                                <div class="panel-body mb-2">
                                    <div class="form-group row p0">
                                        <div class="col-md-12">
                                        <label>Note</label>
                                        <textarea class="form-control" name="order_note" placeholder="Order Note..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <input type="checkbox" required=""> Accept all <a href="#" target="_blank">Terms &amp; Conditions</a>
                            </div>
                            <div class="form-group checkout-btns">
                                @if(isset($cart))
                                    <input type="submit" class="page-link proceedbtn" style="width: 100%;" value="Proceed">
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
                                            
            </div>				
        </div>			
    <!-- /Dashboard Content -->

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

        $(document).on('click','.deletebtn',function(){
            $this = $(this); 
            var btntext = $this.html(); 
            $this.html('<i class="fa-solid fa-spinner fa-spin"></i>');
            $this.removeClass('deletebtn');
            var data = {'_token':"{{csrf_token()}}",'product_id':$(this).data('id')};
            jQuery.ajax({
                url:'{{route('deleteCartItem')}}',
                type: 'post',
                data: data,
                success: function( data ){
                if(data.status=="deleted") {
                    location.reload();
                }
                }
            });
        })


        $(document).on('click','.addToCart',function(){
            
            
            
            var qty = $(this).attr('data-qty');
            if(qty==0){
                toastr["error"]("Quantity can't be zero");
                $this.html(btntext);
                return false;
            }
            var data = {'_token':"{{csrf_token()}}",'product_id':$(this).data('id'),'qty':qty};
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