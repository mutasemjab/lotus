<?php $__env->startSection('title', 'Shipping Solutions'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title">Shipping Solutions</h1>
        <p class="page-sub">Sea / air / land cards and their routes</p>
    </div>
    <a href="<?php echo e(route('admin.website.shipping.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add Shipping Type</a>
</div>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show mb-3">
    <?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>


<div class="panel-card mb-4">
    <div class="panel-card-header"><h2 class="panel-card-title"><i class="bi bi-layout-text-window"></i> Section Header</h2></div>
    <div class="panel-card-body">
        <form action="<?php echo e(route('admin.website.shipping.update-header')); ?>" method="POST">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Eyebrow EN</label><input type="text" name="eyebrow_en" value="<?php echo e(old('eyebrow_en', $header->eyebrow_en)); ?>" class="form-control"></div>
            <div class="col-md-6"><label class="form-label">Eyebrow AR</label><input type="text" name="eyebrow_ar" value="<?php echo e(old('eyebrow_ar', $header->eyebrow_ar)); ?>" class="form-control" dir="rtl"></div>
            <div class="col-md-6"><label class="form-label">Title EN</label><textarea name="title_en" rows="2" class="form-control"><?php echo e(old('title_en', $header->title_en)); ?></textarea></div>
            <div class="col-md-6"><label class="form-label">Title AR</label><textarea name="title_ar" rows="2" class="form-control" dir="rtl"><?php echo e(old('title_ar', $header->title_ar)); ?></textarea></div>
            <div class="col-md-6"><label class="form-label">Subtitle EN</label><textarea name="subtitle_en" rows="2" class="form-control"><?php echo e(old('subtitle_en', $header->subtitle_en)); ?></textarea></div>
            <div class="col-md-6"><label class="form-label">Subtitle AR</label><textarea name="subtitle_ar" rows="2" class="form-control" dir="rtl"><?php echo e(old('subtitle_ar', $header->subtitle_ar)); ?></textarea></div>
            <div class="col-auto"><button type="submit" class="btn-primary-sm"><i class="bi bi-save"></i> Save Header</button></div>
        </div>
        </form>
    </div>
</div>


<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-truck"></i> Shipping Types</h2>
        <span class="pill pill-info"><?php echo e($modes->count()); ?></span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>#</th><th>Icon</th><th>Title EN</th><th>Title AR</th><th>Routes</th><th>Order</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $modes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><span class="pill pill-info"><?php echo e(ucfirst($mode->icon)); ?></span></td>
                        <td><?php echo e($mode->title_en); ?></td>
                        <td dir="rtl"><?php echo e($mode->title_ar); ?></td>
                        <td><?php echo e($mode->routes_count); ?></td>
                        <td><?php echo e($mode->sort_order); ?></td>
                        <td>
                            <?php if($mode->is_active): ?><span class="pill pill-success">Active</span><?php else: ?><span class="pill pill-neutral">Inactive</span><?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('admin.website.shipping.edit', $mode->id)); ?>" class="btn-icon-sm btn-edit" title="Edit & manage routes"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('admin.website.shipping.destroy', $mode->id)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this shipping type and all its routes?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-2"></i> No shipping types yet — the section is hidden on the website until you add one</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lotus\resources\views/admin/website/shipping/index.blade.php ENDPATH**/ ?>