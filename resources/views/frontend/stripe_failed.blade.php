@extends('layouts.frontend')
@section('title', 'Payment Failed | East Coast Puppies')
@section('customStyles')
    <style>
        .cm-container {
        max-width: 27rem;
        margin: 1rem auto 0;
        padding: 1rem;
        }

        .o-circle {
        display: flex;
        width: 10.555rem; height: 10.555rem;
        justify-content: center;
        align-items: flex-start;
        border-radius: 50%; 
        animation: circle-appearance .8s ease-in-out 1 forwards, set-overflow .1s 1.1s forwards;
        }

        .c-container__circle {
        margin: 0 auto 0.5rem;
        }

        /*=======================
            C-Circle Sign
        =========================*/
            
        .o-circle__sign {
        position: relative;
        opacity: 0;
        background: #fff;
        animation-duration: .8s;
        animation-delay: .2s;
        animation-timing-function: ease-in-out;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
        }

        .o-circle__sign::before, 
        .o-circle__sign::after {
        content: "";
        position: absolute;
        background: inherit;
        }

        .o-circle__sign::after {
        left: 100%; top: 0%;
        width: 500%; height: 95%; 
        transform: translateY(4%) rotate(0deg);
        border-radius: 0;
        opacity: 0;
        animation: set-shaddow 0s 1.13s ease-in-out forwards;
        z-index: -1;
        }

        /*=======================
            Sign Failure
        =========================*/

        .o-circle__sign--failure {
        background: rgb(236, 78, 75);
        }

        .o-circle__sign--failure .o-circle__sign {
        width: 1rem; height: 7rem;
        transform: translateY(25%) rotate(45deg) scale(.1);
        border-radius: 50% 50% 50% 50% / 10%;
        animation-name: failure-sign-appearance;
        }

        .o-circle__sign--failure .o-circle__sign::before {
        top: 50%;
        width: 100%; height: 100%; 
        transform: translateY(-50%) rotate(90deg);
        border-radius: inherit;
        } 

        /*--shadow--*/
        .o-circle__sign--failure .o-circle__sign::after {
        background: rgba(175, 57, 55, .8);
        }


        /*-----------------------
            @Keyframes
        --------------------------*/
        
        /*CIRCLE*/
        @keyframes circle-appearance {
        0% { transform: scale(0); }
        
        50% { transform: scale(1.5); }
                
        60% { transform: scale(1); }
        
        100% { transform: scale(1); }
        }

        /*SIGN*/
        @keyframes failure-sign-appearance {         
        50% { opacity: 1;  transform: translateY(25%) rotate(45deg) scale(1.7); }
            
        100% { opacity: 1; transform: translateY(25%) rotate(45deg) scale(1); }
        }

        @keyframes success-sign-appearance {      
        50% { opacity: 1;  transform: translateX(130%) translateY(35%) rotate(45deg) scale(1.7); }
            
        100% { opacity: 1; transform: translateX(130%) translateY(35%) rotate(45deg) scale(1); }
        }
        

        @keyframes set-shaddow {
        to { opacity: 1; }
        }

        @keyframes set-overflow {
        to { overflow: hidden; }
        }
        .b-paymentfail-message h1{text-align:center}
        .b-paymentfail-message{padding: 12px;text-align:justify;}
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
			    	    <h2 class="breadcrumb-title">Payment Failed</h2>
				    	<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Payment Failed</li>
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
                        <div class="thankWrapper" style="margin-bottom: 3rem;padding:30px 0px">
                            <h2>Payment Failed</h2>
                            <p><b>Dear @if(auth()->check()) {{ (auth()->user()->first_name)??'User' }} @else User @endif,</b></p>
                            <p>We regret to inform you that your recent payment using Stripe has failed to process successfully. We understand that this may cause inconvenience, and we apologize for any inconvenience caused.</p>
                            <p>Upon investigating the matter, it has been determined that the payment failure is due to some reason. This could be a result of various factors such as insufficient funds in your account, an expired or invalid credit card, or an issue with the payment gateway.</p>
                            <p>To resolve this issue, we recommend taking the following steps:</p>
                            <ol>
                                <li>Verify account balance: Please ensure that you have sufficient funds available in your bank account or credit card to cover the transaction amount.</li>
                                <li>Check card details: Double-check the accuracy of the card information provided, including the card number, expiration date, and CVV code. If necessary, update the information and attempt the payment again.</li>
                                <li>Contact your bank: Reach out to your bank or credit card issuer to inquire about any potential issues with your account or card that could be causing the payment failure.</li>
                            </ol>
                            <p>If you have taken the above steps and the issue persists, we kindly ask you to contact our customer support team at <b>supports@eastcoastpuppies.com</b>. Our dedicated support staff will be more than happy to assist you in resolving this matter promptly.</p>
                            <p>We apologize for any inconvenience this may have caused and appreciate your understanding. Thank you for choosing our services, and we look forward to assisting you with your payment soon.</p>
                            <p>Best regards,</p>
                            <p><b>Customer Experience Team</b></p>
                            <p><b>East Coast Puppies</b></p>
                            <p><a href="{{url('/')}}" class="btn-home"><span>Back To Home</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- /Dashboard Content -->

@endsection

@section('customScripts')
@endsection