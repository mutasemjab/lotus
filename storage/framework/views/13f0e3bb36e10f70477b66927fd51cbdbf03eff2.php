<?php if($shippingModes->count()): ?>
<?php
    $icons = [
        'sea'  => '<path d="M3 17c1.5 1.4 3 1.4 4.5 0s3-1.4 4.5 0 3 1.4 4.5 0 3-1.4 4.5 0"/><path d="M5 14l-1.5-5h17L19 14"/><path d="M8 9V5h5v4"/><path d="M13 7h3v2"/>',
        'air'  => '<path d="M2.5 13.5l7-1.5 5-8.5 2 .5-2.5 8 5.5-1 1.5-2 1.5.5-1 3.5 1 3.5-1.5.5-1.5-2-5.5-1 2.5 8-2 .5-5-8.5-7-1.5z"/>',
        'land' => '<path d="M2 7h11v9H2z"/><path d="M13 10h4.5l3.5 3.5V16h-8"/><circle cx="6.5" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
    ];
?>
<section class="ship" id="shipping">
  <div class="container">
    <div class="head fx-in">
      <?php if($shippingHeader->field('eyebrow')): ?>
        <p class="eyebrow" style="color:var(--gold-light);"><?php echo e($shippingHeader->field('eyebrow')); ?></p>
      <?php endif; ?>
      <?php if($shippingHeader->field('title')): ?>
        <h2><?php echo e($shippingHeader->field('title')); ?></h2>
      <?php endif; ?>
      <?php if($shippingHeader->field('subtitle')): ?>
        <p><?php echo e($shippingHeader->field('subtitle')); ?></p>
      <?php endif; ?>
    </div>

    <div class="ship-grid">
      <?php $__currentLoopData = $shippingModes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="ship-card ship-<?php echo e($mode->icon); ?>">
          <div class="ship-top">
            <div class="ship-icon">
              <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $icons[$mode->icon] ?? $icons['sea']; ?></svg>
            </div>
            <?php if($mode->field('tag')): ?>
              <span class="ship-tag"><?php echo e($mode->field('tag')); ?></span>
            <?php endif; ?>
          </div>

          <h3><?php echo e($mode->field('title')); ?></h3>

          <ul class="ship-routes">
            <?php $__currentLoopData = $mode->routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                <?php if($route->field('to')): ?>
                  <span class="r-from"><?php echo e($route->field('from')); ?></span>
                  <span class="r-arrow <?php echo e($route->is_bidirectional ? 'both' : ''); ?>" aria-hidden="true"></span>
                  <span class="r-to"><?php echo e($route->field('to')); ?></span>
                <?php else: ?>
                  <span class="r-pin" aria-hidden="true"></span>
                  <span class="r-from"><?php echo e($route->field('from')); ?></span>
                <?php endif; ?>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>

          <a class="ship-more" href="<?php echo e($mode->link ?: '#contact'); ?>"><?php echo e(__('front.discover_more')); ?> <span aria-hidden="true">→</span></a>
        </article>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lotus\resources\views/front/sections/shipping.blade.php ENDPATH**/ ?>