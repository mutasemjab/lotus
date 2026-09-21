@extends('layouts.front')
@section('title', __('front.page_title'))

@section('content')
<main id="top">

  <!-- HERO -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="container hero-content">
      <div class="hero-grid">
        <div>
          <p class="hero-kicker">{{ $hero->field('kicker') }}</p>
          <h1>
            @foreach(explode("\n", $hero->field('title') ?? '') as $line)
              <span class="line"><span>{{ trim($line) }}</span></span>
            @endforeach
          </h1>
          <p class="lead">{{ $hero->field('lead') }}</p>
          <div class="hero-actions">
            <a href="{{ $hero->btn1_link ?? '#contact' }}" class="btn btn-gold">{{ $hero->field('btn1_text') }}</a>
            <a href="{{ $hero->btn2_link ?? '#services' }}" class="btn btn-outline">{{ $hero->field('btn2_text') }}</a>
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
    <div class="hero-scroll">{{ __('front.scroll') }} <span class="bar"></span></div>
  </section>

  <!-- MARQUEE -->
  <div class="strip">
    <div class="strip-track" id="marqueeTrack">
      @foreach($marqueeItems as $item)
        <span>{{ $item->text() }}</span>
      @endforeach
      @foreach($marqueeItems as $item)
        <span>{{ $item->text() }}</span>
      @endforeach
    </div>
  </div>

  <!-- STATS -->
  @include('front.sections.stats')

  <!-- ABOUT -->
  <section class="about" id="about">
    <div class="container">
      <div class="about-media">
        @if($about->image)
          <img src="{{ asset('assets/uploads/about/' . $about->image) }}" alt="{{ $about->field('title') }}">
        @else
          <img src="https://images.unsplash.com/photo-1740914994657-f1cdffdc418e?fm=jpg&q=80&w=1400&auto=format&fit=crop" alt="Warehouse operations">
        @endif
        @if($about->badge_number)
        <div class="about-badge">
          <strong>{{ $about->badge_number }}</strong>
          <span>{{ $about->field('badge_text') }}</span>
        </div>
        @endif
      </div>
      <div>
        @if($about->field('eyebrow'))
          <p class="eyebrow">{{ $about->field('eyebrow') }}</p>
        @endif
        <h2>{{ $about->field('title') }}</h2>
        @if($about->field('paragraph1'))
          <p>{{ $about->field('paragraph1') }}</p>
        @endif
        @if($about->field('paragraph2'))
          <p>{{ $about->field('paragraph2') }}</p>
        @endif
        @if($aboutStats->count())
        <div class="about-stats">
          @foreach($aboutStats as $stat)
          <div>
            <strong>{{ $stat->value }}</strong>
            <small>{{ $stat->label() }}</small>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>
  </section>

  <!-- SERVICES -->
  <section class="services" id="services">
    <div class="container">
      <div class="head fx-in">
        @if($servicesHeader->field('eyebrow'))
          <p class="eyebrow" style="color:var(--gold-light);">{{ $servicesHeader->field('eyebrow') }}</p>
        @endif
        @if($servicesHeader->field('title'))
          <h2>{{ $servicesHeader->field('title') }}</h2>
        @endif
        @if($servicesHeader->field('subtitle'))
          <p>{{ $servicesHeader->field('subtitle') }}</p>
        @endif
      </div>

      <div class="petal-grid">
        @foreach($services as $service)
        <div class="petal">
          <span class="num">{{ $service->number }}</span>
          @if($service->letter)
            <div class="petal-letter">{{ $service->letter }}</div>
          @endif
          <h3>{{ $service->field('title') }}</h3>
          <p>{{ $service->field('description') }}</p>
        </div>
        @endforeach
        <div class="petal" style="display:flex; flex-direction:column; justify-content:center; align-items:flex-start;">
          <p style="color:rgba(255,255,255,.55); font-size:.92rem; margin-bottom:18px;">{{ __('front.service_not_listed') }}</p>
          <a href="#contact" class="btn btn-outline" style="padding:12px 22px; font-size:.9rem;">{{ __('front.talk_to_team') }}</a>
        </div>
      </div>
    </div>
  </section>

  <!-- WORLD MAP -->
  @include('front.sections.world-map')

  <!-- SHIPPING SOLUTIONS -->
  @include('front.sections.shipping')

  <!-- PROCESS -->
  <section class="process" id="process">
    <div class="container">
      <div class="head fx-in">
        @if($processHeader->field('eyebrow'))
          <p class="eyebrow">{{ $processHeader->field('eyebrow') }}</p>
        @endif
        @if($processHeader->field('title'))
          <h2>{{ $processHeader->field('title') }}</h2>
        @endif
        @if($processHeader->field('subtitle'))
          <p>{{ $processHeader->field('subtitle') }}</p>
        @endif
      </div>

      <div class="timeline" id="timeline">
        <div class="timeline-fill" id="timelineFill"></div>
        @foreach($processSteps as $step)
        <div class="step">
          <div class="step-dot">{{ $step->step_number }}</div>
          <h4>{{ $step->field('title') }}</h4>
          <p>{{ $step->field('description') }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- TRUST BAND -->
  <section class="trustband">
    <div class="container">
      @foreach($trustItems as $item)
      <div class="trust-item">
        <div class="mark"></div>
        <h3>{{ $item->field('title') }}</h3>
        <p>{{ $item->field('description') }}</p>
      </div>
      @endforeach
    </div>
  </section>

  <!-- TEAM -->
  <section class="team" id="team">
    <div class="container">
      <div class="head fx-in">
        @if($teamHeader->field('eyebrow'))
          <p class="eyebrow">{{ $teamHeader->field('eyebrow') }}</p>
        @endif
        @if($teamHeader->field('title'))
          <h2>{{ $teamHeader->field('title') }}</h2>
        @endif
        @if($teamHeader->field('subtitle'))
          <p>{{ $teamHeader->field('subtitle') }}</p>
        @endif
      </div>
      <div class="team-grid">
        @foreach($teamMembers as $member)
        <div class="member">
          @if($member->image)
            <img class="avatar" src="{{ asset('uploads/team/' . $member->image) }}" alt="{{ $member->field('name') }}" style="object-fit:cover;">
          @else
            <div class="avatar">{{ $member->initials }}</div>
          @endif
          <div>
            <h3>{{ $member->field('name') }}</h3>
            <p class="role">{{ $member->field('role') }}</p>
            <p class="desc">{{ $member->field('description') }}</p>
            @if($member->phone)
              <a class="tel" href="tel:{{ $member->phone }}">{{ ltrim($member->phone, '+') }} <span>→</span></a>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="contact" id="contact">
    <div class="container">
      <div>
        @if($contactHeader->field('eyebrow'))
          <p class="eyebrow" style="color:var(--gold-light);">{{ $contactHeader->field('eyebrow') }}</p>
        @endif
        @if($contactHeader->field('title'))
          <h2>{{ $contactHeader->field('title') }}</h2>
        @endif
        @if($contactHeader->field('subtitle'))
          <p>{{ $contactHeader->field('subtitle') }}</p>
        @endif

        <div class="contact-cards">
          @foreach($contactPhones as $phone)
          <div class="c-card">
            <div>
              <div class="label">{{ $phone->label() }}</div>
              <div class="value">{{ $phone->phone }}</div>
            </div>
            <a class="mini" href="tel:+{{ ltrim($phone->phone, '0') }}">{{ __('front.call') }} →</a>
          </div>
          @endforeach
        </div>
      </div>

      <div class="location-card">
        @if($location->field('title'))
          <p class="eyebrow">{{ __('front.location') }}</p>
          <h3>{{ $location->field('title') }}</h3>
        @endif
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
        @if($location->field('address'))
        <address>
          {!! nl2br(e($location->field('address'))) !!}
        </address>
        @endif
        @if($location->maps_link)
        <a class="btn btn-outline" style="border-color:rgba(255,255,255,.35);" target="_blank" rel="noopener"
           href="{{ $location->maps_link }}">{{ __('front.open_maps') }}</a>
        @endif
      </div>
    </div>
  </section>

</main>
@endsection
