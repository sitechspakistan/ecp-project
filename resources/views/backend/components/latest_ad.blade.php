<div class="comp-item latest_ad_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="latest_ad_{{$rand}}" style="background: url({{asset('components/latest_ad.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][latest_ad][eye]" class="latest_ad_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="latest_ad_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_latest_ad_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Heading" class="form-control" name="components[{{$rand}}][latest_ad][heading]" value="{{$meta['heading']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Sub Heading" class="form-control" name="components[{{$rand}}][latest_ad][sub_heading]" value="{{$meta['sub_heading']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Limit" class="form-control" name="components[{{$rand}}][latest_ad][limit]" value="{{$meta['limit']??12}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][latest_ad][btn_txt]" value="{{$meta['btn_txt']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][latest_ad][btn_link]" value="{{$meta['btn_link']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <select class="form-control select2" name="components[{{$rand}}][latest_ad][category_type][]" multiple>
                        <option value="1" {{ (isset($meta['category_type']) && in_array("1", $meta['category_type']))?'selected':'' }}>DOGS BREED</option>
                        <option value="2" {{ (isset($meta['category_type']) && in_array("2", $meta['category_type']))?'selected':'' }}>PET SUPPLIES</option>
                        <option value="3" {{ (isset($meta['category_type']) && in_array("3", $meta['category_type']))?'selected':'' }}>PET PRODUCT</option>
                    </select>
                </div>
            </div>

        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="latest_ad_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>