@extends('admin.layouts.app')
@section('title', 'About Section')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">About Section</h1>
        <p class="page-sub">Manage the about section content and statistics</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Main about content --}}
<form action="{{ route('admin.website.about.update') }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="row g-4">
    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-info-circle"></i> About Content</h2></div>
            <div class="panel-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Eyebrow EN</label>
                        <input type="text" name="eyebrow_en" value="{{ old('eyebrow_en', $about->eyebrow_en) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Eyebrow AR</label>
                        <input type="text" name="eyebrow_ar" value="{{ old('eyebrow_ar', $about->eyebrow_ar) }}" class="form-control" dir="rtl">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Title EN</label>
                        <textarea name="title_en" rows="2" class="form-control">{{ old('title_en', $about->title_en) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Title AR</label>
                        <textarea name="title_ar" rows="2" class="form-control" dir="rtl">{{ old('title_ar', $about->title_ar) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Paragraph 1 EN</label>
                        <textarea name="paragraph1_en" rows="4" class="form-control">{{ old('paragraph1_en', $about->paragraph1_en) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Paragraph 1 AR</label>
                        <textarea name="paragraph1_ar" rows="4" class="form-control" dir="rtl">{{ old('paragraph1_ar', $about->paragraph1_ar) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Paragraph 2 EN</label>
                        <textarea name="paragraph2_en" rows="4" class="form-control">{{ old('paragraph2_en', $about->paragraph2_en) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Paragraph 2 AR</label>
                        <textarea name="paragraph2_ar" rows="4" class="form-control" dir="rtl">{{ old('paragraph2_ar', $about->paragraph2_ar) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Badge Number (e.g. +15)</label>
                        <input type="text" name="badge_number" value="{{ old('badge_number', $about->badge_number) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Badge Text EN</label>
                        <input type="text" name="badge_text_en" value="{{ old('badge_text_en', $about->badge_text_en) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Badge Text AR</label>
                        <input type="text" name="badge_text_ar" value="{{ old('badge_text_ar', $about->badge_text_ar) }}" class="form-control" dir="rtl">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Section Image</label>
                        @if($about->image)
                            <div class="mb-2">
                                <img src="{{ asset('uploads/about/' . $about->image) }}" alt="" style="height:80px;object-fit:cover;border-radius:6px;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save About Content</button>
</div>
</form>

{{-- Stats --}}
<div class="panel-card mt-4">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-bar-chart"></i> Statistics</h2>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>Value</th><th>Label EN</th><th>Label AR</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($stats as $stat)
                    <tr>
                        <td><strong>{{ $stat->value }}</strong></td>
                        <td>{{ $stat->label_en }}</td>
                        <td dir="rtl">{{ $stat->label_ar }}</td>
                        <td>{{ $stat->sort_order }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn-icon-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editStat{{ $stat->id }}"><i class="bi bi-pencil"></i></button>
                                <form action="{{ route('admin.website.about.stat.destroy', $stat->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">No stats yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-card-body border-top">
        <form action="{{ route('admin.website.about.stat.store') }}" method="POST" class="row g-2 align-items-end">
        @csrf
            <div class="col-md-2">
                <label class="form-label small">Value</label>
                <input type="text" name="value" class="form-control form-control-sm" placeholder="+15" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Label EN</label>
                <input type="text" name="label_en" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Label AR</label>
                <input type="text" name="label_ar" class="form-control form-control-sm" dir="rtl" required>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Order</label>
                <input type="number" name="sort_order" value="0" class="form-control form-control-sm" min="0">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Stat Modals --}}
@foreach($stats as $stat)
<div class="modal fade" id="editStat{{ $stat->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.website.about.stat.update', $stat->id) }}" method="POST" class="modal-content">
        @csrf @method('PUT')
            <div class="modal-header"><h5 class="modal-title">Edit Stat</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-4"><label class="form-label">Value</label><input type="text" name="value" value="{{ $stat->value }}" class="form-control" required></div>
                    <div class="col-4"><label class="form-label">Label EN</label><input type="text" name="label_en" value="{{ $stat->label_en }}" class="form-control" required></div>
                    <div class="col-4"><label class="form-label">Label AR</label><input type="text" name="label_ar" value="{{ $stat->label_ar }}" class="form-control" dir="rtl" required></div>
                    <div class="col-4"><label class="form-label">Order</label><input type="number" name="sort_order" value="{{ $stat->sort_order }}" class="form-control" min="0"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn-primary-sm">Update</button></div>
        </form>
    </div>
</div>
@endforeach

@endsection
