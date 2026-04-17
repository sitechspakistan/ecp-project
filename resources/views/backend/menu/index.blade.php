@extends('layouts.backend')
@section('title', 'Menu')
@section('customStyles')
<link rel="stylesheet" href="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.css')}}">
<style>
    /* General Nestable Style */
.dd {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    max-width: 600px;
    list-style: none;
    font-size: 14px;
    line-height: 20px;
}

.dd-list {
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
}

.dd-item {
    display: block;
    margin: 5px 0;
    padding: 0;
    min-height: 40px;
    line-height: 40px;
    color: #333;
    border: 1px solid #ddd;
    background: #f9f9f9;
    border-radius: 3px;
    position: relative;
}
.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }
.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }

.dd-item > button {
    display: block;
    position: relative;
    cursor: pointer;
    float: left;
    width: 25px;
    height: 40px;
    margin: 0;
    padding: 0;
    text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
    border: 0;
    background: #fafafa;
    border-right: 1px solid #ddd;
}

.dd-item > button:before {
    content: '+';
    display: block;
    position: absolute;
    width: 100%;
    text-align: center;
    text-indent: 0;
}

.dd-item > button[data-action="collapse"]:before {
    content: '-';
}

.dd-empty,
.dd-placeholder {
    display: block;
    margin: 5px 0;
    padding: 0;
    min-height: 40px;
    background: #f2f2f2;
    border: 1px dashed #ddd;
    box-sizing: border-box;
}
.dd-list .dd-list {
    padding-left: 30px;
}
</style>
@endsection
@section('content')
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">
            Menu
          </h1>
        </div>                
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4">                
            <select class="form-select" id="select-menu">
                <option value="">Select Menu</option>
                @foreach($menus as $value)
                <option value="{{route('editMenu',$value->id)}}" @isset($data['id']) {{($data['id']==$value->id)?'selected':''}} @endisset>{{$value->title}}</option>
                @endforeach
                <option value="new">Create New Menu</option>
            </select>
        </div>
        @if(isset($data))
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" form="updateForm" value="{{$data['title']}}" required>
                    </div>  
                    <div class="form-group">
                        <input type="checkbox" name="is_primary" value="1" form="updateForm" {{($data['is_primary']==1)?'checked':''}}> Make this menu as <b>Primary Menu</b>
                    </div>                  
                </div>
                <div class="col-md-5">
                    <div class="button-list">
                        <form action="{{route('deleteMenu',$data['id'])}}" method="POST" id="delete-menu">{{csrf_field()}}</form>
                        <button type="submit" form="updateForm" class="btn btn-md btn-success">Update</button>
                        <a href="javascript:;" id="deleteMenu" class="btn btn-md btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="clearfix"></div>
    </div>
  </div>
</div>
@isset($data)
<div class="content">
    <div class="row">
        <div class="col-md-5">
            <div class="block block-rounded block-mode-hidden">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Pages</h3>
                  <div class="block-options">                    
                    {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button> --}}
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                  </div>
                </div>
                <div class="block-content">
                    <ul class="links-ul">
                        @foreach($pages as $pid => $page)
                        <li>{{$page}} <a href="javascript:;" data-type="page" data-id="{{$pid}}" class="btn btn-success btn-sm add-item">Add <i class="fa fa-arrow-right"></i></a></li>
                        @endforeach                                    
                    </ul>
                </div>
              </div>
            <div class="block block-rounded block-mode-hidden">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Services</h3>
                  <div class="block-options">                    
                    {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button> --}}
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                  </div>
                </div>
                <div class="block-content">
                    <ul class="links-ul">
                        @foreach($services as $sid => $service)
                        <li>{{$service}} <a href="javascript:;" data-type="service" data-id="{{$sid}}" class="btn btn-success btn-sm add-item">Add <i class="fa fa-arrow-right"></i></a></li>
                        @endforeach 
                    </ul>
                </div>
            </div>
            <div class="block block-rounded block-mode-hidden">
                <div class="block-header block-header-default">
                  <h3 class="block-title">Custom Url</h3>
                  <div class="block-options">                    
                    {{-- <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                      <i class="si si-refresh"></i>
                    </button> --}}
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                  </div>
                </div>
                <div class="block-content">
                    <form id="customForm">
                        <div class="row pb-2">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" placeholder="Title" name="title" required>
                                <input type="hidden" name="type" value="custom">
                                @csrf
                            </div>
                            <div class="form-group col-md-10">
                                <input type="text" class="form-control" placeholder="Custom Link" name="url" required>
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" id="cusBtn" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="block block-rounded">
                <div class="block-content">
                    <form action="{{route('updateMenu',$data['id'])}}" id="updateForm" name="updateForm" method="POST">
                        {{csrf_field()}}
                        <div class="nestable-lists">                    
                            <div class="panel-group m-b-0" id="nested-accordion" role="tablist" aria-multiselectable="true">
                                <div id="main-div" class="dd">
                                    <ol class="dd-list" id="menu-items">                            
                                        @foreach($data->items->where('parent',null) as $key => $item)
                                            @component('backend.menu.menu-item',['meta'=>$item, 'type'=>$item->type, 'rand'=>$item->id, 'pages'=>$pages, 'services'=>$services]) @endcomponent                    
                                        @endforeach
                                    </ol>
                                </div>
                                <input type="hidden" id="nestable-output" name="orders">
                            </div>
                        </div>                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset

