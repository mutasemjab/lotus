@extends('admin.layouts.app')
@section('title', 'Marquee Strip')

@section('content')

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">Marquee Strip</h1>
        <p class="page-sub">Scrolling text items shown below the hero section</p>
    </div>
    <a href="{{ route('admin.website.marquee.create') }}" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add Item</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-arrow-repeat"></i> Items</h2>
        <span class="pill pill-info">{{ $items->count() }}</span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>#</th><th>English</th><th>Arabic</th><th>Order</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->text_en }}</td>
                        <td dir="rtl">{{ $item->text_ar }}</td>
                        <td>{{ $item->sort_order }}</td>
                        <td>
                            @if($item->is_active)
                                <span class="pill pill-success">Active</span>
                            @else
                                <span class="pill pill-neutral">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.website.marquee.edit', $item->id) }}" class="btn-icon-sm btn-edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.website.marquee.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this item?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-2"></i> No items yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
