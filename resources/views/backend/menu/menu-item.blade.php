<li class="dd-item" data-id="{{$rand}}">
    <div class="dd-handle dd3-handle"></div>
    <a href="javascript:;" class="dd-delete btn btn-sm btn-danger"><i class="fas fa-remove"></i></a>
    <div class="panel panel-default bx-shadow-none">
        <div class="panel-heading" role="tab" id="headingMenu{{$rand}}">
            <h4 class="panel-title">
                @php $title = '';
                    if(isset($data['title'])){ $title = $data['title']; }
                    if(isset($meta['title'])){ $title = $meta['title']; }
                @endphp
                <a role="button" data-toggle="collapse" data-parent="#nested-accordion" href="#collapseMenu{{$rand}}" aria-expanded="true" aria-controls="collapseMenu{{$rand}}">
                    {{$title}} - <small>{{ucwords(str_replace('_',' ',$type))}}</small>                    
                </a>
            </h4>
        </div>
        <div id="collapseMenu{{$rand}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMenu{{$rand}}">
            <div class="panel-body">
                <div class="form-group">
                    <label for="">Title</label>                    
                    <input type="text" class="form-control" name="items[{{$rand}}][title]" value="{{$title}}" placeholder="Title">
                    <input type="hidden" name="items[{{$rand}}][type]" value="{{$type}}">
                    {{csrf_field()}}
                </div>
                @if($type=='page')
                @php $slug = '';
                     if(isset($data['slug'])){ $slug = $data['slug']; }
                     if(isset($meta['slug'])){ $slug = $meta['slug']; }
                @endphp
                <div class="form-group">
                    <label>Page</label>
                    <select name="items[{{$rand}}][slug]" id="" class="form-control">
                        @foreach($pages as $pslug => $page)
                        <option value="{{$pslug}}" {{($pslug==$slug)?'selected':''}}>{{$page}}</option>
                        @endforeach
                    </select>
                </div>
                @elseif($type=='service')
                @php $slug = '';
                     if(isset($data['slug'])){ $slug = $data['slug']; }
                     if(isset($meta['slug'])){ $slug = $meta['slug']; }
                @endphp
                <div class="form-group">
                    <label>Services</label>
                    <select name="items[{{$rand}}][slug]" id="" class="form-control">
                        @foreach($services as $cslug => $service)
                        <option value="{{$cslug}}" {{($cslug==$slug)?'selected':''}}>{{$service}}</option>
                        @endforeach
                    </select>
                </div>
                @elseif($type=='custom')                
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="items[{{$rand}}][url]" id="" class="form-control" value="{{$data['url']??$meta['url']}}">                    
                </div>
                @endif
                <div class="form-group">
                    <input type="checkbox" name="items[{{$rand}}][new_window]" value="1" {{(isset($meta['new_window']))?'checked':''}}> Open in new window
                </div>
            </div>
        </div>
    </div>
    @if(isset($meta) && $meta->childrens->count()>0)
    <ol class="dd-list">   
        @include('backend.menu.nested',['childrens' => $meta->childrens])
    </ol>
    @endif    
</li>