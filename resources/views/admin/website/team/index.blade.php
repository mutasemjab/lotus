@extends('admin.layouts.app')
@section('title', 'Team Members')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">Team Section</h1>
        <p class="page-sub">Manage team members and section header</p>
    </div>
    <a href="{{ route('admin.website.team.create') }}" class="btn-primary-sm"><i class="bi bi-person-plus"></i> Add Member</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Section Header --}}
<div class="panel-card mb-4">
    <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-layout-text-window"></i> Section Header</h2></div>
    <div class="panel-card-body">
        <form action="{{ route('admin.website.team.update-header') }}" method="POST">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Eyebrow EN</label><input type="text" name="eyebrow_en" value="{{ old('eyebrow_en', $header->eyebrow_en) }}" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Eyebrow AR</label><input type="text" name="eyebrow_ar" value="{{ old('eyebrow_ar', $header->eyebrow_ar) }}" class="form-control" dir="rtl"></div>
            <div class="col-md-6"><label class="form-label">Title EN</label><textarea name="title_en" rows="2" class="form-control">{{ old('title_en', $header->title_en) }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Title AR</label><textarea name="title_ar" rows="2" class="form-control" dir="rtl">{{ old('title_ar', $header->title_ar) }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Subtitle EN</label><textarea name="subtitle_en" rows="2" class="form-control">{{ old('subtitle_en', $header->subtitle_en) }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Subtitle AR</label><textarea name="subtitle_ar" rows="2" class="form-control" dir="rtl">{{ old('subtitle_ar', $header->subtitle_ar) }}</textarea></div>
            <div class="col-auto"><button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save Header</button></div>
        </div>
        </form>
    </div>
</div>

{{-- Members --}}
<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-people"></i> Members</h2>
        <span class="pill pill-info">{{ $members->count() }}</span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>#</th><th>Initials</th><th>Name EN</th><th>Name AR</th><th>Role EN</th><th>Phone</th><th>Order</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($member->image)
                                <img src="{{ asset('uploads/team/' . $member->image) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                            @else
                                <span class="pill pill-info">{{ $member->initials }}</span>
                            @endif
                        </td>
                        <td><span class="fw-semibold">{{ $member->name_en }}</span></td>
                        <td dir="rtl">{{ $member->name_ar }}</td>
                        <td class="text-muted small">{{ $member->role_en }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->sort_order }}</td>
                        <td>@if($member->is_active)<span class="pill pill-success">Active</span>@else<span class="pill pill-neutral">Inactive</span>@endif</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.website.team.edit', $member->id) }}" class="btn-icon-sm btn-edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.website.team.destroy', $member->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this member?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-2"></i> No members yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
