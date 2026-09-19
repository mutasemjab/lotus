@extends('admin.layouts.app')
@section('title', 'Add Process Step')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title">Add Process Step</h1></div>
    <a href="{{ route('admin.website.process.index') }}" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.website.process.store') }}" method="POST">
@csrf
<div class="panel-card">
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Step Number <span class="text-danger">*</span></label>
                <input type="number" name="step_number" value="{{ old('step_number', 1) }}" class="form-control" min="1" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control" min="0">
            </div>
            <div class="col-md-6"><label class="form-label">Title EN <span class="text-danger">*</span></label><input type="text" name="title_en" value="{{ old('title_en') }}" class="form-control" required></div>
            <div class="col-md-6"><label class="form-label">Title AR <span class="text-danger">*</span></label><input type="text" name="title_ar" value="{{ old('title_ar') }}" class="form-control" dir="rtl" required></div>
            <div class="col-md-6"><label class="form-label">Description EN</label><textarea name="description_en" rows="3" class="form-control">{{ old('description_en') }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Description AR</label><textarea name="description_ar" rows="3" class="form-control" dir="rtl">{{ old('description_ar') }}</textarea></div>
        </div>
    </div>
</div>
<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save</button>
    <a href="{{ route('admin.website.process.index') }}" class="btn-outline-sm">Cancel</a>
</div>
</form>

@endsection
