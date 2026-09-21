@if($mapCountries->count())
@php
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
@endphp
<section class="reach" id="reach">
  <div class="container">
    <div class="head fx-in">
      @if($mapHeader->field('eyebrow'))
        <p class="eyebrow">{{ $mapHeader->field('eyebrow') }}</p>
      @endif
      @if($mapHeader->field('title'))
        <h2>{{ $mapHeader->field('title') }}</h2>
      @endif
      @if($mapHeader->field('subtitle'))
        <p>{{ $mapHeader->field('subtitle') }}</p>
      @endif
    </div>

    <div class="reach-map" role="img" aria-label="{{ $mapHeader->field('title') }}">
      <img class="reach-dots" src="{{ asset('assets_front/img/world-dots.svg') }}" alt="" loading="lazy">

      <svg class="reach-arcs" viewBox="0 0 {{ $mapW }} {{ $mapH }}" preserveAspectRatio="none" aria-hidden="true">
        @foreach($arcs as $i => $d)
          <path d="{{ $d }}" style="animation-delay: {{ $i * 0.18 }}s"/>
        @endforeach
      </svg>

      @foreach($mapCountries as $c)
        <div class="pin {{ $c->is_hub ? 'hub' : '' }}"
             style="left: {{ round(($c->longitude - $lon0) / $mapW * 100, 3) }}%; top: {{ round(($latTop - $c->latitude) / $mapH * 100, 3) }}%;">
          <span class="pin-flag"><img src="{{ $c->flagUrl() }}" alt="" loading="lazy"></span>
          <span class="pin-name">{{ $c->name() }}</span>
        </div>
      @endforeach
    </div>

    <ul class="reach-legend">
      @foreach($mapCountries as $c)
        <li><img src="{{ $c->flagUrl() }}" alt="" loading="lazy"> {{ $c->name() }}</li>
      @endforeach
    </ul>
  </div>
</section>
@endif
