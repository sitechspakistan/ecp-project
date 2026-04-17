<div class="comp-item slider_eye_parent_{{$rand}} {{(isset($meta['eye']) && $meta['eye']=='on')?'':'disabled-comp'}}" id="comp-{{$rand}}">
    <div class="col-md-12 component-div" id="slider_{{$rand}}" style="background: url({{asset('components/slider.jpg')}})">
        <div class="comp-actions">
            <ul>
                <li>
                    <a href="javascript:;" class="hide_comp" data-rand="{{$rand}}">
                        <i class="fa {{(isset($meta['eye']) && $meta['eye']=='on')?'fa-eye':'fa-eye-slash'}}"></i>
                        <input type="hidden" name="components[{{$rand}}][slider][eye]" class="slider_eye_{{$rand}}" value="{{(isset($meta['eye']) && $meta['eye']=='on')?'on':'off'}}" />
                    </a>
                </li>
                <li><a href="javascript:;" class="edit_comp" data-id="slider_{{$rand}}"><i class="fa fa-edit"></i></a></li>
                <li><a href="javascript:;" class="handle"><i class="fa fa-arrows"></i></a></li>
                <li><a href="javascript:;" class="remove_comp" data-rand="{{$rand}}"><i class="fa fa-times"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-12 component-edit-div" id="edit_slider_{{$rand}}" style="display: none;">        
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Slides</h4>
                    </div>
                    <div class="col-md-6 pull-right">
                        <a href="javascript:;" class="btn btn-s btn-primary add-slide" data-rand="{{$rand}}">Add Slide</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody class="slides-list" id="slides-list-{{$rand}}">
                        @isset($meta['images'])
                        @foreach($meta['images'] as $k => $img)
                        <tr>
                            <td colspan="4">
                                <table class="table table-vcenter">
                                    <tr>
                                        <td><a href="javascript:;" class="btn btn-link btn-xs move-slide"><i class="fa fa-bars"></i></a></td>
                                        <td>{{$meta['top_titles'][$k]??''}}</td>
                                        <td>{{$meta['titles'][$k]??''}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled edit-slide" data-bs-toggle="tooltip" aria-label="Edit Slide" data-bs-original-title="Edit Slide" data-uid="{{$k}}-{{$rand}}">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled delete-slide" data-bs-toggle="tooltip" aria-label="Remove Slide" data-bs-original-title="Remove Slide">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <div class="slideIns" id="slideDetail-{{$k}}-{{$rand}}" style="display: none;padding:20px;">
                                    <div class="form-group pb-2">
                                        <input type="text" class="form-control" placeholder="Top Title" value="{{$meta['top_titles'][$k]??''}}" name="components[{{$rand}}][slider][top_titles][]">
                                    </div>
                                    <div class="form-group pb-2">
                                        <input type="text" class="form-control" placeholder="Main Title" value="{{$meta['titles'][$k]??''}}" name="components[{{$rand}}][slider][titles][]">
                                    </div>
                                    <div class="form-group pb-2">
                                        <input type="text" class="form-control" placeholder="Description" value="{{$meta['desc'][$k]??''}}" name="components[{{$rand}}][slider][desc][]">
                                    </div>
                                    <div class="row">
                                        <div class="form-group pb-2 col-md-6">
                                            <input type="text" class="form-control" placeholder="Button Text" value="{{$meta['btntext'][$k]??''}}" name="components[{{$rand}}][slider][btntext][]">
                                        </div>
                                        <div class="form-group pb-2 col-md-6">
                                            <input type="text" class="form-control" placeholder="Button Link" value="{{$meta['btnlink'][$k]??''}}" name="components[{{$rand}}][slider][btnlink][]">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="image-placeholder" data-input="slideImg-{{$k}}-{{$rand}}" data-preview="slider-p-{{$k}}-{{$rand}}" id="slider-p-{{$k}}-{{$rand}}">
                                            <img src="{{$img??asset('placeholder.png')}}" class="img-responsive img-selection img-thumbnail img-thumbnail-set">
                                        </div>
                                        <input type="hidden" id="slideImg-{{$k}}-{{$rand}}" name="components[{{$rand}}][slider][images][]">
                                        <strong>Image Size: <small>1900 × 500 pixels</small></strong>
                                    </div>                                
                                </div>
                            </td>
                        </tr>                        
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
        <hr>        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:;" class="btn btn-xs btn-success save_comp" data-id="slider_{{$rand}}">save</a>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="slider-modal-{{$rand}}" tabindex="-1" role="dialog" aria-labelledby="slider-modal-{{$rand}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="block block-rounded block-transparent mb-0">
          <div class="block-header block-header-default">
            <h3 class="block-title">Add New Slide</h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <div class="block-content fs-sm">
            <div class="form-group pb-2">
                <input type="text" class="form-control slide-fields" placeholder="Top Title" id="slideTopTitleInput-{{$rand}}">
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control slide-fields" placeholder="Main Title" id="slideTitleInput-{{$rand}}">
            </div>
            <div class="form-group pb-2">
                <input type="text" class="form-control slide-fields" placeholder="Description" id="slideDescriptionInput-{{$rand}}">
            </div>
            <div class="row">
                <div class="form-group pb-2 col-md-6">
                    <input type="text" class="form-control slide-fields" placeholder="Button Text" id="slideBTextInput-{{$rand}}">
                </div>
                <div class="form-group pb-2 col-md-6">
                    <input type="text" class="form-control slide-fields" placeholder="Button Link" id="slideBLinkInput-{{$rand}}">
                </div>
            </div>
            <div class="form-group">
                <div class="image-placeholder" data-input="slideImg-{{$rand}}" data-preview="slider-p-{{$rand}}" id="slider-p-{{$rand}}">
                    <img src="{{asset('placeholder.png')}}" class="img-responsive img-selection img-thumbnail img-thumbnail-set">
                </div>
                <input type="hidden" id="slideImg-{{$rand}}">
                <strong>Image Size: <small>1900 × 500 pixels</small></strong>
            </div>
          </div>
          <div class="block-content block-content-full text-end bg-body">
            <a href="javascript:;" class="btn btn-sm btn-primary save-slide" data-rand="{{$rand}}" style="width: 100%;">Save</a>
          </div>
        </div>
      </div>
    </div>
</div>