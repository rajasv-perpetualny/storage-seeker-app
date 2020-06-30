<div class="container">
  @if( empty($featuredCities)  )
  <div id="featured-cities" class="featured-cities">
      <h3>Featured cities</h3>
      <ul>
          <li><a id="city-landing-01" href="{{ url('/self-storage/CA', ['slug' => 'san-diego']) }}">San Diego Self-Storage</a></li>
          <li><a id="city-landing-02" href="{{ url('/self-storage/IL', ['slug' => 'chicago']) }}">Chicago Self-Storage</a></li>
          <li><a id="city-landing-03" href="{{ url('/self-storage/GA', ['slug' => 'atlanta']) }}">Atlanta Self-Storage</a></li>
          <li><a id="city-landing-04" href="{{ url('/self-storage/TX', ['slug' => 'plano']) }}">Plano Self-Storage</a></li>
          <li><a id="city-landing-05" href="{{ url('/self-storage/OR', ['slug' => 'portland']) }}">Portland Self-Storage</a></li>
          <li><a id="city-landing-06" href="{{ url('/self-storage/AZ', ['slug' => 'phoenix']) }}">Phoenix Self-Storage</a></li>
          <li><a id="city-landing-07" href="{{ url('/self-storage/NY', ['slug' => 'brooklyn']) }}">Brooklyn Self-Storage</a></li>
          <li><a id="city-landing-08" href="{{ url('/self-storage/NV', ['slug' => 'las-vegas']) }}">Las Vegas Self-Storage</a></li>
          <li><a id="city-landing-09" href="{{ url('/self-storage/CA', ['slug' => 'los-angeles']) }}">Los Angeles Self-Storage</a></li>
          <li><a id="city-landing-10" href="{{ url('/self-storage/TX', ['slug' => 'austin']) }}">Austin Self-Storage</a></li>
          <li><a id="city-landing-11" href="{{ url('/self-storage/TX', ['slug' => 'dallas']) }}">Dallas Self-Storage</a></li>
          <li><a id="city-landing-12" href="{{ url('/self-storage/CO', ['slug' => 'denver']) }}">Denver Self-Storage</a></li>
          <li><a id="city-landing-13" href="{{ url('/self-storage/TX', ['slug' => 'houston']) }}">Houston Self-Storage</a></li>
          <li><a id="city-landing-14" href="{{ url('/self-storage/NY', ['slug' => 'manhattan']) }}">New York Self-Storage</a></li>
          <li><a id="city-landing-15" href="{{ url('/self-storage/TX', ['slug' => 'el-paso']) }}">El Paso Self-Storage</a></li>
      </ul>
  </div>
  @endif
  @if(!empty($featuredCities))
  <div id="featured-cities" class="featured-cities states-list">
  @if(isset($pageData))
  <h3 class="state-title">{{ $pageData->title }} Cities</h3>
  @else
  <h3 class="state-title">Featured Cities</h3>
  @endif
    <ul>
    @foreach($featuredCities as $city)
      <li><a href="{{ url('/self-storage/'.explode(', ',$city['title'])[1], ['slug' => str_replace('-'. strtolower(explode(', ',$city['title'])[1]), '', str_slug($city['title'], '-'))]) }}">{{explode(', ',$city['title'])[0]}} Self-Storage</a></li>
    @endforeach
    </ul>
  </div>
  @endif
</div>
