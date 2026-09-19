@extends('admin.layouts.app')
@section('title', 'Edit Service')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title">Edit Service</h1></div>
    <a href="{{ route('admin.website.services.index') }}" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.website.services.update', $service->id) }}" method="POST">
@csrf @method('PUT')
<div class="panel-card">
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-2">
                <label class="form-label">Number</label>
                <input type="text" name="number" value="{{ old('number', $service->number) }}" class="form-control" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Letter</label>
                <input type="text" name="letter" value="{{ old('letter', $service->letter) }}" class="form-control" maxlength="5">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="form-control" min="0">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Title EN</label>
                <input type="text" name="title_en" value="{{ old('title_en', $service->title_en) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Title AR</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $service->title_ar) }}" class="form-control" dir="rtl" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Description EN</label>
                <textarea name="description_en" rows="4" class="form-control">{{ old('description_en', $service->description_en) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Description AR</label>
                <textarea name="description_ar" rows="4" class="form-control" dir="rtl">{{ old('description_ar', $service->description_ar) }}</textarea>
            </div>
        </div>
    </div>
</div>
<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Update</button>
    <a href="{{ route('admin.website.services.index') }}" class="btn-outline-sm">Cancel</a>
</div>
</form>

@endsection
