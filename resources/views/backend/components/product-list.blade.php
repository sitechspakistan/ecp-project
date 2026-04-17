<div class="comp-item product-list_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="product-list_{{$rand}}" style="background: url({{asset('components/product-list.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][product-list][eye]" class="product-list_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="product-list_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_product-list_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="No of Records Per Page" class="form-control" name="components[{{$rand}}][product-list][no_of_record]" value="{{$meta['no_of_record']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <label class="form-check-label" for="aboutc1-{{$rand}}">Show Searchbar</label>
                    <div class="form-check form-switch col-md-12">
                        <input class="form-check-input" type="checkbox" id="aboutc1-{{$rand}}" name="components[{{$rand}}][product-list][is_searchbar]" value="1" {{(isset($meta['is_searchbar']) && $meta['is_searchbar']==1)?'checked':''}}>
                    </div>
                </div>
            </div>

        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="product-list_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>