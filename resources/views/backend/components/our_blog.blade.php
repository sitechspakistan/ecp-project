<div class="comp-item our_blog_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="our_blog_{{$rand}}" style="background: url({{asset('components/our_blog.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][our_blog][eye]" class="our_blog_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="our_blog_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_our_blog_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group pb-1">
                    <input type="text" placeholder="Title" class="form-control" name="components[{{$rand}}][our_blog][title]" value="{{$meta['title']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group pb-1">
                    <input type="text" placeholder="Sub Title" class="form-control" name="components[{{$rand}}][our_blog][sub_title]" value="{{$meta['sub_title']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group pb-1">
                    <input type="number" placeholder="No. of Items" class="form-control" name="components[{{$rand}}][our_blog][limit]" value="{{$meta['limit']??''}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][our_blog][btntext]" value="{{$meta['btntext']??''}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" placeholder="Button Link" class="form-control" name="components[{{$rand}}][our_blog][btnlink]" value="{{$meta['btnlink']??''}}">
                </div>
            </div>         
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="our_blog_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>