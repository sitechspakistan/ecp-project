<div class="comp-item about_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="about_{{$rand}}" style="background: url({{asset('components/about.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][about][eye]" class="about_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="about_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_about_{{$rand}}" style="display: none;">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group pb-2">
                    <input type="text" placeholder="Title" class="form-control" name="components[{{$rand}}][about][title]" value="{{$meta['title']??''}}">
                </div>                
                <div class="form-group">
                    <textarea class="form-control editor" name="components[{{$rand}}][about][desc]">{{ $meta['desc'] ?? '' }}</textarea>
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <textarea name="components[{{$rand}}][about][video]" placeholder="Video Embed Code" class="form-control">{!! $meta['video'] ?? '' !!}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">Image</label>
                    <div class="input-group pull-left">
                        <span class="input-group-btn">
                            <a data-input="aboutCompImg-{{$rand}}" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                        </span>
                        <input id="aboutCompImg-{{$rand}}" class="form-control input-sm" type="text" name="components[{{$rand}}][about][img]" value="{{$meta['img']??''}}">
                    </div>
                </div>
                <p><strong>PS: </strong>if you leave the <strong>video embed code</strong> blank the image will show up.</p>
            </div>
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="about_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>