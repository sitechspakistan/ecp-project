@extends('layouts.frontend')
@section('title', 'Listing | East Coast Puppies')

@section('customStyles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        #listdata-table thead th.sorting:before,
        #listdata-table thead th.sorting_asc:before,
        #listdata-table thead th.sorting_desc:before {
            display: none !important;
        }

        #listdata-table thead th.sorting:after,
        #listdata-table thead th.sorting_asc:after,
        #listdata-table thead th.sorting_desc:after {
            right: 8px;
            opacity: 1;
            font-size: 20px;
            margin-left: 10px;
        }

        #listdata-table thead th.sorting:after {
            content: "\2195";
            opacity: 1;
        }

        #listdata-table thead th.sorting_asc:after {
            content: "\2191";
            color: #fff;
        }

        #listdata-table thead th.sorting_desc:after {
            content: "\2193";
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <!-- Breadscrumb Section -->
        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title">My Listing</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Listing</li>
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
                @include('frontend.includes.dashboard_menu')
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
                                                <th class="no-sort col-2">Date Time</th>
                                                <th class="no-sort col-3">Action</th>                                         
                                            </tr>	
                                            </thead>
                                            <tbody>
                                                @if(isset($products) && count($products) > 0)
                                                    @foreach ($products as $k => $product)
                                                        <tr>
                                                            <td>
                                                                <div class="listingtable-img"> 
                                                                    <a href="{{ productDetailUrl($product) }}">
                                                                        <img class="img-fluid avatar-img" src="{{ asset(($product->image)??'#') }}" alt="{{ ($product->title)??'#' }}">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6><a href="{{ productDetailUrl($product) }}">{{ productTitleWithCategory($product) }}</a></h6>
                                                            </td>
                                                            <td><Span class="views-count">${{ number_format(($product->sell_price)??0, 2) }}</span></td>
                                                            <td>{{ $product->created_at->format('m/d/Y H:i:s') }}</td>
                                                            <td>
                                                                <div class="action">
                                                                    <a href="{{route('product.edit', $product->id)}}" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                                                    <a href="javascript:void(0)" class="action-btn btn-trash" data-id="{{ $product->id }}"><i class="feather-trash-2"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center">No Record Found</td>
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
            </div>				
        </div>				
    <!-- /Dashboard Content -->
@endsection

@section('customScripts')
    <!-- Datatables JS -->
    <script src="{{asset('assets_frontend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets_frontend')}}/plugins/datatables/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        //Datatable

        var count = '{!! count($products) !!}';

        if(count > 0){
            if ($('#listdata-table').length > 0 && $.fn.DataTable) {
                if (!$.fn.DataTable.isDataTable('#listdata-table')) {
                    $('#listdata-table').DataTable({
                    "autoWidth": false,
                    "columns": [
                        { "width": "135", "orderable": false },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": true },
                        { "orderable": false },
                    ],
                    order: [[3, 'desc']],
                    searching: false,
                    paging: false,
                    info: false
                    });
                }
            }
        }
        

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
        

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        /* Retry Function */
        const MAX_RETRIES = 5;

        const fetchWithRetry = async (url, options) => {
            let attempts = 0;
            while (attempts < MAX_RETRIES) {
                try {
                    return await $.ajax(url, options); // Use jQuery's AJAX here
                } catch (error) {
                    attempts++;
                    if (attempts >= MAX_RETRIES) {
                        toastr["error"](error.responseJSON?.message || 'An error occurred');
                        throw error;
                    }
                    await sleep(1000); // Wait before retrying
                }
            }
        };
        /* Retry Function */

        $('.action-btn.btn-trash').on('click', async function () {

            const id = $(this).data('id');
            const url = "{{ route('listing.delete', ':id') }}".replace(':id', id);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success ms-2",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetchWithRetry(url, {
                            type: 'POST',
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}" // Include CSRF token for Laravel
                            }
                        });

                        toastr["success"](response.message);

                        window.location.reload();
                    } catch (error) {
                        console.error('Error:', error);
                        toastr["error"](error.responseJSON?.message || 'An error occurred');
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });
        });
    </script>
@endsection