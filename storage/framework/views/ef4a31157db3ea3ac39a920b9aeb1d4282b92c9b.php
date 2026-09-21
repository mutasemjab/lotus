<?php if($siteStats->count()): ?>
<section class="stats-band" aria-label="<?php echo e(__('front.stats_label')); ?>">
  <div class="container">
    <div class="stats-grid" style="--cols: <?php echo e(min($siteStats->count(), 4)); ?>">
      <?php $__currentLoopData = $siteStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="stat-cell">
          <div class="stat-num">
            <span class="js-count" data-count="<?php echo e($stat->value); ?>"><?php echo e(number_format($stat->value)); ?></span><?php if($stat->suffix): ?><em><?php echo e($stat->suffix); ?></em><?php endif; ?>
          </div>
          <div class="stat-label"><?php echo e($stat->label()); ?></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lotus\resources\views/front/sections/stats.blade.php ENDPATH**/ ?>