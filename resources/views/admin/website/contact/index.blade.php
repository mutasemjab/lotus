@extends('admin.layouts.app')
@section('title', 'Contact Section')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">Contact Section</h1>
        <p class="page-sub">Manage contact phones, location and WhatsApp</p>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">

    {{-- Section Header --}}
    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-layout-text-window"></i> Section Header</h2></div>
            <div class="panel-card-body">
                <form action="{{ route('admin.website.contact.update-header') }}" method="POST">
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
    </div>

    {{-- WhatsApp --}}
    <div class="col-md-4">
        <div class="panel-card h-100">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-whatsapp"></i> WhatsApp FAB</h2></div>
            <div class="panel-card-body">
                <form action="{{ route('admin.website.contact.update-settings') }}" method="POST">
                @csrf @method('PUT')
                    <label class="form-label">WhatsApp Number <small class="text-muted">(with country code, no +)</small></label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $whatsapp) }}" class="form-control" placeholder="962785171895">
                    <button type="submit" class="btn-primary-sm mt-3"><i class="bi bi-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Location --}}
    <div class="col-md-8">
        <div class="panel-card h-100">
            <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-geo-alt"></i> Location</h2></div>
            <div class="panel-card-body">
                <form action="{{ route('admin.website.contact.update-location') }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Title EN</label><input type="text" name="title_en" value="{{ old('title_en', $location->title_en) }}" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Title AR</label><input type="text" name="title_ar" value="{{ old('title_ar', $location->title_ar) }}" class="form-control" dir="rtl"></div>
                    <div class="col-md-6"><label class="form-label">Address EN</label><textarea name="address_en" rows="3" class="form-control">{{ old('address_en', $location->address_en) }}</textarea></div>
                    <div class="col-md-6"><label class="form-label">Address AR</label><textarea name="address_ar" rows="3" class="form-control" dir="rtl">{{ old('address_ar', $location->address_ar) }}</textarea></div>
                    <div class="col-12"><label class="form-label">Google Maps Link</label><input type="url" name="maps_link" value="{{ old('maps_link', $location->maps_link) }}" class="form-control"></div>
                    <div class="col-auto"><button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save Location</button></div>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Phones --}}
    <div class="col-12">
        <div class="panel-card">
            <div class="panel-card-header d-flex align-items-center justify-content-between">
                <h2 class="panel-card-title"><i class="bi bi-telephone"></i> Contact Phones</h2>
                <span class="pill pill-info">{{ $phones->count() }}</span>
            </div>
            <div class="panel-card-body p-0">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr><th>#</th><th>Label EN</th><th>Label AR</th><th>Phone</th><th>Order</th><th>Status</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            @forelse($phones as $phone)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $phone->label_en }}</td>
                                <td dir="rtl">{{ $phone->label_ar }}</td>
                                <td><a href="tel:{{ $phone->phone }}">{{ $phone->phone }}</a></td>
                                <td>{{ $phone->sort_order }}</td>
                                <td>@if($phone->is_active)<span class="pill pill-success">Active</span>@else<span class="pill pill-neutral">Inactive</span>@endif</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn-icon-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editPhone{{ $phone->id }}"><i class="bi bi-pencil"></i></button>
                                        <form action="{{ route('admin.website.contact.phone.destroy', $phone->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-3">No phones yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-card-body border-top">
                <form action="{{ route('admin.website.contact.phone.store') }}" method="POST" class="row g-2 align-items-end">
                @csrf
                    <div class="col-md-3"><label class="form-label small">Label EN</label><input type="text" name="label_en" class="form-control form-control-sm"></div>
                    <div class="col-md-3"><label class="form-label small">Label AR</label><input type="text" name="label_ar" class="form-control form-control-sm" dir="rtl"></div>
                    <div class="col-md-2"><label class="form-label small">Phone <span class="text-danger">*</span></label><input type="text" name="phone" class="form-control form-control-sm" required></div>
                    <div class="col-md-2"><label class="form-label small">Order</label><input type="number" name="sort_order" value="0" class="form-control form-control-sm" min="0"></div>
                    <div class="col-auto"><button type="submit" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add</button></div>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- Edit Phone Modals --}}
@foreach($phones as $phone)
<div class="modal fade" id="editPhone{{ $phone->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.website.contact.phone.update', $phone->id) }}" method="POST" class="modal-content">
        @csrf @method('PUT')
            <div class="modal-header"><h5 class="modal-title">Edit Phone</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12"><label class="form-label">Label EN</label><input type="text" name="label_en" value="{{ $phone->label_en }}" class="form-control"></div>
                    <div class="col-12"><label class="form-label">Label AR</label><input type="text" name="label_ar" value="{{ $phone->label_ar }}" class="form-control" dir="rtl"></div>
                    <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" value="{{ $phone->phone }}" class="form-control" required></div>
                    <div class="col-md-3"><label class="form-label">Order</label><input type="number" name="sort_order" value="{{ $phone->sort_order }}" class="form-control" min="0"></div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $phone->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn-primary-sm">Update</button></div>
        </form>
    </div>
</div>
@endforeach

@endsection
