<div class="comp-item home_announcement_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="home_announcement_{{$rand}}" style="background: url({{asset('components/home_announcement.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][home_announcement][eye]" class="home_announcement_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="home_announcement_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_home_announcement_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-4 form-group">
                <label>Speed</label>
                <select name="components[{{$rand}}][home_announcement][speed]" class="form-control input-sm">
                    @for($i=1; $i<=20; $i++)
                        <option value="{{$i}}" {{(isset($meta['speed']) && $meta['speed']==$i)?'selected':''}}>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label>Font Size</label>
                <select name="components[{{$rand}}][home_announcement][font_size]" class="form-control input-sm">
                    @for($i=10; $i<=20; $i++)
                        <option value="{{$i}}" {{(isset($meta['font_size']) && $meta['font_size']==$i)?'selected':''}}>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-4 form-group">
                <label for="">Image</label>
                <div class="input-group pull-left">
                    <span class="input-group-btn">
                        <a data-input="AnnouncmentCompImg-{{$rand}}" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                    </span>
                    <input id="AnnouncmentCompImg-{{$rand}}" class="form-control input-sm" type="text" name="components[{{$rand}}][home_announcement][img]" value="{{$meta['img']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label style="display: block;">No Of Record</label>
                    <select id="noofhome_announcement{{$rand}}" class="form-control" style="width:80%;display: inline-block;">
                        @for($i=1; $i<=5; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    <button type="button" class="btn btn-sm btn-primary addhome_announcement" style="margin-bottom: 0px;padding: 3px 8px !important;" data-key="{{$rand}}">ADD</button>
                </div>
            </div>

            <div class="col-md-12 mt-2" id="styleHomeAnnouncement{{$rand}}">
                @if(isset($meta['arr']))
                    @foreach($meta['arr'] as $i => $val1)
                    @php
                        $announcementText = $val1['text'] ?? null;
                        if ($announcementText === null || $announcementText === '') {
                            $announcementText = trim(implode(' ', array_filter([$val1['title'] ?? '', $val1['link'] ?? ''])));
                        }
                    @endphp
                    <div class="col-12 mb-2 border rounded p-3 pt-4 position-relative bg-body-light">
                        <button type="button" class="btn btn-sm btn-alt-secondary position-absolute top-0 end-0 mt-1 me-1 RemoveBreadcurm" aria-label="Remove announcement" style="padding: 5px;">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                        <div class="mb-0 pe-4">
                            <textarea name="components[{{$rand}}][home_announcement][arr][{{$i}}][text]" class="form-control form-control-sm" rows="4" placeholder="Announcement text">{{ $announcementText }}</textarea>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="home_announcement_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>