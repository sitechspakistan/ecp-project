<div class="comp-item our_subscription_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="our_subscription_{{$rand}}" style="background: url({{asset('components/our_subscription.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][our_subscription][eye]" class="our_subscription_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="our_subscription_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_our_subscription_{{$rand}}" style="display: none;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Heading" class="form-control" name="components[{{$rand}}][our_subscription][heading]" value="{{$meta['heading']??''}}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                    <input type="text" placeholder="Sub Heading" class="form-control" name="components[{{$rand}}][our_subscription][sub_heading]" value="{{$meta['sub_heading']??''}}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    @for ($x=0; $x<=3; $x++)
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <input type="text" placeholder="Subscription {{$x+1}} Title" class="form-control" name="components[{{$rand}}][our_subscription][subs][{{$x}}][heading]" value="{{$meta['subs'][$x]['heading']??''}}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" placeholder="Subscription {{$x+1}} Price" class="form-control" name="components[{{$rand}}][our_subscription][subs][{{$x}}][price]" value="{{$meta['subs'][$x]['price']??''}}">
                            </div>
                            <input type="hidden" name="components[{{$rand}}][our_subscription][subs][{{$x}}][type]" value="month" />
                            {{-- <div class="form-group mb-2">
                                <input type="number" placeholder="Subscription {{$x+1}} Duration" class="form-control" name="components[{{$rand}}][our_subscription][subs][{{$x}}][duration]" value="{{$meta['subs'][$x]['duration']??''}}">
                            </div>
                            <div class="form-group mb-2">
                                <select class="form-control" name="components[{{$rand}}][our_subscription][subs][{{$x}}][type]">
                                    <option value="" selected disabled style="display:none">Subscription {{$x+1}} Type</option>
                                    <option value="day" @if(isset($meta['subs'][$x]['type']) && $meta['subs'][$x]['type'] === 'day') selected @endif>Day</option>
                                    <option value="month" @if(isset($meta['subs'][$x]['type']) && $meta['subs'][$x]['type'] === 'month') selected @endif>Month</option>
                                    <option value="year" @if(isset($meta['subs'][$x]['type']) && $meta['subs'][$x]['type'] === 'year') selected @endif>Year</option>
                                </select>
                            </div> --}}
                            <div class="form-group mb-2">
                                <input type="text" placeholder="Subscription {{$x+1}} Button Text" class="form-control" name="components[{{$rand}}][our_subscription][subs][{{$x}}][btn_txt]" value="{{$meta['subs'][$x]['btn_txt']??''}}">
                            </div>
                            <div class="form-group mb-2">
                                <textarea rows="3" class="form-control" placeholder="Subscription {{$x+1}} Text" name="components[{{$rand}}][our_subscription][subs][{{$x}}][txt]">{{$meta['subs'][$x]['txt']??''}}</textarea>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="our_subscription_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>