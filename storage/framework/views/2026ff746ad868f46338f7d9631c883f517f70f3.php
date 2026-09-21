<?php $__env->startSection('title', 'Statistics Band'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <h1 class="page-title">Statistics Band</h1>
    <p class="page-sub">The row of animated numbers shown under the hero strip on the website</p>
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

<div class="panel-card">
    <div class="panel-card-header d-flex align-items-center justify-content-between">
        <h2 class="panel-card-title"><i class="bi bi-bar-chart-line"></i> Statistics</h2>
        <span class="pill pill-info"><?php echo e($stats->count()); ?></span>
    </div>
    <div class="panel-card-body p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr><th>#</th><th>Value</th><th>Label EN</th><th>Label AR</th><th>Order</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><strong><?php echo e(number_format($stat->value)); ?><?php echo e($stat->suffix); ?></strong></td>
                        <td><?php echo e($stat->label_en); ?></td>
                        <td dir="rtl"><?php echo e($stat->label_ar); ?></td>
                        <td><?php echo e($stat->sort_order); ?></td>
                        <td>
                            <?php if($stat->is_active): ?><span class="pill pill-success">Active</span><?php else: ?><span class="pill pill-neutral">Inactive</span><?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn-icon-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editStat<?php echo e($stat->id); ?>"><i class="bi bi-pencil"></i></button>
                                <form action="<?php echo e(route('admin.website.stats.destroy', $stat->id)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this statistic?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-icon-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted py-4"><i class="bi bi-inbox fs-4 d-block mb-2"></i> No statistics yet — the band is hidden on the website until you add one</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-card-body border-top">
        <form action="<?php echo e(route('admin.website.stats.store')); ?>" method="POST" class="row g-2 align-items-end">
        <?php echo csrf_field(); ?>
            <div class="col-md-2">
                <label class="form-label small">Number</label>
                <input type="number" name="value" class="form-control form-control-sm" min="0" placeholder="12000" required>
            </div>
            <div class="col-md-1">
                <label class="form-label small">Suffix</label>
                <input type="text" name="suffix" class="form-control form-control-sm" maxlength="10" placeholder="+">
            </div>
            <div class="col-md-3">
                <label class="form-label small">Label EN</label>
                <input type="text" name="label_en" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Label AR</label>
                <input type="text" name="label_ar" class="form-control form-control-sm" dir="rtl" required>
            </div>
            <div class="col-md-1">
                <label class="form-label small">Order</label>
                <input type="number" name="sort_order" value="0" class="form-control form-control-sm" min="0">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn-primary-sm"><i class="bi bi-plus-lg"></i> Add</button>
            </div>
        </form>
    </div>
</div>


<?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editStat<?php echo e($stat->id); ?>" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?php echo e(route('admin.website.stats.update', $stat->id)); ?>" method="POST" class="modal-content">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <div class="modal-header"><h5 class="modal-title">Edit Statistic</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6"><label class="form-label">Number</label><input type="number" name="value" value="<?php echo e($stat->value); ?>" class="form-control" min="0" required></div>
                    <div class="col-6"><label class="form-label">Suffix</label><input type="text" name="suffix" value="<?php echo e($stat->suffix); ?>" class="form-control" maxlength="10"></div>
                    <div class="col-6"><label class="form-label">Label EN</label><input type="text" name="label_en" value="<?php echo e($stat->label_en); ?>" class="form-control" required></div>
                    <div class="col-6"><label class="form-label">Label AR</label><input type="text" name="label_ar" value="<?php echo e($stat->label_ar); ?>" class="form-control" dir="rtl" required></div>
                    <div class="col-6"><label class="form-label">Order</label><input type="number" name="sort_order" value="<?php echo e($stat->sort_order); ?>" class="form-control" min="0"></div>
                    <div class="col-6 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="statActive<?php echo e($stat->id); ?>" value="1" <?php if($stat->is_active): echo 'checked'; endif; ?>>
                            <label class="form-check-label" for="statActive<?php echo e($stat->id); ?>">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn-primary-sm">Update</button></div>
        </form>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lotus\resources\views/admin/website/stats/index.blade.php ENDPATH**/ ?>