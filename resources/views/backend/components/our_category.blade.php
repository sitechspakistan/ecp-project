<div class="comp-item our_category_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="our_category_{{$rand}}" style="background: url({{asset('components/our_category.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][our_category][eye]" class="our_category_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="our_category_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_our_category_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Heading" class="form-control" name="components[{{$rand}}][our_category][heading]" value="{{$meta['heading']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Sub Heading" class="form-control" name="components[{{$rand}}][our_category][sub_heading]" value="{{$meta['sub_heading']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <select name="components[{{$rand}}][our_category][category_type]" class="form-control light-fields">
                        <option value="" selected>All</option>
                        <option value="1" {{ (isset($meta['category_type']) && $meta['category_type']*1 === 1)?'selected':'' }}>DOGS BREED</option>
                        <option value="2" {{ (isset($meta['category_type']) && $meta['category_type']*1 === 2)?'selected':'' }}>PET SUPPLIES</option>
                        <option value="3" {{ (isset($meta['category_type']) && $meta['category_type']*1 === 3)?'selected':'' }}>PET PRODUCT</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Limit" class="form-control" name="components[{{$rand}}][our_category][limit]" value="{{$meta['limit']??12}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][our_category][btn_txt]" value="{{$meta['btn_txt']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][our_category][btn_link]" value="{{$meta['btn_link']??''}}">
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="our_category_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>
