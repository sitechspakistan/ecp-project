@extends('layouts.backend')
@section('title', $data['name'])
@section('customStyles')

@endsection
@section('content')
<form action="{{route('updateProfile')}}" method="POST" id="updateForm">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                {{$data['name']}}
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>                
                <li class="breadcrumb-item" aria-current="page">
                    Profile 
                </li>
              </ol>
            </div>
            <button type="submit" class="btn btn-outline-success me-1 mb-3">
              @csrf
                <i class="fa fa-fw fa-save me-1"></i> Save
            </button>        
          </div>
        </div>
    </div>
    
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded row p-3">                    
                    <div class="col-md-6">
                        <div class="form-group pb-2">
                          <label for="">Name</label>
                          <input type="text" class="form-control" placeholder="Name" name="name" required value="{{$data['name']}}">
                      </div>
                      <div class="form-group pb-2">
                          <label for="">Email</label>
                          <input type="email" class="form-control" placeholder="Email" name="email" required value="{{$data['email']}}">
                      </div>
                      <div class="form-group pb-2">
                          <label for="">Password</label>
                          <div class="input-group">
                            <input type="password" name="password" class="form-control password-input" placeholder="Change Password">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item generate-password" href="javascript:void(0)">
                                <i class="fa fa-fw fa-key me-1"></i> Generate
                              </a>
                              <a class="dropdown-item toggle-password" href="javascript:void(0)">
                                <i class="far fa-fw fa-eye me-1"></i> Show
                              </a>
                            </div>
                          </div>
                          <p><small>Enter the Password if you want to change</small></p>
                      </div>
                      {{-- <div class="form-group pb-1">
                          <label for="">User Group</label>
                          <select class="form-control form-select" name="group_id" required>
                            @foreach($groups as $group)
                            <option value="{{$group->id}}" {{($data['group_id']==$group->id)?'selected':''}}>{{$group->name}}</option>
                            @endforeach
                          </select>
                      </div> --}}
                        <div class="form-group pb-2">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{$data['phone']}}">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group pb-2">
                          <label for="">Date of Birth</label>
                          <input type="date" class="form-control" name="dob" value="{{$data['dob']}}">
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 pb-2">
                            <label for="">Country</label>
                            <input type="text" class="form-control" name="country" value="{{$data['country']}}">
                          </div>
                          <div class="form-group col-md-6 pb-2">
                            <label for="">City</label>
                            <input type="text" class="form-control" name="city" value="{{$data['city']}}">
                          </div>
                        </div>
                        <div class="form-group pb-2">
                          <label for="">Address</label>
                          <input type="text" class="form-control" name="address" value="{{$data['address']}}">
                        </div>
                        <div class="form-group pb-2">
                          <label for="">Postal</label>
                          <input type="text" class="form-control" name="postal" value="{{$data['postal']}}">
                        </div>
                        <div class="form-group pb-2">
                          <label for="">Image</label>
                          <div class="input-group pull-left">
                            <span class="input-group-btn">
                                <a data-input="pImgUsr" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                            </span>
                            <input id="pImgUsr" class="form-control input-sm" type="text" name="image" value="{{$data['image']}}">
                          </div>
                        </div>
                    </div>                  
                </div>
            </div>            
        </div>
    </div>
</form>
@endsection
@section('customScripts')
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
  $('.image-placeholder').filemanager('image');
    
  $(document).ready(function () {
        // Generate random password
        function generatePassword() {
            const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            let password = "";
            for (let i = 0; i < 8; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return password;
        }

        // Handle Generate Password
        $(document).on('click', '.generate-password', function () {
            const input = $(this).closest('.input-group').find('.password-input');
            const password = generatePassword();
            input.val(password);
        });

        // Handle Show/Hide Password
        $(document).on('click', '.toggle-password', function () {
            const input = $(this).closest('.input-group').find('.password-input');
            const isPassword = input.attr('type') === 'password';
            input.attr('type', isPassword ? 'text' : 'password');
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
@endsection