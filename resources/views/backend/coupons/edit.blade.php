@extends('layouts.backend')
@section('title', 'Edit Coupon')
@section('content')
<form action="{{route('coupons.update', $data->id)}}" method="POST">
  @csrf
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">Coupons</h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item"><a class="link-fx" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="link-fx" href="{{route('coupons.index')}}">Coupons</a></li>
            <li class="breadcrumb-item" aria-current="page">Edit</li>
          </ol>
        </div>
        <button type="submit" class="btn btn-outline-success me-1 mb-3">
          <i class="fa fa-fw fa-save me-1"></i> Save
        </button>
      </div>
    </div>
  </div>

  <div class="content">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Coupon Details</h3>
      </div>
      <div class="block-content">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Code <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="code" value="{{old('code', $data->code)}}" required autocomplete="off">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="title" value="{{old('title', $data->title)}}" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Discount Type <span class="text-danger">*</span></label>
            <select class="form-control" name="discount_type" required>
              <option value="percentage" {{old('discount_type', $data->discount_type)==='percentage'?'selected':''}}>Percentage</option>
              <option value="fixed" {{old('discount_type', $data->discount_type)==='fixed'?'selected':''}}>Fixed</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Discount Value <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="discount_value" value="{{old('discount_value', $data->discount_value)}}" required min="0" step="0.01">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-control" name="status" required>
              <option value="active" {{old('status', $data->status)==='active'?'selected':''}}>Active</option>
              <option value="inactive" {{old('status', $data->status)==='inactive'?'selected':''}}>Inactive</option>
            </select>
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{old('description', $data->description)}}</textarea>
          </div>
          <div class="col-md-6 mb-3 d-flex align-items-end">
            <div>
              <label class="form-label d-block">Options</label>
              <label class="form-check form-switch me-3">
                <input class="form-check-input" type="checkbox" name="show_on_website" {{old('show_on_website', $data->show_on_website)?'checked':''}}>
                <span class="form-check-label">Show on website</span>
              </label>
              <label class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_blocked" {{old('is_blocked', $data->is_blocked)?'checked':''}}>
                <span class="form-check-label">Blocked</span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
