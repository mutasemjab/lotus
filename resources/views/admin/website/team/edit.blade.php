@extends('admin.layouts.app')
@section('title', 'Edit Team Member')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title">Edit Team Member</h1></div>
    <a href="{{ route('admin.website.team.index') }}" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.website.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="panel-card">
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name EN</label><input type="text" name="name_en" value="{{ old('name_en', $member->name_en) }}" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Name AR</label><input type="text" name="name_ar" value="{{ old('name_ar', $member->name_ar) }}" class="form-control" dir="rtl" required></div>
            <div class="col-md-6"><label class="form-label">Role EN</label><input type="text" name="role_en" value="{{ old('role_en', $member->role_en) }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Role AR</label><input type="text" name="role_ar" value="{{ old('role_ar', $member->role_ar) }}" class="form-control" dir="rtl"></div>
            <div class="col-md-6"><label class="form-label">Description EN</label><textarea name="description_en" rows="3" class="form-control">{{ old('description_en', $member->description_en) }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Description AR</label><textarea name="description_ar" rows="3" class="form-control" dir="rtl">{{ old('description_ar', $member->description_ar) }}</textarea></div>
            <div class="col-md-4"><label class="form-label">Phone</label><input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="form-control"></div>
            <div class="col-md-4"><label class="form-label">Initials</label><input type="text" name="initials" value="{{ old('initials', $member->initials) }}" class="form-control" maxlength="10"></div>
            <div class="col-md-4">
                <label class="form-label">Photo</label>
                @if($member->image)
                    <div class="mb-1"><img src="{{ asset('uploads/team/' . $member->image) }}" style="height:50px;border-radius:50%;object-fit:cover;"></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order) }}" class="form-control" min="0"></div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Update</button>
    <a href="{{ route('admin.website.team.index') }}" class="btn-outline-sm">Cancel</a>
</div>
</form>

@endsection
