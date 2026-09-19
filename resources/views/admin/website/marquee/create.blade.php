@extends('admin.layouts.app')
@section('title', 'Add Marquee Item')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title">Add Marquee Item</h1></div>
    <a href="{{ route('admin.website.marquee.index') }}" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.website.marquee.store') }}" method="POST">
@csrf
<div class="panel-card">
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Text (English) <span class="text-danger">*</span></label>
                <input type="text" name="text_en" value="{{ old('text_en') }}" class="form-control @error('text_en') is-invalid @enderror" required>
                @error('text_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">النص (العربية) <span class="text-danger">*</span></label>
                <input type="text" name="text_ar" value="{{ old('text_ar') }}" class="form-control @error('text_ar') is-invalid @enderror" dir="rtl" required>
                @error('text_ar')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control" min="0">
            </div>
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
    <a href="{{ route('admin.website.marquee.index') }}" class="btn-outline-sm">Cancel</a>
</div>
</form>

@endsection
