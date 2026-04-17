<div class="comp-item counters_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="counters_{{$rand}}" style="background: url({{asset('components/counters.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][counters][eye]" class="counters_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="counters_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_counters_{{$rand}}" style="display: none;">
        <div class="row pb-2">
            <div class="col-md-6 offset-3">
                <div class="form-group">
                    <label for=""><b>Background Image <small>(1920x700)</small>:</b> <br> <small>if you leave blank the below field it will show <b>default background</b></small></label>
                    <div class="input-group pull-left">
                        <span class="input-group-btn">
                            <a data-input="counterBg-{{$rand}}" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                        </span>
                        <input id="counterBg-{{$rand}}" class="form-control input-sm" type="text" name="components[{{$rand}}][counters][bg]" value="{{$meta['bg']??''}}">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][counters][counter_1][icon]" value="{{$meta['counter_1']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Count" name="components[{{$rand}}][counters][counter_1][count]" value="{{$meta['counter_1']['count']??''}}">
                </div>                
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][counters][counter_1][title]" value="{{$meta['counter_1']['title']??''}}">
                </div>                
            </div>
            <div class="col-md-3">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][counters][counter_2][icon]" value="{{$meta['counter_2']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Count" name="components[{{$rand}}][counters][counter_2][count]" value="{{$meta['counter_2']['count']??''}}">
                </div>                
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][counters][counter_2][title]" value="{{$meta['counter_2']['title']??''}}">
                </div>                
            </div>
            <div class="col-md-3">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][counters][counter_3][icon]" value="{{$meta['counter_3']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Count" name="components[{{$rand}}][counters][counter_3][count]" value="{{$meta['counter_3']['count']??''}}">
                </div>                
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][counters][counter_3][title]" value="{{$meta['counter_3']['title']??''}}">
                </div>                
            </div>
            <div class="col-md-3">
                <div class="form-group pb-1 icon-input">
                    <input type="text" class="form-control" placeholder="Icon Code" name="components[{{$rand}}][counters][counter_4][icon]" value="{{$meta['counter_4']['icon']??''}}">
                    <a href="javascript:;"><i class="fa fa-plus"></i></a>
                </div>
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Count" name="components[{{$rand}}][counters][counter_4][count]" value="{{$meta['counter_4']['count']??''}}">
                </div>                
                <div class="form-group pb-1">
                    <input type="text" class="form-control" placeholder="Title" name="components[{{$rand}}][counters][counter_4][title]" value="{{$meta['counter_4']['title']??''}}">
                </div>                
            </div>
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="counters_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>