<div class="comp-item breadcurm_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="breadcurm_{{$rand}}" style="background: url({{asset('components/breadcurm.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][breadcurm][eye]" class="breadcurm_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="breadcurm_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_breadcurm_{{$rand}}" style="display: none;">
        <div class="row">
            
            <div class="col-md-4 form-group">
                <label>Heading</label>
                <input type="text" name="components[{{$rand}}][breadcurm][heading]" class="form-control input-sm" placeholder="Heading" value="{{($meta['heading'])??''}}">
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label style="display: block;">No Of Record</label>
                    <select id="noofbreadcurm{{$rand}}" class="form-control" style="width:80%;display: inline-block;">
                        @for($i=1; $i<=5; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    <button type="button" class="btn btn-sm btn-primary addbreadcurm" style="margin-bottom: 0px;padding: 3px 8px !important;" data-key="{{$rand}}">ADD</button>
                </div>
            </div>

            <div class="col-md-12" id="styleBreadcurm{{$rand}}">
                @if(isset($meta['arr']))
                    @foreach($meta['arr'] as $i => $val1)
                    <div class="form-group col-md-3 mt-1" style="border:solid 1px #eaeaea;border-radius:5px;padding:14px 0px 0px 0px;position:relative;display:inline-block;">
                            <button type="button" class="btn btn-sm btn-danger RemoveBreadcurm" style="position: absolute;right: 2px;top: 2px;font-size: 0.5rem;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>

                            <div class="form-group col-md-11">
                                <input type="text" name="components[{{$rand}}][breadcurm][arr][{{$i}}][title]" class="form-control input-sm" placeholder="Title" value="{{ ($val1['title'])??'' }}">
                            </div>
        
                            <div class="form-group col-md-11">
                                <input type="text" name="components[{{$rand}}][breadcurm][arr][{{$i}}][link]" class="form-control input-sm" placeholder="Text" value="{{ ($val1['link'])??'' }}">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="breadcurm_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>