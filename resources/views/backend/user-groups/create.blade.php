@extends('layouts.backend')
@section('title', 'Create User Group')
@section('customStyles')
<style>
    .light-fields {
        background: transparent;
        border: 2px solid #cecece;
        padding: 11px;
        border-radius: 12px;
    }
</style>
@endsection
@section('content')
<form action="{{route('usergroups.store')}}" method="POST">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                User Group
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('usergroups.index')}}">User Groups</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  Create 
                </li>
              </ol>
            </div>
            <button type="submit" class="btn btn-outline-success me-1 mb-3">
                <i class="fa fa-fw fa-save me-1"></i> Save
            </button>        
          </div>
          <hr>
          <div class="row">
            <div class="col-md-9">
                <input type="text" name="name" class="form-control light-fields" id="page-title" placeholder="Name" required>
                @csrf
            </div>
            <div class="col-md-3">
                <a href="javascript:;" class="btn btn-outline-info" id="toggleChecks">Check/Uncheck All</a>
            </div>            
        </div>
        </div>
    </div>
    
    <div class="content">      
      <div class="block block-rounded mt-3">          
          <div class="block-content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Show</th>
                        <th>Create</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(siteModules() as $module)
                    <tr>
                        <th><a href="javascript:;" class="module" data-id="{{$module}}">{{ucfirst($module)}}</a></th>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input c-{{$module}}" type="checkbox" value="1" id="mod-{{$module}}-show" name="modules[{{$module}}][_show]">
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input c-{{$module}}" type="checkbox" value="1" id="mod-{{$module}}-create" name="modules[{{$module}}][_create]">
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input c-{{$module}}" type="checkbox" value="1" id="mod-{{$module}}-edit" name="modules[{{$module}}][_edit]">
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input c-{{$module}}" type="checkbox" value="1" id="mod-{{$module}}-delete" name="modules[{{$module}}][_delete]">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
      </div>                
    </div>
</form>
@endsection
@section('customScripts')
<script type="text/javascript">
    $(".module").click(function(){
        var checkBoxs = $(':checkbox.c-'+$(this).data('id'));
        checkBoxs.prop('checked',!checkBoxs.prop('checked'));
    });
    $("#toggleChecks").click(function(){
        var checkBoxs = $(':checkbox');
        checkBoxs.prop('checked',!checkBoxs.prop('checked'));
    });
</script>
@endsection