<?php if($mapCountries->count()): ?>
<?php
    // Map bounds — must match the generated assets_front/img/world-dots.svg (see config/map_countries.php)
    $b      = config('map_countries.bounds');
    $lon0   = $b['lon_min'];
    $latTop = $b['lat_max'];
    $mapW   = $b['lon_max'] - $b['lon_min'];
    $mapH   = $b['lat_max'] - $b['lat_min'];

    // Routes are drawn from the first hub (or the first country) to every other country.
    $origin = $mapCountries->firstWhere('is_hub', true) ?? $mapCountries->first();
    $hx = $origin->longitude - $lon0;
    $hy = $latTop - $origin->latitude;

    $arcs = [];
    foreach ($mapCountries as $c) {
        if ($c->id === $origin->id) continue;
        $x    = $c->longitude - $lon0;
        $y    = $latTop - $c->latitude;
        $dist = hypot($x - $hx, $y - $hy);
        $arcs[] = sprintf('M%.2f %.2f Q%.2f %.2f %.2f %.2f', $hx, $hy, ($hx + $x) / 2, min($hy, $y) - $dist * 0.32, $x, $y);
    }
?>
<section class="reach" id="reach">
  <div class="container">
    <div class="head fx-in">
      <?php if($mapHeader->field('eyebrow')): ?>
        <p class="eyebrow"><?php echo e($mapHeader->field('eyebrow')); ?></p>
      <?php endif; ?>
      <?php if($mapHeader->field('title')): ?>
        <h2><?php echo e($mapHeader->field('title')); ?></h2>
      <?php endif; ?>
      <?php if($mapHeader->field('subtitle')): ?>
        <p><?php echo e($mapHeader->field('subtitle')); ?></p>
      <?php endif; ?>
    </div>

    <div class="reach-map" role="img" aria-label="<?php echo e($mapHeader->field('title')); ?>">
      <img class="reach-dots" src="<?php echo e(asset('assets_front/img/world-dots.svg')); ?>" alt="" loading="lazy">

      <svg class="reach-arcs" viewBox="0 0 <?php echo e($mapW); ?> <?php echo e($mapH); ?>" preserveAspectRatio="none" aria-hidden="true">
        <?php $__currentLoopData = $arcs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <path d="<?php echo e($d); ?>" style="animation-delay: <?php echo e($i * 0.18); ?>s"/>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </svg>

      <?php $__currentLoopData = $mapCountries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="pin <?php echo e($c->is_hub ? 'hub' : ''); ?>"
             style="left: <?php echo e(round(($c->longitude - $lon0) / $mapW * 100, 3)); ?>%; top: <?php echo e(round(($latTop - $c->latitude) / $mapH * 100, 3)); ?>%;">
          <span class="pin-flag"><img src="<?php echo e($c->flagUrl()); ?>" alt="" loading="lazy"></span>
          <span class="pin-name"><?php echo e($c->name()); ?></span>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <ul class="reach-legend">
      <?php $__currentLoopData = $mapCountries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><img src="<?php echo e($c->flagUrl()); ?>" alt="" loading="lazy"> <?php echo e($c->name()); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lotus\resources\views/front/sections/world-map.blade.php ENDPATH**/ ?>