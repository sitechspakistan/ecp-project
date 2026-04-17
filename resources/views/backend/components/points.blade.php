<div class="comp-item points_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="points_{{$rand}}" style="background: url({{asset('components/points.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][points][eye]" class="points_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="points_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_points_{{$rand}}" style="display: none;">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][points][point_1][icon]" value="{{$meta['point_1']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][points][point_1][title]" value="{{$meta['point_1']['title']??''}}">
                </div>
                <div class="form-group pb-1">
                    <textarea type="text" class="form-control" placeholder="Description" name="components[{{$rand}}][points][point_1][desc]">{{$meta['point_1']['desc']??''}}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][points][point_2][icon]" value="{{$meta['point_2']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][points][point_2][title]" value="{{$meta['point_2']['title']??''}}">
                </div>
                <div class="form-group pb-1">
                    <textarea type="text" class="form-control" placeholder="Description" name="components[{{$rand}}][points][point_2][desc]">{{$meta['point_2']['desc']??''}}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][points][point_3][icon]" value="{{$meta['point_3']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][points][point_3][title]" value="{{$meta['point_3']['title']??''}}">
                </div>
                <div class="form-group pb-1">
                    <textarea type="text" class="form-control" placeholder="Description" name="components[{{$rand}}][points][point_3][desc]">{{$meta['point_3']['desc']??''}}</textarea>
                </div>
            </div>
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="points_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>