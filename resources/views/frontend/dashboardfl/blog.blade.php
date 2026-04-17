@extends('layouts.frontend')
@section('title', 'Blogs | East Coast Puppies')

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
                        <h2 class="breadcrumb-title">Blog</h2>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
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

                                    <div class="text-end">
                                        <a class="btn btn-primary mb-2" href="{{route('frontblog.create')}}">Add</a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="listing-table datatable" id="listdata-table">
                                        <thead>
                                            <tr>
                                                <th class="no-sort col-3">Image</th>
                                                <th class="no-sort col-4">Title</th>
                                                <th class="no-sort col-2">Added</th>
                                                <th class="no-sort col-2">Status</th>
                                                <th class="no-sort col-3">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($blogs) && count($blogs) > 0)
                                                    @foreach ($blogs as $k => $blog)
                                                        <tr>
                                                            <td>
                                                                <div class="listingtable-img">
                                                                    <a href="{{route('frontblog.edit', $blog->id)}}">
                                                                        <img class="img-fluid avatar-img" src="{{ asset(($blog->image)??'#') }}" alt="{{ ($blog->title)??'#' }}">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <h6><a href="{{route('frontblog.edit', $blog->id)}}">{{ ($blog->title)??'#' }}</a></h6>
                                                            </td>
                                                            <td>{{ Carbon\Carbon::parse($blog->created_at)->format('d/m/Y') }}</td>
                                                            <td>
                                                                @if($blog->is_active === 1)<span class="status-text">Published</span>@endif
                                                                @if($blog->is_active === 0)<span class="status-text unpublish">Un Published</span>@endif
                                                            </td>
                                                            <td>
                                                                <div class="action">
                                                                    <a href="{{route('frontblog.edit', $blog->id)}}" class="action-btn btn-edit"><i class="feather-edit-3"></i></a>
                                                                    <a href="javascript:void(0)" class="action-btn btn-trash" data-id="{{ $blog->id }}"><i class="feather-trash-2"></i></a>
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

        var count = '{!! count($blogs) !!}';

        if(count > 0){
            if ($('#listdata-table').length > 0 && $.fn.DataTable) {
                if (!$.fn.DataTable.isDataTable('#listdata-table')) {
                    $('#listdata-table').DataTable({
                    "autoWidth": false,
                    "columns": [
                        { "width": "135", "orderable": false },
                        { "width": "135" },
                        { "width": "135" },
                        { "width": "135", "orderable": false },
                        { "orderable": false },
                    ],
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

        $('.btn-trash').on('click', async function () {

            const id = $(this).data('id');
            const url = "{{ route('frontblog.delete', ':id') }}".replace(':id', id);

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
