@extends('admin.layouts.app')
@section('title', 'Add Team Member')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title">Add Team Member</h1></div>
    <a href="{{ route('admin.website.team.index') }}" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.website.team.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="panel-card">
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name EN <span class="text-danger">*</span></label><input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Name AR <span class="text-danger">*</span></label><input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control" dir="rtl" required></div>
            <div class="col-md-6"><label class="form-label">Role EN</label><input type="text" name="role_en" value="{{ old('role_en') }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Role AR</label><input type="text" name="role_ar" value="{{ old('role_ar') }}" class="form-control" dir="rtl"></div>
            <div class="col-md-6"><label class="form-label">Description EN</label><textarea name="description_en" rows="3" class="form-control">{{ old('description_en') }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Description AR</label><textarea name="description_ar" rows="3" class="form-control" dir="rtl">{{ old('description_ar') }}</textarea></div>
            <div class="col-md-4"><label class="form-label">Phone</label><input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+962..."></div>
            <div class="col-md-4"><label class="form-label">Initials (used if no image)</label><input type="text" name="initials" value="{{ old('initials') }}" class="form-control" maxlength="10" placeholder="MA"></div>
            <div class="col-md-4"><label class="form-label">Photo</label><input type="file" name="image" class="form-control" accept="image/*"></div>
            <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control" min="0"></div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save</button>
    <a href="{{ route('admin.website.team.index') }}" class="btn-outline-sm">Cancel</a>
</div>
</form>

@endsection
