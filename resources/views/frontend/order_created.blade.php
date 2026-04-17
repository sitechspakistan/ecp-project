@extends('layouts.frontend')
@section('title', 'Order Created | East Coast Puppies')
@section('customStyles')
    <style>
        @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
            .page-not-found h2 {
                font-size: 40px;
            }
            .page-not-found h3 {
                margin-bottom: 2em;
            }
        }
        .thanks {
            background: url({{url('/public/img/abt-sec2-bg.png')}})no-repeat 0 0;
            background-size: cover;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-top: -30px;
            text-align: center;
        }
        .thanks h2 {
            color: #322d4d;
            margin-bottom: 23px;
            border-top: 5px solid #df965e;
            border-bottom: 5px solid #df965e;
            font-size: 39px;
            text-transform: capitalize;
            padding: 13px 0;
            display: inline-block;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: #333;
            font-size: 24px;
            margin-top: 0;
        }
        .thanks p {
            text-align: center;
            color: #666;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        .thankWrapper {
            padding: 68px;
            background: #fff;
        }
        .btn-home {
            background-color: #374b5c;
            border: 1px solid #374b5c;
            align-items: center;
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
        .btn-home:hover{
            border: 1px solid #374b5c;
            color: #374b5c;
            background-color: #fff;
            box-shadow: inset 0 70px 0 0 #ffffff;
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
			    	    <h2 class="breadcrumb-title">Order Created</h2>
				    	<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Order Created</li>
							</ol>
						</nav>							
					</div>
				</div>
			</div>
		</div>
	<!-- /Breadscrumb Section -->
		
    <!-- Dashboard Content -->
        <section class="thanks">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2 text-center">
                        <div class="thankWrapper">
                            <h2>Your Order Confirmation</h2>
                            <p>Congratulations on creating your order! We're thrilled to have you as a customer. Your order with the number <b style="font-weight: bold;">#{{$order_no}}</b> has been successfully created and is currently being processed.</p>
                            <p>We appreciate your business and will do our best to ensure a smooth processing and delivery of your order. If you have any questions or require further assistance, please don't hesitate to reach out to our customer support team. Thank you for choosing us, and we look forward to serving you!</p>
                            <p><a href="{{route('home')}}" class="btn-home"><span>Back To Home</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>	
    <!-- /Dashboard Content -->

@endsection

@section('customScripts')
@endsection