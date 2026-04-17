@extends('layouts.backend')
@section('title', 'Configurations')
@section('customStyles')

@endsection
@section('content')
<form action="{{route('updateConfiguration')}}" method="POST" id="updateForm">
    <div class="bg-body-light">
        <div class="content content-full">
          <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
              <h1 class="h3 fw-bold mb-1">
                Configuration
              </h1>
              {{-- <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                Multiple style options to match your preferences.
              </h2> --}}
              <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                  <a class="link-fx" href="{{route('dashboard')}}">Dashboard</a>
                </li>                
                <li class="breadcrumb-item" aria-current="page">
                    Configuration 
                </li>
              </ol>
            </div>
            <button type="submit" class="btn btn-outline-success me-1 mb-3">
              @csrf
                <i class="fa fa-fw fa-save me-1"></i> Save
            </button>        
          </div>
        </div>
    </div>
    
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded row g-0">
                    <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-4 col-xxl-2" role="tablist">
                      <li class="nav-item d-md-flex flex-md-column">
                        <button type="button" class="nav-link text-md-start active" id="general-t-tab" data-bs-toggle="tab" data-bs-target="#general-t" role="tab" aria-controls="general-tab" aria-selected="true">
                          <i class="fa fa-fw fa-home opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>General</span>
                          <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                            Here you change the general setting of your website.
                          </span>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button type="button" class="nav-link text-md-start" id="social-t-tab" data-bs-toggle="tab" data-bs-target="#social-t" role="tab" aria-controls="social-t" aria-selected="false">
                          <i class="fa fa-fw fa-user-circle opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>Social</span>
                          <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                            Here you can manage your social links of your website.
                          </span>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button type="button" class="nav-link text-md-start" id="footer-t-tab" data-bs-toggle="tab" data-bs-target="#footer-t" role="tab" aria-controls="footer-t" aria-selected="false">
                          <i class="fa fa-fw fa-cog opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>Footer</span>
                          <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                            Here you can manage your footer of your website.
                          </span>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button type="button" class="nav-link text-md-start" id="sidebar-t-tab" data-bs-toggle="tab" data-bs-target="#sidebar-t" role="tab" aria-controls="sidebar-t" aria-selected="false">
                          <i class="fa fa-fw fa-list opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>Sidebar</span>
                          <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                            Here you can manage your all sidebars of the website
                          </span>
                        </button>
                      </li>
                      <li class="nav-item d-md-flex flex-md-column">
                        <button type="button" class="nav-link text-md-start" id="seo-t-tab" data-bs-toggle="tab" data-bs-target="#seo-t" role="tab" aria-controls="seo-t" aria-selected="false">
                          <i class="fa fa-fw fa-hashtag opacity-50 me-1 d-none d-sm-inline-block"></i>
                          <span>SEO Related</span>
                          <span class="d-none d-md-block fs-xs fw-medium opacity-75 mt-md-2">
                            Here you can manage your seo related things of the website
                          </span>
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content col-md-8 col-xxl-10">
                      <div class="block-content tab-pane active" id="general-t" role="tabpanel" aria-labelledby="general-t-tab" tabindex="0">
                        <h4 class="fw-semibold">General</h4>
                        <div class="row">
                          <div class="form-group col-md-6 pb-2">
                            <label for="">Watermark</label>
                            <div class="input-group pull-left">
                              <span class="input-group-btn">
                                  <a data-input="watermark-img" class="btn btn-success image-placeholder" style="padding:4px 10px;"><i class="fa fa-picture-o"></i> Choose</a>
                              </span>
                              <input id="watermark-img" class="form-control input-sm" type="text" name="watermark" value="{{$data['watermark']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-2">
                            <label for="">Top Bar Menu</label>
                            <select name="topbar_meta[menu_id]" class="form-select">
                                @foreach(getMenus() as $menu)
                                <option value="{{$menu->id}}" {{(isset($data['topbar_meta']['menu_id']) && $data['topbar_meta']['menu_id']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <h4>Contact Information</h4>
                        <div class="row">                          
                          <div class="form-group col-md-3">
                            <label for="">Email</label>
                            <input name="contact_meta[email]" class="form-control" value="{{$data['contact_meta']['email']??''}}">
                          </div>                          
                          <div class="form-group col-md-3">
                            <label for="">Phone</label>
                            <input name="contact_meta[phone]" class="form-control" value="{{$data['contact_meta']['phone']??''}}">
                          </div>                          
                          <div class="form-group col-md-3">
                            <label for="">Website</label>
                            <input name="contact_meta[website]" class="form-control" value="{{$data['contact_meta']['website']??''}}">
                          </div>  
                          <div class="form-group col-md-3">
                            <label for="">Address</label>
                            <textarea name="contact_meta[address]" class="form-control">{{$data['contact_meta']['address']??''}}</textarea>
                          </div>
                        </div>
                        <hr>
                        <h5>Contact Email <small>(Where the form goes. You can input multiple with comma seperated.)</small></h5>                        
                        <input name="contact_mails" class="form-control mb-4" value="{{$data['contact_mails']??''}}">
                        <h5>Thank You Message</h5>                        
                        <textarea name="contact_meta[thank_msg]" class="form-control">{{$data['contact_meta']['thank_msg']??''}}</textarea>
                      </div>
                      <div class="block-content tab-pane" id="social-t" role="tabpanel" aria-labelledby="social-t-tab" tabindex="0">
                        <h4 class="fw-semibold">Social</h4>
                        <div class="row">
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-facebook-f"></i>
                              </span>
                              <input type="text" class="form-control" id="social-facebook" name="social_meta[facebook]" value="{{$data['social_meta']['facebook']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-twitter"></i>
                              </span>
                              <input type="text" class="form-control" id="social-twitter" name="social_meta[twitter]" value="{{$data['social_meta']['twitter']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-pinterest"></i>
                              </span>
                              <input type="text" class="form-control" id="social-pinterest" name="social_meta[pinterest]" value="{{$data['social_meta']['pinterest']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-youtube"></i>
                              </span>
                              <input type="text" class="form-control" id="social-youtube" name="social_meta[youtube]" value="{{$data['social_meta']['youtube']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-instagram"></i>
                              </span>
                              <input type="text" class="form-control" id="social-instagram" name="social_meta[instagram]" value="{{$data['social_meta']['instagram']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-tiktok"></i>
                              </span>
                              <input type="text" class="form-control" id="social-tiktok" name="social_meta[tiktok]" value="{{$data['social_meta']['tiktok']??''}}">
                            </div>
                          </div>
                          <div class="form-group col-md-6 pb-1">
                            <div class="input-group">
                              <span class="input-group-text">
                                <i class="fab fa-linkedin"></i>
                              </span>
                              <input type="text" class="form-control" id="social-linkedin" name="social_meta[linkedin]" value="{{$data['social_meta']['linkedin']??''}}">
                            </div>
                          </div>
                        </div>                        
                      </div>
                      <div class="block-content tab-pane" id="footer-t" role="tabpanel" aria-labelledby="footer-t-tab" tabindex="0">
                        <h4 class="fw-semibold">Footer</h4>
                        <div class="row">
                          <div class="form-group col-md-4">
                            <label for="">Footer Menu 1</label>
                            <select name="footer_meta[menu_1]" class="form-select">
                                @foreach(getMenus() as $menu)
                                <option value="{{$menu->id}}" {{(isset($data['footer_meta']['menu_1']) && $data['footer_meta']['menu_1']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="">Footer Menu 2</label>
                            <select name="footer_meta[menu_2]" class="form-select">
                                @foreach(getMenus() as $menu)
                                <option value="{{$menu->id}}" {{(isset($data['footer_meta']['menu_2']) && $data['footer_meta']['menu_2']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="">Footer Menu 3</label>
                            <select name="footer_meta[menu_3]" class="form-select">
                                @foreach(getMenus() as $menu)
                                <option value="{{$menu->id}}" {{(isset($data['footer_meta']['menu_3']) && $data['footer_meta']['menu_3']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="">Footer Menu 4</label>
                            <select name="footer_meta[menu_4]" class="form-select">
                                @foreach(getMenus() as $menu)
                                <option value="{{$menu->id}}" {{(isset($data['footer_meta']['menu_4']) && $data['footer_meta']['menu_4']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group col-md-4">
                            <label for="">Footer Content</label>
                            <textarea name="footer_meta[content]" class="form-control">{{$data['footer_meta']['content']??''}}</textarea>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="">Newsletter</label>
                            <textarea name="footer_meta[nl_text]" class="form-control">{{$data['footer_meta']['nl_text']??''}}</textarea>
                          </div>

                          @for($x=0; $x <= 2; $x++)
                          <div class="form-group col-md-4">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Unique Vistor Heading</label>
                                <input type="text" name="footer_meta[unique_vistor][{{$x}}][heading]" class="form-control" value="{{ ($data['footer_meta']['unique_vistor'][$x]['heading'])??'' }}">
                              </div>
                              <div class="form-group">
                                <label for="">Unique Vistor Text</label>
                                <input type="text" name="footer_meta[unique_vistor][{{$x}}][content]" class="form-control" value="{{ ($data['footer_meta']['unique_vistor'][$x]['content'])??'' }}">
                              </div>
                            </div>
                          </div>
                          @endfor

                          
                        </div>                                                
                      </div>
                      <div class="block-content tab-pane" id="sidebar-t" role="tabpanel" aria-labelledby="sidebar-t-tab" tabindex="0">
                        <h4 class="fw-semibold">Sidebar</h4>
                        <div class="row">
                          <h5>News Sidebar</h5>
                          <div class="form-check form-switch col-md-3">
                              <input class="form-check-input" type="checkbox" id="news_sidebar" name="sidebar_meta[on_news]" value="1" {{(isset($data['sidebar_meta']['on_news']) && $data['sidebar_meta']['on_news']==1)?'checked':''}}>
                              <label class="form-check-label" for="news_sidebar">Show Sidebar</label>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Position</label>
                              <select name="sidebar_meta[news][sidebar_position]" class="form-select">
                                  <option value="right" {{(isset($data['sidebar_meta']['news']['sidebar_position']) && $data['sidebar_meta']['news']['sidebar_position']=='right')?'selected':''}}>Right</option>
                                  <option value="left" {{(isset($data['sidebar_meta']['news']['sidebar_position']) && $data['sidebar_meta']['news']['sidebar_position']=='left')?'selected':''}}>Left</option>
                              </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Menu</label>
                              <select name="sidebar_meta[news][sidebar_menu]" class="form-select">
                                  @foreach(getMenus() as $menu)
                                  <option value="{{$menu->id}}" {{(isset($data['sidebar_meta']['news']['sidebar_menu']) && $data['sidebar_meta']['news']['sidebar_menu']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <hr>                                                
                        <div class="row">
                          <h5>Blogs Sidebar</h5>
                          <div class="form-check form-switch col-md-3">
                              <input class="form-check-input" type="checkbox" id="blogs_sidebar" name="sidebar_meta[on_blogs]" value="1" {{(isset($data['sidebar_meta']['on_blogs']) && $data['sidebar_meta']['on_blogs']==1)?'checked':''}}>
                              <label class="form-check-label" for="blogs_sidebar">Show Sidebar</label>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Position</label>
                              <select name="sidebar_meta[blogs][sidebar_position]" class="form-select">
                                  <option value="right" {{(isset($data['sidebar_meta']['blogs']['sidebar_position']) && $data['sidebar_meta']['blogs']['sidebar_position']=='right')?'selected':''}}>Right</option>
                                  <option value="left" {{(isset($data['sidebar_meta']['blogs']['sidebar_position']) && $data['sidebar_meta']['blogs']['sidebar_position']=='left')?'selected':''}}>Left</option>
                              </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Menu</label>
                              <select name="sidebar_meta[blogs][sidebar_menu]" class="form-select">
                                  @foreach(getMenus() as $menu)
                                  <option value="{{$menu->id}}" {{(isset($data['sidebar_meta']['blogs']['sidebar_menu']) && $data['sidebar_meta']['blogs']['sidebar_menu']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <hr>                                                
                        <div class="row">
                          <h5>Events Sidebar</h5>
                          <div class="form-check form-switch col-md-3">
                              <input class="form-check-input" type="checkbox" id="events_sidebar" name="sidebar_meta[on_events]" value="1" {{(isset($data['sidebar_meta']['on_events']) && $data['sidebar_meta']['on_events']==1)?'checked':''}}>
                              <label class="form-check-label" for="events_sidebar">Show Sidebar</label>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Position</label>
                              <select name="sidebar_meta[events][sidebar_position]" class="form-select">
                                  <option value="right" {{(isset($data['sidebar_meta']['events']['sidebar_position']) && $data['sidebar_meta']['events']['sidebar_position']=='right')?'selected':''}}>Right</option>
                                  <option value="left" {{(isset($data['sidebar_meta']['events']['sidebar_position']) && $data['sidebar_meta']['events']['sidebar_position']=='left')?'selected':''}}>Left</option>
                              </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Menu</label>
                              <select name="sidebar_meta[events][sidebar_menu]" class="form-select">
                                  @foreach(getMenus() as $menu)
                                  <option value="{{$menu->id}}" {{(isset($data['sidebar_meta']['events']['sidebar_menu']) && $data['sidebar_meta']['events']['sidebar_menu']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <hr>                                                
                        <div class="row">
                          <h5>Services Sidebar</h5>
                          <div class="form-check form-switch col-md-3">
                              <input class="form-check-input" type="checkbox" id="service_sidebar" name="sidebar_meta[on_service]" value="1" {{(isset($data['sidebar_meta']['on_service']) && $data['sidebar_meta']['on_service']==1)?'checked':''}}>
                              <label class="form-check-label" for="service_sidebar">Show Sidebar</label>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Position</label>
                              <select name="sidebar_meta[service][sidebar_position]" class="form-select">
                                  <option value="right" {{(isset($data['sidebar_meta']['service']['sidebar_position']) && $data['sidebar_meta']['service']['sidebar_position']=='right')?'selected':''}}>Right</option>
                                  <option value="left" {{(isset($data['sidebar_meta']['service']['sidebar_position']) && $data['sidebar_meta']['service']['sidebar_position']=='left')?'selected':''}}>Left</option>
                              </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Menu</label>
                              <select name="sidebar_meta[service][sidebar_menu]" class="form-select">
                                  @foreach(getMenus() as $menu)
                                  <option value="{{$menu->id}}" {{(isset($data['sidebar_meta']['service']['sidebar_menu']) && $data['sidebar_meta']['service']['sidebar_menu']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <hr>                                                
                        <div class="row">
                          <h5>Albums Sidebar</h5>
                          <div class="form-check form-switch col-md-3">
                              <input class="form-check-input" type="checkbox" id="albums_sidebar" name="sidebar_meta[on_albums]" value="1" {{(isset($data['sidebar_meta']['on_albums']) && $data['sidebar_meta']['on_albums']==1)?'checked':''}}>
                              <label class="form-check-label" for="albums_sidebar">Show Sidebar</label>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Position</label>
                              <select name="sidebar_meta[albums][sidebar_position]" class="form-select">
                                  <option value="right" {{(isset($data['sidebar_meta']['albums']['sidebar_position']) && $data['sidebar_meta']['albums']['sidebar_position']=='right')?'selected':''}}>Right</option>
                                  <option value="left" {{(isset($data['sidebar_meta']['albums']['sidebar_position']) && $data['sidebar_meta']['albums']['sidebar_position']=='left')?'selected':''}}>Left</option>
                              </select>
                          </div>
                          <div class="form-group col-md-4">
                              <label for="">Sidebar Menu</label>
                              <select name="sidebar_meta[albums][sidebar_menu]" class="form-select">
                                  @foreach(getMenus() as $menu)
                                  <option value="{{$menu->id}}" {{(isset($data['sidebar_meta']['albums']['sidebar_menu']) && $data['sidebar_meta']['albums']['sidebar_menu']==$menu->id)?'selected':''}}>{{$menu->title}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <hr>                                                
                      </div>
                      <div class="block-content tab-pane" id="seo-t" role="tabpanel" aria-labelledby="seo-t-tab" tabindex="0">
                        <h4 class="fw-semibold">SEO Related</h4>
                        <div class="row">
                          <div class="col-md-12">
                            <h5>Google Analytics</h5>
                            <div class="form-group">
                              <label for="">Tracking code</label>
                              <input name="tracking_code" class="form-control" value="{{$data['tracking_code']??''}}">
                            </div>
                            <h5 class="mt-3">Robots.txt</h5>
                            <div class="form-group">
                              <label for="">robot.txt</label>
                              <textarea type="text" class="form-control" name="robot" rows="15">{!! $data['robot']??'' !!}</textarea>
                            </div>
                          </div>
                        </div>                        
                      </div>
                      
                    </div>
                </div>
            </div>            
        </div>
    </div>
</form>
@endsection
@section('customScripts')
<script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script>
  $('.image-placeholder').filemanager('image');
</script>
@endsection