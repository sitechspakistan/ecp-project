@extends('layouts.frontend')
@section('title', 'Questions | East Coast Puppies')

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
                        <h2 class="breadcrumb-title">Questions</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Questions</li>
                            </ol>
                        </nav>							
                    </div>
                </div>
            </div>
        </div>
    <!-- /Breadscrumb Section -->

    <!-- Questions Content -->
    <div class="dashboard-content">		
        <div class="container">
            @include('frontend.includes.dashboard_menu')
            <div class="row dashboard-info reviewpage-content">

                <div class="col-lg-6 d-flex">
                    <div class="card dash-cards">
                        <div class="card-header">
                            <h4>Visitor Question</h4>
                        </div>	
                        <div class="card-body">
                            <table class="table table-responsive d-block">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($questions) && count($questions) > 0)
                                        @foreach($questions as $k => $question)
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>
                                                    {{ ($question->user->name)??'-' }}<br/>
                                                    <small>{{ $question->user->email }}</small><br/>
                                                    <small>{{ $question->user->phone }}</small>
                                                </td>
                                                <td>{{ ($question->product->title)??'-' }}</td>
                                                <td>{{ ($question->message)??'-' }}</td>
                                                <td>
                                                    <a href="mailto:{{ $question->user->email }}" class="btn btn-sm btn-secondary"><i class="fa-regular fa-envelope"></i></a>
                                                    @if($question->user->phone)
                                                        <a href="tel:{{ $question->user->phone }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-phone"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="100%" align="center">No Record Found</td>
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
                            <h4>Your Question</h4>
                        </div>	
                        <div class="card-body">
                            <table class="table table-responsive d-block">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($my_questions) && count($my_questions) > 0)
                                        @foreach($my_questions as $k => $my_question)
                                            <tr>
                                                <td>{{ $k+1 }}</td>
                                                <td>{{ ($my_question->productuser->name)??'-' }}</td>
                                                <td>{{ ($my_question->product->title)??'-' }}</td>
                                                <td>{{ ($my_question->message)??'-' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="100%" align="center">No Record Found</td>
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
    <!-- /Questions Content -->
@endsection

@section('customScripts')
@endsection