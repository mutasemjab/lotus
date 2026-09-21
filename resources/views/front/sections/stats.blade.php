@if($siteStats->count())
<section class="stats-band" aria-label="{{ __('front.stats_label') }}">
  <div class="container">
    <div class="stats-grid" style="--cols: {{ min($siteStats->count(), 4) }}">
      @foreach($siteStats as $stat)
        <div class="stat-cell">
          <div class="stat-num">
            <span class="js-count" data-count="{{ $stat->value }}">{{ number_format($stat->value) }}</span>@if($stat->suffix)<em>{{ $stat->suffix }}</em>@endif
          </div>
          <div class="stat-label">{{ $stat->label() }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
