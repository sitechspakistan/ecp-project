<div class="comp-item blogs_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="blogs_{{$rand}}" style="background: url({{asset('components/blogs.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][blogs][eye]" class="blogs_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="blogs_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_blogs_{{$rand}}" style="display: none;">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="form-group pb-1">
                    <input type="text" placeholder="Title" class="form-control" name="components[{{$rand}}][blogs][title]" value="{{$meta['title']??''}}">
                </div>
                <div class="form-group pb-1">
                    <textarea placeholder="Description" class="form-control" name="components[{{$rand}}][blogs][desc]">{{$meta['desc']??''}}</textarea>
                </div>
                <div class="form-group pb-1">
                    <input type="number" placeholder="No. of Items" class="form-control" name="components[{{$rand}}][blogs][limit]" value="{{$meta['limit']??''}}">
                </div>
                <div class="row pb-1">
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][blogs][btntext]" value="{{$meta['btntext']??''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Button Link" class="form-control" name="components[{{$rand}}][blogs][btnlink]" value="{{$meta['btnlink']??''}}">
                    </div>
                </div>
            </div>            
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="blogs_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>