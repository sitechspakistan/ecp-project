@extends('layouts.backend')
@section('title', 'Subscribers')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend')}}/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('assets_backend')}}/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('assets_backend')}}/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection
@section('content')
<div class="content">
  @if(Session::has('success'))
    <div class="alert alert-success alert-icon">
        <em class="icon ni ni-check-circle"></em> <strong>{{Session::get('success')}}</strong>
    </div>
    @endif
    <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">All Subscribers</h3>
          <form action="{{route('deleteSubscribers')}}" method="POST" id="del_form" form="del_form">
              {{csrf_field()}}
              <button class="btn btn-outline-danger btn-sm" type="button" id="deleteAll"> 
                {{-- <i class="fas fa-trash-alt"></i>  --}}
                (<span id="checkCount">0</span>) Delete </button>
          </form>
        </div>
        <div class="block-content block-content-full overflow-x-auto">
          <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
          <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
              <tr>
                <th class="text-center" style="width: 70px;">
                  <div class="form-check d-inline-block">
                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                    <label class="form-check-label" for="check-all"></label>
                  </div>
                </th>
                <th>ID</th>
                <th>Name</th>
                <th class="d-none d-sm-table-cell">Email</th>
                {{-- <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th> --}}
                <th class="d-none d-sm-table-cell" style="width: 15%;">Registered</th>
              </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $value)
                <tr>
                  <td class="text-center">
                    <div class="form-check d-inline-block">
                      <input class="form-check-input checkItem" type="checkbox" value="{{$value->id}}" id="row_{{$value->id}}" name="ids[]" required form="del_form">
                      <label class="form-check-label" for="row_{{$value->id}}"></label>
                    </div>
                  </td>
                    <td class="fs-sm">{{$value->id}}</td>
                    <td class="fw-semibold fs-sm">{{$value->name}}</td>
                    <td class="fw-semibold fs-sm">{{$value->email}}</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="text-muted fs-sm">{{$value->created_at->diffForHumans()}}</span>
                    </td>
                </tr>
              @endforeach  
            </tbody>
          </table>
        </div>
    </div>        
  </div>

@endsection
@section('customScripts')
<script src="{{asset('assets_backend')}}/js/plugins/datatables/dataTables.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons/buttons.print.min.js"></script>
<script src="{{asset('assets_backend')}}/js/plugins/datatables-buttons/buttons.html5.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('assets_backend')}}/js/pages/be_tables_datatables.min.js"></script>

<script src="{{asset('assets_backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  $("#check-all").click(function(){
      $(':checkbox.checkItem').prop('checked', this.checked);
      $("#checkCount").text($(':checkbox.checkItem:checked').length);
  });
  $(".checkItem").on('click',function(){ $("#checkCount").text($(':checkbox.checkItem:checked').length); });
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