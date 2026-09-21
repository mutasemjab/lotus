<?php $__env->startSection('title', __('front.page_title')); ?>

<?php $__env->startSection('content'); ?>
<main id="top">

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="container hero-content">
      <div class="hero-grid">
        <div>
          <p class="hero-kicker"><?php echo e($hero->field('kicker')); ?></p>
          <h1>
            <?php $__currentLoopData = explode("\n", $hero->field('title') ?? ''); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <span class="line"><span><?php echo e(trim($line)); ?></span></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </h1>
          <p class="lead"><?php echo e($hero->field('lead')); ?></p>
          <div class="hero-actions">
            <a href="<?php echo e($hero->btn1_link ?? '#contact'); ?>" class="btn btn-gold"><?php echo e($hero->field('btn1_text')); ?></a>
            <a href="<?php echo e($hero->btn2_link ?? '#services'); ?>" class="btn btn-outline"><?php echo e($hero->field('btn2_text')); ?></a>
          </div>
        </div>
        <div class="seal">
          <div class="seal-inner">
            <strong>AL-LOTUS</strong>
            <span>CLEARANCE · JORDAN</span>
          </div>
        </div>
      </div>
    </div>
    <div class="hero-scroll"><?php echo e(__('front.scroll')); ?> <span class="bar"></span></div>
  </section>

  <!-- MARQUEE -->
  <div class="strip">
    <div class="strip-track" id="marqueeTrack">
      <?php $__currentLoopData = $marqueeItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span><?php echo e($item->text()); ?></span>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $marqueeItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <span><?php echo e($item->text()); ?></span>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  <!-- STATS -->
  <?php echo $__env->make('front.sections.stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- ABOUT -->
  <section class="about" id="about">
    <div class="container">
      <div class="about-media">
        <?php if($about->image): ?>
          <img src="<?php echo e(asset('uploads/about/' . $about->image)); ?>" alt="<?php echo e($about->field('title')); ?>">
        <?php else: ?>
          <img src="https://images.unsplash.com/photo-1740914994657-f1cdffdc418e?fm=jpg&q=80&w=1400&auto=format&fit=crop" alt="Warehouse operations">
        <?php endif; ?>
        <?php if($about->badge_number): ?>
        <div class="about-badge">
          <strong><?php echo e($about->badge_number); ?></strong>
          <span><?php echo e($about->field('badge_text')); ?></span>
        </div>
        <?php endif; ?>
      </div>
      <div>
        <?php if($about->field('eyebrow')): ?>
          <p class="eyebrow"><?php echo e($about->field('eyebrow')); ?></p>
        <?php endif; ?>
        <h2><?php echo e($about->field('title')); ?></h2>
        <?php if($about->field('paragraph1')): ?>
          <p><?php echo e($about->field('paragraph1')); ?></p>
        <?php endif; ?>
        <?php if($about->field('paragraph2')): ?>
          <p><?php echo e($about->field('paragraph2')); ?></p>
        <?php endif; ?>
        <?php if($aboutStats->count()): ?>
        <div class="about-stats">
          <?php $__currentLoopData = $aboutStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div>
            <strong><?php echo e($stat->value); ?></strong>
            <small><?php echo e($stat->label()); ?></small>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="services" id="services">
    <div class="container">
      <div class="head fx-in">
        <?php if($servicesHeader->field('eyebrow')): ?>
          <p class="eyebrow" style="color:var(--gold-light);"><?php echo e($servicesHeader->field('eyebrow')); ?></p>
        <?php endif; ?>
        <?php if($servicesHeader->field('title')): ?>
          <h2><?php echo e($servicesHeader->field('title')); ?></h2>
        <?php endif; ?>
        <?php if($servicesHeader->field('subtitle')): ?>
          <p><?php echo e($servicesHeader->field('subtitle')); ?></p>
        <?php endif; ?>
      </div>

      <div class="petal-grid">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="petal">
          <span class="num"><?php echo e($service->number); ?></span>
          <?php if($service->letter): ?>
            <div class="petal-letter"><?php echo e($service->letter); ?></div>
          <?php endif; ?>
          <h3><?php echo e($service->field('title')); ?></h3>
          <p><?php echo e($service->field('description')); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="petal" style="display:flex; flex-direction:column; justify-content:center; align-items:flex-start;">
          <p style="color:rgba(255,255,255,.55); font-size:.92rem; margin-bottom:18px;"><?php echo e(__('front.service_not_listed')); ?></p>
          <a href="#contact" class="btn btn-outline" style="padding:12px 22px; font-size:.9rem;"><?php echo e(__('front.talk_to_team')); ?></a>
        </div>
      </div>
    </div>
  </section>

  <!-- WORLD MAP -->
  <?php echo $__env->make('front.sections.world-map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- SHIPPING SOLUTIONS -->
  <?php echo $__env->make('front.sections.shipping', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- PROCESS -->
  <section class="process" id="process">
    <div class="container">
      <div class="head fx-in">
        <?php if($processHeader->field('eyebrow')): ?>
          <p class="eyebrow"><?php echo e($processHeader->field('eyebrow')); ?></p>
        <?php endif; ?>
        <?php if($processHeader->field('title')): ?>
          <h2><?php echo e($processHeader->field('title')); ?></h2>
        <?php endif; ?>
        <?php if($processHeader->field('subtitle')): ?>
          <p><?php echo e($processHeader->field('subtitle')); ?></p>
        <?php endif; ?>
      </div>

      <div class="timeline" id="timeline">
        <div class="timeline-fill" id="timelineFill"></div>
        <?php $__currentLoopData = $processSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="step">
          <div class="step-dot"><?php echo e($step->step_number); ?></div>
          <h4><?php echo e($step->field('title')); ?></h4>
          <p><?php echo e($step->field('description')); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

  <!-- TRUST BAND -->
  <section class="trustband">
    <div class="container">
      <?php $__currentLoopData = $trustItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="trust-item">
        <div class="mark"></div>
        <h3><?php echo e($item->field('title')); ?></h3>
        <p><?php echo e($item->field('description')); ?></p>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </section>

  <!-- TEAM -->
  <section class="team" id="team">
    <div class="container">
      <div class="head fx-in">
        <?php if($teamHeader->field('eyebrow')): ?>
          <p class="eyebrow"><?php echo e($teamHeader->field('eyebrow')); ?></p>
        <?php endif; ?>
        <?php if($teamHeader->field('title')): ?>
          <h2><?php echo e($teamHeader->field('title')); ?></h2>
        <?php endif; ?>
        <?php if($teamHeader->field('subtitle')): ?>
          <p><?php echo e($teamHeader->field('subtitle')); ?></p>
        <?php endif; ?>
      </div>
      <div class="team-grid">
        <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="member">
          <?php if($member->image): ?>
            <img class="avatar" src="<?php echo e(asset('uploads/team/' . $member->image)); ?>" alt="<?php echo e($member->field('name')); ?>" style="object-fit:cover;">
          <?php else: ?>
            <div class="avatar"><?php echo e($member->initials); ?></div>
          <?php endif; ?>
          <div>
            <h3><?php echo e($member->field('name')); ?></h3>
            <p class="role"><?php echo e($member->field('role')); ?></p>
            <p class="desc"><?php echo e($member->field('description')); ?></p>
            <?php if($member->phone): ?>
              <a class="tel" href="tel:<?php echo e($member->phone); ?>"><?php echo e(ltrim($member->phone, '+')); ?> <span>→</span></a>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="contact" id="contact">
    <div class="container">
      <div>
        <?php if($contactHeader->field('eyebrow')): ?>
          <p class="eyebrow" style="color:var(--gold-light);"><?php echo e($contactHeader->field('eyebrow')); ?></p>
        <?php endif; ?>
        <?php if($contactHeader->field('title')): ?>
          <h2><?php echo e($contactHeader->field('title')); ?></h2>
        <?php endif; ?>
        <?php if($contactHeader->field('subtitle')): ?>
          <p><?php echo e($contactHeader->field('subtitle')); ?></p>
        <?php endif; ?>

        <div class="contact-cards">
          <?php $__currentLoopData = $contactPhones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="c-card">
            <div>
              <div class="label"><?php echo e($phone->label()); ?></div>
              <div class="value"><?php echo e($phone->phone); ?></div>
            </div>
            <a class="mini" href="tel:+<?php echo e(ltrim($phone->phone, '0')); ?>"><?php echo e(__('front.call')); ?> →</a>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      <div class="location-card">
        <?php if($location->field('title')): ?>
          <p class="eyebrow"><?php echo e(__('front.location')); ?></p>
          <h3><?php echo e($location->field('title')); ?></h3>
        <?php endif; ?>
        <div class="map-visual">
          <svg viewBox="0 0 400 180" xmlns="http://www.w3.org/2000/svg">
            <line x1="0" y1="40" x2="400" y2="40" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
            <line x1="0" y1="90" x2="400" y2="90" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
            <line x1="0" y1="140" x2="400" y2="140" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
            <line x1="90" y1="0" x2="90" y2="180" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
            <line x1="200" y1="0" x2="200" y2="180" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
            <line x1="310" y1="0" x2="310" y2="180" stroke="rgba(255,255,255,.08)" stroke-width="1"/>
          </svg>
          <div class="pin"></div>
        </div>
        <?php if($location->field('address')): ?>
        <address>
          <?php echo nl2br(e($location->field('address'))); ?>

        </address>
        <?php endif; ?>
        <?php if($location->maps_link): ?>
        <a class="btn btn-outline" style="border-color:rgba(255,255,255,.35);" target="_blank" rel="noopener"
           href="<?php echo e($location->maps_link); ?>"><?php echo e(__('front.open_maps')); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lotus\resources\views/front/home.blade.php ENDPATH**/ ?>