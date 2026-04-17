<div class="comp-item earn_cash_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="earn_cash_{{$rand}}" style="background: url({{asset('components/earn_cash.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][earn_cash][eye]" class="earn_cash_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="earn_cash_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_earn_cash_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-8">
                <div class="form-group">
                    <textarea class="form-control" rows="11" name="components[{{$rand}}][earn_cash][desc]">{{ $meta['desc'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="col-md-4">

                <div class="form-group mb-2">
                    <div class="input-group pull-left">
                        <span class="input-group-btn">
                            <a data-input="home_searchCompImg-{{$rand}}" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                        </span>
                        <input id="home_searchCompImg-{{$rand}}" class="form-control input-sm" type="text" name="components[{{$rand}}][earn_cash][img]" value="{{$meta['img']??''}}" placeholder="Image">
                    </div>
                </div>

                <div class="form-group mb-2">
                    <input type="text" placeholder="Heading" class="form-control" name="components[{{$rand}}][earn_cash][heading]" value="{{$meta['heading']??''}}">
                </div>

                <div class="form-group mb-2">
                    <input type="text" placeholder="Sub Heading" class="form-control" name="components[{{$rand}}][earn_cash][sub_heading]" value="{{$meta['sub_heading']??''}}">
                </div>

                <div class="form-group mb-2">
                    <input type="text" placeholder="Button 1 Text" class="form-control" name="components[{{$rand}}][earn_cash][btn1_txt]" value="{{$meta['btn1_txt']??''}}">
                </div>

                <div class="form-group mb-2">
                    <input type="text" placeholder="Button 1 Link" class="form-control" name="components[{{$rand}}][earn_cash][btn1_link]" value="{{$meta['btn1_link']??''}}">
                </div>

                <div class="form-group mb-2">
                    <input type="text" placeholder="Button 2 Text" class="form-control" name="components[{{$rand}}][earn_cash][btn2_txt]" value="{{$meta['btn2_txt']??''}}">
                </div>

                <div class="form-group mb-2">
                    <input type="text" placeholder="Button 2 Link" class="form-control" name="components[{{$rand}}][earn_cash][btn2_link]" value="{{$meta['btn2_link']??''}}">
                </div>

            </div>

        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="earn_cash_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>