@extends('layouts.backend')
@section('title', 'Create Membership')
@section('content')
<form action="{{route('memberships.store')}}" method="POST">
  @csrf
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">Memberships</h1>
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item"><a class="link-fx" href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a class="link-fx" href="{{route('memberships.index')}}">Memberships</a></li>
            <li class="breadcrumb-item" aria-current="page">Create</li>
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
        <h3 class="block-title">Membership Details</h3>
      </div>
      <div class="block-content">
        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label">Code</label>
            <input type="number" class="form-control" name="code" value="{{old('code')}}" required min="1">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Button Text</label>
            <input type="text" class="form-control" name="btn_txt" value="{{old('btn_txt')}}" placeholder="Choose Plan">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="{{old('price', 0)}}" required min="0" step="0.01">
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Duration Value</label>
            <input type="number" class="form-control" name="duration_value" value="{{old('duration_value', 1)}}" required min="1">
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label">Duration Type</label>
            <select class="form-control" name="duration_type" required>
              <option value="day" {{old('duration_type') === 'day' ? 'selected' : ''}}>Day</option>
              <option value="month" {{old('duration_type', 'month') === 'month' ? 'selected' : ''}}>Month</option>
              <option value="year" {{old('duration_type') === 'year' ? 'selected' : ''}}>Year</option>
            </select>
          </div>
          {{-- <div class="col-md-3 mb-3">
            <label class="form-label">User Type</label>
            <select class="form-control" name="user_type" required>
              <option value="buyer" {{old('user_type') === 'buyer' ? 'selected' : ''}}>Buyer</option>
              <option value="seller" {{old('user_type', 'seller') === 'seller' ? 'selected' : ''}}>Seller</option>
            </select>
          </div> --}}
          <div class="col-md-3 mb-3 d-flex align-items-end">
            <div>
              <label class="form-label d-block">Flags</label>
              <label class="form-check form-switch me-3">
                <input class="form-check-input" type="checkbox" name="is_active" {{old('is_active', 1) ? 'checked' : ''}}>
                <span class="form-check-label">Active</span>
              </label>
              <label class="form-check form-switch me-3">
                <input class="form-check-input" type="checkbox" name="is_default" {{old('is_default') ? 'checked' : ''}}>
                <span class="form-check-label">Default</span>
              </label>
              {{-- <label class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_featured_eligible" {{old('is_featured_eligible') ? 'checked' : ''}}>
                <span class="form-check-label">Featured Eligible</span>
              </label> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
