<?php $isNew = ! $mode->exists; ?>
<?php $__env->startSection('title', $isNew ? 'Add Shipping Type' : 'Edit Shipping Type'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div><h1 class="page-title"><?php echo e($isNew ? 'Add Shipping Type' : 'Edit: ' . $mode->title_en); ?></h1></div>
    <a href="<?php echo e(route('admin.website.shipping.index')); ?>" class="btn-outline-sm"><i class="bi bi-arrow-left"></i> Back</a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show mb-3">
    <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show mb-3">
    <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<form action="<?php echo e($isNew ? route('admin.website.shipping.store') : route('admin.website.shipping.update', $mode->id)); ?>" method="POST">
<?php echo csrf_field(); ?>
<?php if (! ($isNew)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
<div class="panel-card">
    <div class="panel-card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Icon <span class="text-danger">*</span></label>
                <select name="icon" class="form-select no-select2" required>
                    <?php $__currentLoopData = \App\Models\ShippingMode::ICONS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($icon); ?>" <?php if(old('icon', $mode->icon) === $icon): echo 'selected'; endif; ?>><?php echo e(ucfirst($icon)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $mode->sort_order ?? 0)); ?>" class="form-control" min="0">
            </div>
            <div class="col-md-3">
                <label class="form-label">"Discover more" link</label>
                <input type="text" name="link" value="<?php echo e(old('link', $mode->link)); ?>" class="form-control" placeholder="#contact">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" <?php if(old('is_active', $mode->is_active ?? true)): echo 'checked'; endif; ?>>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Title EN <span class="text-danger">*</span></label>
                <input type="text" name="title_en" value="<?php echo e(old('title_en', $mode->title_en)); ?>" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Title AR <span class="text-danger">*</span></label>
                <input type="text" name="title_ar" value="<?php echo e(old('title_ar', $mode->title_ar)); ?>" class="form-control" dir="rtl" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Caption EN <small class="text-muted">(small text next to the icon)</small></label>
                <input type="text" name="tag_en" value="<?php echo e(old('tag_en', $mode->tag_en)); ?>" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Caption AR</label>
                <input type="text" name="tag_ar" value="<?php echo e(old('tag_ar', $mode->tag_ar)); ?>" class="form-control" dir="rtl">
            </div>
        </div>
    </div>
</div>
<div class="d-flex gap-2 mt-4 pb-4">
    <button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> <?php echo e($isNew ? 'Save & add routes' : 'Save'); ?></button>
    <a href="<?php echo e(route('admin.website.shipping.index')); ?>" class="btn-outline-sm">Cancel</a>
</div>
</form>

<?php if (! ($isNew)): ?>

<div class="panel-card mb-4">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-signpost-split"></i> Routes</h2>
        <span class="pill pill-info"><?php echo e($mode->routes->count()); ?></span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>From EN</th><th>To EN</th><th>From AR</th><th>To AR</th><th>Both ways</th><th>Order</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $mode->routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($r->from_en); ?></td>
                        <td><?php echo e($r->to_en ?: '—'); ?></td>
                        <td dir="rtl"><?php echo e($r->from_ar); ?></td>
                        <td dir="rtl"><?php echo e($r->to_ar ?: '—'); ?></td>
                        <td><?php if($r->is_bidirectional): ?><span class="pill pill-info">↔</span><?php endif; ?></td>
                        <td><?php echo e($r->sort_order); ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn-icon-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editRoute<?php echo e($r->id); ?>"><i class="bi bi-pencil"></i></button>
                                <form action="<?php echo e(route('admin.website.shipping.route.destroy', [$mode->id, $r->id])); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this route?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4">No routes yet</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-card-body border-top">
        <form action="<?php echo e(route('admin.website.shipping.route.store', $mode->id)); ?>" method="POST" class="row g-2 align-items-end">
        <?php echo csrf_field(); ?>
            <div class="col-md-3"><label class="form-label small">From EN</label><input type="text" name="from_en" class="form-control form-control-sm" required></div>
            <div class="col-md-3"><label class="form-label small">From AR</label><input type="text" name="from_ar" class="form-control form-control-sm" dir="rtl" required></div>
            <div class="col-md-3"><label class="form-label small">To EN <small class="text-muted">(optional)</small></label><input type="text" name="to_en" class="form-control form-control-sm"></div>
            <div class="col-md-3"><label class="form-label small">To AR <small class="text-muted">(optional)</small></label><input type="text" name="to_ar" class="form-control form-control-sm" dir="rtl"></div>
            <div class="col-md-2"><label class="form-label small">Order</label><input type="number" name="sort_order" value="<?php echo e(($mode->routes->max('sort_order') ?? -1) + 1); ?>" class="form-control form-control-sm" min="0"></div>
            <div class="col-auto">
                <div class="form-check form-switch mb-1">
                    <input class="form-check-input" type="checkbox" name="is_bidirectional" id="newBoth" value="1">
                    <label class="form-check-label small" for="newBoth">Both ways (↔)</label>
                </div>
            </div>
            <div class="col-auto"><button type="submit" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add Route</button></div>
            <div class="col-12"><small class="text-muted">Leave "To" empty for a single place (e.g. an airport or border crossing).</small></div>
        </form>
    </div>
</div>

<?php $__currentLoopData = $mode->routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editRoute<?php echo e($r->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(route('admin.website.shipping.route.update', [$mode->id, $r->id])); ?>" method="POST" class="modal-content">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div class="modal-header"><h5 class="modal-title">Edit Route</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">From EN</label><input type="text" name="from_en" value="<?php echo e($r->from_en); ?>" class="form-control" required></div>
                    <div class="col-md-6"><label class="form-label">From AR</label><input type="text" name="from_ar" value="<?php echo e($r->from_ar); ?>" class="form-control" dir="rtl" required></div>
                    <div class="col-md-6"><label class="form-label">To EN</label><input type="text" name="to_en" value="<?php echo e($r->to_en); ?>" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">To AR</label><input type="text" name="to_ar" value="<?php echo e($r->to_ar); ?>" class="form-control" dir="rtl"></div>
                    <div class="col-md-4"><label class="form-label">Order</label><input type="number" name="sort_order" value="<?php echo e($r->sort_order); ?>" class="form-control" min="0"></div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_bidirectional" id="both<?php echo e($r->id); ?>" value="1" <?php if($r->is_bidirectional): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="both<?php echo e($r->id); ?>">Both ways (↔)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn-primary-sm">Update</button></div>
        </form>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lotus\resources\views/admin/website/shipping/form.blade.php ENDPATH**/ ?>