<div class="modal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{route('storeMenu')}}" method="POST">
          <div class="block block-rounded block-transparent mb-0">
            <div class="block-header block-header-default">
              <h3 class="block-title">Create Menu</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </div>
            <div class="block-content fs-sm">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Menu Name" required>
                </div>                
            </div>
            <div class="block-content block-content-full text-end bg-body">
              @csrf
              <button type="submit" class="btn btn-sm btn-primary" style="width: 100%;">Save</button>
            </div>          
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('customScripts')
<script src="{{asset('assets_backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets_backend/js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets_backend/js/jquery.nestable.js')}}"></script>
<script>
    $("#select-menu").change(function(){
        if($(this).val()=='new') {
            $("#createModal").modal('show');
        } else {
            location.href = $(this).val();
        }
    });    
</script>
<script>
    jQuery(document).ready(function(){
        initNestable();
    });
    var updateOutput = function(e)
    {
        e = $('#main-div');
        var list   = e.length ? e : $(e.target),
            output = $("#nestable-output");
            console.log(list);
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    function initNestable(){    
        $('#main-div').nestable({
            group: 1
        }).change(updateOutput);
        updateOutput($('#main-div').data('output', $('#nestable-output')));
    }
    $('#deleteMenu').click(function(){
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
            $("#delete-menu").submit();        
          } else {
            console.log('Deletion canceled');
          }
        });
    });
    $(".add-item").click(function(){
        var $btn = $(this);
        $btn.html('<i class="fa fa-refresh fa-spin"></i>');
        var data = {'_token':'{{csrf_token()}}', 'id': $btn.data('id'), 'type': $btn.data('type')}
        $.ajax({
            url: "{{route('addMenuItem')}}",
            data: data,
            type: "POST",
            success: function (data) {
                $("#menu-items").append(data);
                $btn.html('Add <i class="fa fa-arrow-right"></i>');
                initNestable();                
            },
        });        
    });
    $("#customForm").submit(function(e){
        var $btn = $("#cusBtn");
        $btn.html('<i class="fa fa-refresh fa-spin"></i>');
        var data = $(this).serialize();
        e.preventDefault();
        $.ajax({
            url: "{{route('addMenuItem')}}",
            data: data,
            type: "POST",
            success: function (data) {
                $("#menu-items").append(data);
                $btn.html('Add <i class="fa fa-arrow-right"></i>');
                $("#customForm").trigger('reset');
                initNestable();                
            },
        });        
    });
    $(document).on('click', '.dd-delete', function(){
        $(this).parent().remove();
        initNestable(); 
    });
</script>
<script>
$(document).on('click', '#nested-accordion .panel-title a', function (e) {
    e.preventDefault();
    const target = $(this).attr('href');
    const isActive = $(target).hasClass('in');
    $('#nested-accordion .panel-collapse').collapse('hide');
    if (!isActive) {
        $(target).collapse('show');
    }
});
</script>
@endsection