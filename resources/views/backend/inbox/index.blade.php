@extends('layouts.backend')
@section('title', 'Inbox')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection
@section('content')
@php
$l_sort = $_GET['sort']??'desc';
@endphp
<div class="content">
    <div class="row">      
      <div class="col-md-12 col-xl-12">
        <!-- Message List -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">
              {{$data->currentPage()}}-{{$data->lastPage()}} <span class="fw-normal text-lowercase">from</span> {{$data->total()}}
            </h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-toggle="tooltip" data-bs-placement="left" title="Previous 15 Messages">
                <i class="si si-arrow-left"></i>
              </button>
              <button type="button" class="btn-block-option" data-bs-toggle="tooltip" data-bs-placement="left" title="Next 15 Messages">
                <i class="si si-arrow-right"></i>
              </button>
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                <i class="si si-refresh"></i>
              </button>
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            </div>
          </div>
          <div class="block-content py-0"><!-- Messages and Checkable Table (.js-table-checkable class is initialized in Helpers.oneTableToolsCheckable()) -->
            <div class="pull-x">
              <table class="js-table-checkable table table-hover table-vcenter fs-sm">
                <thead>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg15" name="inbox-msg-all">
                        <label class="form-check-label" for="inbox-msg-all"></label>
                      </div>
                    </td>
                    <td colspan="4">
                      <!-- Messages Options -->
                      <div class="d-flex justify-content-between">
                        {{-- <div class="btn-group">
                          <button class="btn btn-sm btn-alt-secondary" type="button">
                            <i class="fa fa-archive text-primary"></i>
                            <span class="d-none d-sm-inline ms-1">Archive</span>
                          </button>
                          <button class="btn btn-sm btn-alt-secondary" type="button">
                            <i class="fa fa-star text-warning"></i>
                            <span class="d-none d-sm-inline ms-1">Star</span>
                          </button>
                        </div> --}}
                        <form action="{{route('deleteInbox')}}" method="POST" id="del_form" form="del_form">
                          {{csrf_field()}}
                            <button class="btn btn-sm btn-alt-secondary" type="button" id="deleteAll">
                              <i class="fa fa-times text-danger"></i>
                              <span class="d-none d-sm-inline ms-1">Delete</span>
                            </button>
                        </form>
                      </div>
                      <!-- END Messages Options -->
                    </td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $value)
                  <tr>
                    <td class="text-center" style="width: 60px;">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input checkItem" type="checkbox" value="{{$value->id}}" id="row_{{$value->id}}" name="ids[]" required form="del_form">
                        <label class="form-check-label" for="row_{{$value->id}}"></label>
                      </div>
                    </td>                    
                    <td class="d-none d-sm-table-cell fw-semibold" style="width: 140px;">{{$value->name}}</td>
                    <td>
                      <a class="fw-semibold open-this" data-name="{{$value->name}}" data-email="{{$value->email}}" data-phone="{{$value->phone}}" data-message="{{$value->message}}" data-subject="{{$value->subject}}" data-address="{{$value->fields_meta['address']??''}}" data-created="{{$value->created_at->diffForHumans()}}" href="javascript:;">{{$value->subject}}</a>
                      <div class="text-muted mt-1">{{Str::limit($value->message, 96, '...')}}</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted" style="width: 120px;">
                      <em>{{$value->created_at->diffForHumans()}}</em>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- END Messages and Checkable Table -->
          </div>
        </div>
        <!-- END Message List -->
      </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModal" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-transparent mb-0">
            <div class="block-header block-header-default">
              <h3 class="block-title" id="showSubject"></h3>
              <div class="block-options">                
                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </div>
            {{-- <div class="block-content block-content-full text-center bg-image" style="background-image: url('assets/media/photos/photo7.jpg');">
              <img class="img-avatar img-avatar96 img-avatar-thumb" src="assets/media/avatars/avatar4.jpg" alt="">
            </div> --}}
            <div class="block-content block-content-full fs-sm d-flex justify-content-between bg-body-light">
              <a href="javascript:void(0)" id="show-email"></a>
              <span class="text-muted"><em id="show-created"></em></span>
            </div>
            <div class="block-content">
              <div class="form-group">
                <label for=""><b>Phone:</b></label>
                <p id="show-phone"></p>
              </div>
              <div class="form-group">
                <label for=""><b>Address:</b></label>
                <p id="show-address"></p>
              </div>
              <div class="form-group">
                <label for=""><b>Message:</b></label>
                <p id="show-message"></p>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
    <!-- END Message Modal -->
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

  $('.open-this').click(function(){
    $("#show-name").html($(this).data('name'));
    $("#showSubject").text($(this).data('name'));
    $("#show-message").html($(this).data('message'));
    $("#show-address").html($(this).data('address'));
    $("#show-phone").html($(this).data('phone'));
    $("#show-email").html($(this).data('email'));
    $("#show-created").html($(this).data('created'));
    $("#show-email").attr('href', 'mailto:'+$(this).data('email'));
    $("#emailModal").modal('show');
  });
</script>
@endsection