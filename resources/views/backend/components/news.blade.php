<div class="comp-item news_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="news_{{$rand}}" style="background: url({{asset('components/news.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][news][eye]" class="news_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="news_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_news_{{$rand}}" style="display: none;">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="form-group pb-1">
                    <input type="text" placeholder="Title" class="form-control" name="components[{{$rand}}][news][title]" value="{{$meta['title']??''}}">
                </div>
                <div class="form-group pb-1">
                    <input type="number" placeholder="No. of Items" class="form-control" name="components[{{$rand}}][news][limit]" value="{{$meta['limit']??''}}">
                </div>
            </div>            
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="news_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>