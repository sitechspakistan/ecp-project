@extends('layouts.frontend')
@section('title', 'Cart | East Coast Puppies')
@section('customStyles')
    <style>
        .pagination-center{width:61%}
    </style>
@endsection
@section('content')

    <!-- Breadscrumb Section -->
		<div class="breadcrumb-bar">
			<div class="container">
				<div class="row align-items-center text-center">
		    		<div class="col-md-12 col-12">
			    	    <h2 class="breadcrumb-title">Cart</h2>
				    	<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Cart</li>
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
                
                <div class="dash-listingcontent dashboard-info">
                    <div class="dash-cards card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="listing-table datatable" id="listdata-table">
                                    <thead>					    
                                    <tr>
                                        <th class="no-sort col-3">Image</th>                                         
                                        <th class="no-sort col-4">Details</th>                                         
                                        <th class="no-sort col-2">Price</th>                                         
                                        <th class="no-sort col-2">Quantity</th>                                       
                                        <th class="no-sort col-2">Total</th>                                       
                                        <th class="no-sort col-3">Action</th>                                         
                                        </tr>	
                                        </thead>
                                        <tbody>	
                                        @if(isset($data) && count($data) > 0)
                                            @foreach($data as $cart)
                                                <tr>
                                                    <td>
                                                        <div class="listingtable-img">
                                                            <img class="img-fluid avatar-img" src="{{ asset((getProduct($cart['product'])['image'])??'#') }}" alt="{{ ($cart['title'])??'' }}"></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6>{{ ($cart['title'])??'' }}</h6>
                                                    </td>
                                                    <td><Span class="views-count">${{ number_format(($cart['price'])??0, 2) }}</span></td>
                                                    <td>{{ ($cart['qty'])??0 }}</td>
                                                    <td><Span class="views-count">${{ number_format(($cart['total'])??0, 2) }}</span></td>
                                                    <td>
                                                    <div class="action">
                                                        <a href="javascript:void(0)" data-id="{{$cart['product']}}" class="action-btn btn-trash deletebtn"><i class="feather-trash-2"></i></a>
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">Cart is empty</td>
                                            </tr>
                                        @endif
                                        <!-- Additional rows as per your requirement -->
                                        </tbody>                                     
                                </table>				
                            </div>
                            <div class="blog-pagination">
                                <nav>
                                    <ul class="pagination">
                                        
                                        <li class="justify-content-center pagination-center"> 
                                            <div class="pagelink d-flex align-items-center">
                                                <h5>Total = <span style="color: rgba(0, 0, 0, 0.664);">$ {{ number_format(cartTotal(),2) }}</span></h5>
                                            </div>                                                    
                                    </li>                                                    
                                    <li class="page-item nextlink">
                                        <a href="{{route('checkoutPage')}}" class="page-link" style="min-width: 180px;display: inline-block;"><i class="fas fa-regular fa-arrow-right"></i> Proceed to Checkout</a>
                                        <a href="{{route('home')}}" class="page-link" style="min-width: 180px;display: inline-block;"><i class="fas fa-angle-double-left"></i> Continue Shopping</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>                                        
                        </div>
                    </div>                  
                </div>
                                            
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