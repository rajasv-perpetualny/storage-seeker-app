<div class="container">
  @if( empty($featuredCities)  )
  <div id="featured-cities" class="featured-cities">
      <h3>Featured cities</h3>
      <ul>
          <li><a id="city-landing-01" href="{{ url('/search', ['slug' => 'ca-san-diego']) }}">San Diego storage units</a></li>
          <li><a id="city-landing-02" href="{{ url('/search', ['slug' => 'il-chicago']) }}">Chicago storage units</a></li>
          <li><a id="city-landing-03" href="{{ url('/search', ['slug' => 'ga-atlanta']) }}">Atlanta storage units</a></li>
          <li><a id="city-landing-04" href="{{ url('/search', ['slug' => 'tx-plano']) }}">Plano storage units</a></li>
          <li><a id="city-landing-05" href="{{ url('/search', ['slug' => 'or-portland']) }}">Portland storage units</a></li>
      </ul>
      <ul>
          <li><a id="city-landing-06" href="{{ url('/search', ['slug' => 'az-phoenix']) }}">Phoenix storage units</a></li>
          <li><a id="city-landing-07" href="{{ url('/search', ['slug' => 'ny-brooklyn']) }}">Brooklyn storage units</a></li>
          <li><a id="city-landing-08" href="{{ url('/search', ['slug' => 'nv-las-vegas']) }}">Las Vegas storage units</a></li>
          <li><a id="city-landing-09" href="{{ url('/search', ['slug' => 'ca-los-angeles']) }}">Los Angeles storage units</a></li>
          <li><a id="city-landing-10" href="{{ url('/search', ['slug' => 'tx-austin']) }}">Austin storage units</a></li>
      </ul>
      <ul>
          <li><a id="city-landing-11" href="{{ url('/search', ['slug' => 'tx-dallas']) }}">Dallas storage units</a></li>
          <li><a id="city-landing-12" href="{{ url('/search', ['slug' => 'co-denver']) }}">Denver storage units</a></li>
          <li><a id="city-landing-13" href="{{ url('/search', ['slug' => 'tx-houston']) }}">Houston storage units</a></li>
          <li><a id="city-landing-14" href="{{ url('/search', ['slug' => 'ny-new-yor']) }}">New York storage units</a></li>
          <li><a id="city-landing-15" href="{{ url('/search', ['slug' => 'tx-el-paso']) }}">El Paso storage units</a></li>
      </ul>
  </div>
  @endif
  @if(!empty($featuredCities))
  <div id="featured-cities" class="featured-cities">

  <h3>Featured cities in {{ $pageData->title }}</h3>
    <ul>
    @foreach($featuredCities as $city)
      @if($loop->index >= $loop->count/3)
        @break
      @endif
      <li><a href="{{ url('/search', ['slug' => $city['slug']]) }}">{{$city['name']}} storage units</a></li>
    @endforeach
    </ul>
    <ul>
    @foreach($featuredCities as $city)
      @if($loop->index <= $loop->count/3)
        @continue
      @endif
      @if($loop->index > ($loop->count*2)/3)
        @break
      @endif
      <li><a href="{{ url('/search', ['slug' => $city['slug']]) }}">{{$city['name']}} storage units</a></li>
    @endforeach
    </ul>
    <ul>
    @foreach($featuredCities as $city)
      @if($loop->index <= ($loop->count*2)/3)
        @continue
      @endif
      <li><a href="{{ url('/search', ['slug' => $city['slug']]) }}">{{$city['name']}} storage units</a></li>
    @endforeach
    </ul>
  </div>
  @endif
</div>
