<div class="city-stats">
  <div class="stat-row header-row">
    <div class="name stat-col">
      Size
    </div>
    <div class="avg stat-col">
      Average Price
    </div>
    <div class="min stat-col">
      Lowest Price
    </div>
  </div>
  @if($avgSmall)
  <div class="5x5 stat-row">
    <div class="name stat-col">
      5 x 5
    </div>
    <div class="avg stat-col">
      ${{number_format($avgSmall, 2, '.', ',')}}
    </div>
    <div class="min stat-col">
      ${{number_format($minSmall, 2, '.', ',')}}
    </div>
  </div>
  @endif
  @if($avgMed)
  <div class="5x10 stat-row">
    <div class="name stat-col">
      5 x 10
    </div>
    <div class="avg stat-col">
      ${{number_format($avgMed, 2, '.', ',')}}
    </div>
    <div class="min stat-col">
      ${{number_format($minMed, 2, '.', ',')}}
    </div>
  </div>
  @endif
  @if($avgLarge)
  <div class="10x10 stat-row">
    <div class="name stat-col">
      10 x 10
    </div>
    <div class="avg stat-col">
      ${{number_format($avgLarge, 2, '.', ',')}}
    </div>
    <div class="min stat-col">
      ${{number_format($minLarge, 2, '.', ',')}}
    </div>
  </div>
  @endif
</div>
