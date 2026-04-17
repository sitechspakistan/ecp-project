<div class="comp-item page_title_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="page_title_{{$rand}}" style="background: url({{asset('components/page_title.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][page_title][eye]" class="page_title_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="page_title_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_page_title_{{$rand}}" style="display: none;">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="form-group pb-2">
                    <input type="text" placeholder="Title" class="form-control" name="components[{{$rand}}][page_title][title]" value="{{$meta['title']??''}}">
                </div>
                <div class="form-group">
                    <label for=""><b>Background Image <small>(1400x220)</small>:</b> <br> <small>if you leave blank the below field it will show <b>default background</b></small></label>
                    <div class="input-group pull-left">
                        <span class="input-group-btn">
                            <a data-input="pageTitleBg-{{$rand}}" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                        </span>
                        <input id="pageTitleBg-{{$rand}}" class="form-control input-sm" type="text" name="components[{{$rand}}][page_title][bg]" value="{{$meta['bg']??''}}">
                    </div>
                </div>
            </div>
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="page_title_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>