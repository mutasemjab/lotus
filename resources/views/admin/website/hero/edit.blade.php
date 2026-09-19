@extends('admin.layouts.app')
@section('title', 'Hero Section')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">Hero Section</h1>
        <p class="page-sub">Edit the main hero banner content shown on the homepage</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.website.hero.update') }}" method="POST">
@csrf @method('PUT')

<div class="row g-4">

    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-badge-ad"></i> Kicker Line</h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">English</label>
                        <input type="text" name="kicker_en" value="{{ old('kicker_en', $hero->kicker_en) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">العربية</label>
                        <input type="text" name="kicker_ar" value="{{ old('kicker_ar', $hero->kicker_ar) }}" class="form-control" dir="rtl">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-type-h1"></i> Main Title</h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">English <small class="text-muted">(use \n for line breaks)</small></label>
                        <textarea name="title_en" rows="4" class="form-control">{{ old('title_en', $hero->title_en) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">العربية</label>
                        <textarea name="title_ar" rows="4" class="form-control" dir="rtl">{{ old('title_ar', $hero->title_ar) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-paragraph"></i> Lead Paragraph</h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">English</label>
                        <textarea name="lead_en" rows="4" class="form-control">{{ old('lead_en', $hero->lead_en) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">العربية</label>
                        <textarea name="lead_ar" rows="4" class="form-control" dir="rtl">{{ old('lead_ar', $hero->lead_ar) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-cursor"></i> Buttons</h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-12"><strong class="text-muted small">Primary Button</strong></div>
                    <div class="col-md-4">
                        <label class="form-label">Label EN</label>
                        <input type="text" name="btn1_text_en" value="{{ old('btn1_text_en', $hero->btn1_text_en) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Label AR</label>
                        <input type="text" name="btn1_text_ar" value="{{ old('btn1_text_ar', $hero->btn1_text_ar) }}" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Link (e.g. #contact)</label>
                        <input type="text" name="btn1_link" value="{{ old('btn1_link', $hero->btn1_link) }}" class="form-control">
                    </div>
                    <div class="col-12"><strong class="text-muted small">Secondary Button</strong></div>
                    <div class="col-md-4">
                        <label class="form-label">Label EN</label>
                        <input type="text" name="btn2_text_en" value="{{ old('btn2_text_en', $hero->btn2_text_en) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Label AR</label>
                        <input type="text" name="btn2_text_ar" value="{{ old('btn2_text_ar', $hero->btn2_text_ar) }}" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Link (e.g. #services)</label>
                        <input type="text" name="btn2_link" value="{{ old('btn2_link', $hero->btn2_link) }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save Changes</button>
</div>

</form>

@endsection
