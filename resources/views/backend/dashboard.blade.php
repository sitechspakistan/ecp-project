@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')
<div class="content">
    <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
        <div class="flex-grow-1 mb-1 mb-md-0">
            <h1 class="h3 fw-bold mb-2">
              Dashboard
            </h1>
            <h2 class="h6 fw-medium fw-medium text-muted mb-0">
              Welcome <a class="fw-semibold" href="#">{{auth()->user()->name}}</a>,
            </h2>
          </div>
    </div>
</div>
<div class="content">
    <div class="row items-push">
      <div class="col-md-6">
        <div class="block block-rounded block-link-shadow">
          <div class="block-content block-content-full">
            <div class="row text-center">
              <div class="col-4 border-end">
                <div class="py-3">
                  <a href="{{route('news.index')}}" class="item item-circle bg-body-light mx-auto">
                    <i class="fa fa-clipboard-check text-primary"></i>
                  </a>
                  <dl class="mb-0">
                    <dt class="h3 fw-extrabold mt-3 mb-0">
                      {{$products_count}}
                    </dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">
                      <a href="{{route('products.index')}}" class="text-muted">Puppies</a>
                    </dd>
                  </dl>
                </div>
              </div>
              <div class="col-4 border-end">
                <div class="py-3">
                  <a href="{{route('events.index')}}" class="item item-circle bg-body-light mx-auto">
                    <i class="fa fa-clipboard-check text-primary"></i>
                  </a>
                  <dl class="mb-0">
                    <dt class="h3 fw-extrabold mt-3 mb-0">
                      {{$orders_count}}
                    </dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">
                      <a href="{{route('orders.index')}}" class="text-muted">Orders</a>
                    </dd>
                  </dl>
                </div>
              </div>
              <div class="col-4">
                <div class="py-3">
                  <a href="{{route('blogs.index')}}" class="item item-circle bg-body-light mx-auto">
                    <i class="fa fa-clipboard-check text-primary"></i>
                  </a>
                  <dl class="mb-0">
                    <dt class="h3 fw-extrabold mt-3 mb-0">
                      {{$blogs_count}}
                    </dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">
                      <a href="{{route('blogs.index')}}" class="text-muted">Blogs</a>
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="block block-rounded bg-primary">
          <div class="block-content block-content-full">
            <div class="row text-center">
              <div class="col-4 border-end border-black-op">
                <div class="py-3">
                  <a href="{{route('pages.index')}}" class="item item-circle bg-black-25 mx-auto">
                    <i class="si si-list text-white"></i>
                  </a>
                  <dl class="mb-0">
                    <dt class="text-white h3 fw-extrabold mt-3 mb-0">
                      {{$pages_count}}
                    </dt>
                    <dd class="text-white fs-sm fw-medium text-muted mb-0">
                      <a href="{{route('pages.index')}}" class="text-light">Pages</a>
                    </dd>
                  </dl>
                </div>
              </div>
              <div class="col-4 border-end border-black-op">
                <div class="py-3">
                  <a href="{{route('services.index')}}" class="item item-circle bg-black-25 mx-auto">
                    <i class="fa fa-gears text-white"></i>
                  </a>
                  <dl class="mb-0">
                    <dt class="text-white h3 fw-extrabold mt-3 mb-0">
                      {{$testimonials_count}}
                    </dt>
                    <dd class="text-white fs-sm fw-medium text-muted mb-0">
                      <a href="{{route('testimonials.index')}}" class="text-light">Testimonials</a>
                    </dd>
                  </dl>
                </div>
              </div>
              <div class="col-4">
                <div class="py-3">
                  <a href="{{route('users.index')}}" class="item item-circle bg-black-25 mx-auto">
                    <i class="fa fa-users-gear text-white"></i>
                  </a>
                  <dl class="mb-0">
                    <dt class="text-white h3 fw-extrabold mt-3 mb-0">
                      {{$users_count}}
                    </dt>
                    <dd class="text-white fs-sm fw-medium text-muted mb-0">
                      <a href="{{route('users.index')}}" class="text-light">Users</a>
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Recent Inbox Messages</h3>
            <div class="block-options space-x-1">
              <a href="{{route('inboxPage')}}" type="button" class="btn btn-sm btn-alt-secondary" data-class="d-none">
                <i class="fa fa-external-link"></i> View All
              </a>              
            </div>
          </div>          
          <div class="block-content block-content-full">
            <!-- Recent Orders Table -->
            <div class="table-responsive">
              <table class="table table-hover table-vcenter">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th class="">Name</th>
                    <th>Subject</th>
                    <th class="text-end">Created At</th>
                  </tr>
                </thead>
                <tbody class="fs-sm">
                  @foreach($messages as $msg)
                  <tr>
                    <td>{{$msg->id}}</td>
                    <td class="">{{$msg->name}}</td>
                    <td>{{$msg->subject}}</td>                    
                    <td class="fw-semibold text-muted text-end">{{$msg->created_at->diffForHumans()}}</td>                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- END Recent Orders Table -->
          </div>          
        </div>
      </div>
      <div class="col-md-4">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Recent Subscribers</h3>
            <div class="block-options space-x-1">
              <a href="{{route('subscribersPage')}}" type="button" class="btn btn-sm btn-alt-secondary" data-class="d-none">
                <i class="fa fa-external-link"></i>
              </a>              
            </div>
          </div>          
          <div class="block-content block-content-full">
            <!-- Recent Orders Table -->
            <div class="table-responsive">
              <table class="table table-hover table-vcenter">
                <thead>
                  <tr>
                    {{-- <th>ID</th> --}}
                    <th class="">Email</th>
                    <th class="text-end">Date</th>
                  </tr>
                </thead>
                <tbody class="fs-sm">
                  @foreach($subscribers as $sub)
                  <tr>
                    {{-- <td>1</td> --}}
                    <td class="">{{$sub->email}}</td>
                    <td class="fw-semibold text-muted text-end">{{$sub->created_at->diffForHumans()}}</td>                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- END Recent Orders Table -->
          </div>          
        </div>
      </div>
    </div>
</div>
@endsection