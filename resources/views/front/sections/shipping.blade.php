@if($shippingModes->count())
@php
    $icons = [
        'sea'  => '<path d="M3 17c1.5 1.4 3 1.4 4.5 0s3-1.4 4.5 0 3 1.4 4.5 0 3-1.4 4.5 0"/><path d="M5 14l-1.5-5h17L19 14"/><path d="M8 9V5h5v4"/><path d="M13 7h3v2"/>',
        'air'  => '<path d="M2.5 13.5l7-1.5 5-8.5 2 .5-2.5 8 5.5-1 1.5-2 1.5.5-1 3.5 1 3.5-1.5.5-1.5-2-5.5-1 2.5 8-2 .5-5-8.5-7-1.5z"/>',
        'land' => '<path d="M2 7h11v9H2z"/><path d="M13 10h4.5l3.5 3.5V16h-8"/><circle cx="6.5" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
    ];
@endphp
<section class="ship" id="shipping">
  <div class="container">
    <div class="head fx-in">
      @if($shippingHeader->field('eyebrow'))
        <p class="eyebrow" style="color:var(--gold-light);">{{ $shippingHeader->field('eyebrow') }}</p>
      @endif
      @if($shippingHeader->field('title'))
        <h2>{{ $shippingHeader->field('title') }}</h2>
      @endif
      @if($shippingHeader->field('subtitle'))
        <p>{{ $shippingHeader->field('subtitle') }}</p>
      @endif
    </div>

    <div class="ship-grid">
      @foreach($shippingModes as $mode)
        <article class="ship-card ship-{{ $mode->icon }}">
          <div class="ship-top">
            <div class="ship-icon">
              <svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $icons[$mode->icon] ?? $icons['sea'] !!}</svg>
            </div>
            @if($mode->field('tag'))
              <span class="ship-tag">{{ $mode->field('tag') }}</span>
            @endif
          </div>

          <h3>{{ $mode->field('title') }}</h3>

          <ul class="ship-routes">
            @foreach($mode->routes as $route)
              <li>
                @if($route->field('to'))
                  <span class="r-from">{{ $route->field('from') }}</span>
                  <span class="r-arrow {{ $route->is_bidirectional ? 'both' : '' }}" aria-hidden="true"></span>
                  <span class="r-to">{{ $route->field('to') }}</span>
                @else
                  <span class="r-pin" aria-hidden="true"></span>
                  <span class="r-from">{{ $route->field('from') }}</span>
                @endif
              </li>
            @endforeach
          </ul>

          <a class="ship-more" href="{{ $mode->link ?: '#contact' }}">{{ __('front.discover_more') }} <span aria-hidden="true">→</span></a>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif
