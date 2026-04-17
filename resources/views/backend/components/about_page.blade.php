<div class="comp-item about_page_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="about_page_{{$rand}}" style="background: url({{asset('components/about_page.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][about_page][eye]" class="about_page_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="about_page_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_about_page_{{$rand}}" style="display: none;">
        <div class="row">
            <div class="col-md-10 offset-2">
                <div class="form-group pb-2">
                    <input type="text" placeholder="Title" class="form-control" name="components[{{$rand}}][about_page][title]" value="{{$meta['title']??''}}">
                </div>                
                <div class="form-group pb-1">
                    <textarea class="form-control editor" name="components[{{$rand}}][about_page][desc]">{{ $meta['desc'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <div class="input-group pull-left">
                        <span class="input-group-btn">
                            <a data-input="about_pageCompImg-{{$rand}}" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                        </span>
                        <input id="about_pageCompImg-{{$rand}}" class="form-control input-sm" type="text" name="components[{{$rand}}][about_page][img]" value="{{$meta['img']??''}}">
                    </div>
                </div>
                <p><strong>PS: </strong>if you leave the <strong>video embed code</strong> blank the image will show up.</p>
                <div class="row pt-1 pb-1">
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Button Text" class="form-control" name="components[{{$rand}}][about_page][btntext]" value="{{$meta['btntext']??''}}">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Button Link" class="form-control" name="components[{{$rand}}][about_page][btnlink]" value="{{$meta['btnlink']??''}}">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-check form-switch col-md-3">
                        <input class="form-check-input" type="checkbox" id="aboutc1-{{$rand}}" name="components[{{$rand}}][about_page][is_sidebar]" value="1" {{(isset($meta['is_sidebar']) && $meta['is_sidebar']==1)?'checked':''}}>
                        <label class="form-check-label" for="aboutc1-{{$rand}}">Show Sidebar</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="aboutchildrens-{{$rand}}" name="components[{{$rand}}][about_page][show_childrens]" value="1" {{(isset($meta['show_childrens']) && $meta['show_childrens']==1)?'checked':''}}>
                            <label class="form-check-label" for="aboutchildrens-{{$rand}}">Show Childrens</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="aboutrelated-{{$rand}}" name="components[{{$rand}}][about_page][show_related]" value="1" {{(isset($meta['show_related']) && $meta['show_related']==1)?'checked':''}}>
                            <label class="form-check-label" for="aboutrelated-{{$rand}}">Show Related</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Sidebar Position</label>
                        <select name="components[{{$rand}}][about_page][sidebar_position]" class="form-select">
                            <option value="right" {{(isset($meta['sidebar_position']) && $meta['sidebar_position']=='right')?'selected':''}}>Right</option>
                            <option value="left" {{(isset($meta['sidebar_position']) && $meta['sidebar_position']=='left')?'selected':''}}>Left</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Sidebar Menu</label>
                        <select name="components[{{$rand}}][about_page][sidebar_menu]" class="form-select">
                            @foreach(getMenus() as $menu)
                            <option value="{{$menu->id}}" {{(isset($meta['sidebar_menu']) && $meta['sidebar_menu']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>            
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="about_page_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>