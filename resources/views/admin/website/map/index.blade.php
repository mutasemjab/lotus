@extends('admin.layouts.app')
@section('title', 'World Map')

@section('content')

<div class="page-header">
    <h1 class="page-title">World Map</h1>
    <p class="page-sub">Countries shown with their flags on the map. Hub countries get a highlighted pin, and animated routes are drawn from the first hub to every other country.</p>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Section Header --}}
<div class="panel-card mb-4">
    <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-layout-text-window"></i> Section Header</h2></div>
    <div class="panel-card-body">
        <form action="{{ route('admin.website.map.update-header') }}" method="POST">
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

{{-- Countries --}}
<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-globe-europe-africa"></i> Countries</h2>
        <span class="pill pill-info">{{ $countries->count() }}</span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>Flag</th><th>Name EN</th><th>Name AR</th><th>Lat / Lon</th><th>Hub</th><th>Order</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                    <tr>
                        <td><img src="{{ $country->flagUrl() }}" alt="{{ $country->code }}" width="30" height="22" style="object-fit:cover;border-radius:3px;border:1px solid #e2e8f0"></td>
                        <td>{{ $country->name_en }} <small class="text-muted text-uppercase">{{ $country->code }}</small></td>
                        <td dir="rtl">{{ $country->name_ar }}</td>
                        <td><small>{{ $country->latitude }}, {{ $country->longitude }}</small></td>
                        <td>@if($country->is_hub)<span class="pill pill-info">Hub</span>@endif</td>
                        <td>{{ $country->sort_order }}</td>
                        <td>
                            @if($country->is_active)<span class="pill pill-success">Active</span>@else<span class="pill pill-neutral">Inactive</span>@endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn-icon-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editCountry{{ $country->id }}"><i class="bi bi-pencil"></i></button>
                                <form action="{{ route('admin.website.map.destroy', $country->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Remove this country from the map?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-2"></i> No countries yet — the map is hidden on the website until you add one</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add country --}}
    <div class="panel-card-body border-top">
        <form action="{{ route('admin.website.map.store') }}" method="POST" class="row g-2 align-items-end" id="addCountryForm">
        @csrf
            <div class="col-12">
                <label class="form-label small">Pick a country to auto-fill (or type the values by hand)</label>
                <select class="form-select form-select-sm no-select2" id="countryPreset">
                    <option value="">— Choose —</option>
                    @foreach($presets as $code => [$en, $ar, $lat, $lon])
                        <option value="{{ $code }}" data-en="{{ $en }}" data-ar="{{ $ar }}" data-lat="{{ $lat }}" data-lon="{{ $lon }}">{{ $en }} — {{ $ar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1"><label class="form-label small">Code</label><input type="text" name="code" id="cCode" class="form-control form-control-sm" maxlength="2" placeholder="jo" required></div>
            <div class="col-md-3"><label class="form-label small">Name EN</label><input type="text" name="name_en" id="cEn" class="form-control form-control-sm" required></div>
            <div class="col-md-3"><label class="form-label small">Name AR</label><input type="text" name="name_ar" id="cAr" class="form-control form-control-sm" dir="rtl" required></div>
            <div class="col-md-1"><label class="form-label small">Lat</label><input type="number" step="0.0001" name="latitude" id="cLat" class="form-control form-control-sm" required></div>
            <div class="col-md-1"><label class="form-label small">Lon</label><input type="number" step="0.0001" name="longitude" id="cLon" class="form-control form-control-sm" required></div>
            <div class="col-md-1"><label class="form-label small">Order</label><input type="number" name="sort_order" value="0" class="form-control form-control-sm" min="0"></div>
            <div class="col-auto">
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="is_hub" id="cHub" value="1">
                    <label class="form-check-label small" for="cHub">Hub</label>
                </div>
            </div>
            <div class="col-auto"><button type="submit" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add</button></div>
            <div class="col-12"><small class="text-muted">Map covers longitude {{ $bounds['lon_min'] }}° to {{ $bounds['lon_max'] }}° and latitude {{ $bounds['lat_min'] }}° to {{ $bounds['lat_max'] }}° (Europe, Africa, Middle East and Asia). Flags load from the 2-letter ISO code.</small></div>
        </form>
    </div>
</div>

{{-- Edit modals --}}
@foreach($countries as $country)
<div class="modal fade" id="editCountry{{ $country->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.website.map.update', $country->id) }}" method="POST" class="modal-content">
        @csrf @method('PUT')
            <div class="modal-header"><h5 class="modal-title">Edit Country</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-2"><label class="form-label">Code</label><input type="text" name="code" value="{{ $country->code }}" class="form-control" maxlength="2" required></div>
                    <div class="col-md-5"><label class="form-label">Name EN</label><input type="text" name="name_en" value="{{ $country->name_en }}" class="form-control" required></div>
                    <div class="col-md-5"><label class="form-label">Name AR</label><input type="text" name="name_ar" value="{{ $country->name_ar }}" class="form-control" dir="rtl" required></div>
                    <div class="col-md-3"><label class="form-label">Latitude</label><input type="number" step="0.0001" name="latitude" value="{{ $country->latitude }}" class="form-control" required></div>
                    <div class="col-md-3"><label class="form-label">Longitude</label><input type="number" step="0.0001" name="longitude" value="{{ $country->longitude }}" class="form-control" required></div>
                    <div class="col-md-2"><label class="form-label">Order</label><input type="number" name="sort_order" value="{{ $country->sort_order }}" class="form-control" min="0"></div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_hub" id="hub{{ $country->id }}" value="1" @checked($country->is_hub)>
                            <label class="form-check-label" for="hub{{ $country->id }}">Hub</label>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="act{{ $country->id }}" value="1" @checked($country->is_active)>
                            <label class="form-check-label" for="act{{ $country->id }}">Active</label>
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

@push('scripts')
<script>
    document.getElementById('countryPreset').addEventListener('change', function () {
        var o = this.options[this.selectedIndex];
        if (!o.value) return;
        document.getElementById('cCode').value = o.value;
        document.getElementById('cEn').value   = o.dataset.en;
        document.getElementById('cAr').value   = o.dataset.ar;
        document.getElementById('cLat').value  = o.dataset.lat;
        document.getElementById('cLon').value  = o.dataset.lon;
    });
</script>
@endpush
