@extends('layout')
@section('content')
    @include('includes.googlemarks', [])
    @if($headerImage)
      <div class="page-hero home-hero search-hero custom-hero" style="background: url({{$headerImage}})">
    @else
      <div class="page-hero search-hero home-hero">
    @endif
          <div class="page-hero-cell">

              <div class="home-hero-heading">
                @if($pageTitle)
                  <h1>{{ $pageTitle }}</h1>
                @else
                  <h1>Find Self Storage in {{ $city }}</h1>
                @endif
              </div>
              @include('includes.homeForm')
          </div>
      </div>
      <div class="search-container">
        @if((!isset($noLocation) || !$noLocation) && $result->total() > 0)
          <div class="map-container">
            @include('includes.map')

            <div class="content-container">
            @if($bottomLeftTitle)
            <h2>{{ $bottomLeftTitle }}</h2>
            @else
            <h2 class="">{{ $pageData->h2 }}</h2>
            @endif
              <div class="price-section-left">
              @if($contentImage)
              <div class="content-image">
                <img src="{{$contentImage}}" alt="{{$contentImageAltTag}}" />
              </div>
              @else
                <h3>Self-storage in {{$city}}, {{$state}} Current Sizes & Prices</h3>
                @if(!$hideBiggestFactor)
                <p>
                There are a number of things to consider when renting a self storage unit in  {{$city}}, {{$state}} - including the lowest price and best size. The monthly storage prices shown below are for the most common sizes of storage space available.
                </p>
                @endif
                @if(!$hidePricesTable)
                  @include('includes.priceStats')
                @endif
                @if(!$hideAveragePrice)
                  <p>The overall average price of a self-storage unit booked in {{$city}}, {{$state}} over the past 180 days is ${{number_format($overallAvg, 2, '.', ',')}}.</p>
                @endif
              @endif
              </div>
              @if($bottomLeftContent)
                <div class="bottom-left-content custom-content @if($customContentOrder)custom-content-top @endif">
                  {!! $bottomLeftContent !!}
                </div>
              @else
              <p class="bottom-left-content default-content @if($customContentOrder)custom-content-top @endif">
                Storage Seeker offers the most comprehensive inventory of {{$city}} self-storage units that are available to reserve online for free. The process is quick and easy – just find a storage space near you, reserve it online for free and without a credit card, and then visit the facility to move in on the date you picked! By using Storage Seeker to find self-storage in {{$city}}, you can easily compare the best storage unit sizes and prices available. Not only that, but with the ability to get the best price you can also access move-in specials and discounts that are available at each location.
              </p>
              @endif
          </div>
        </div>
        @elseif(isset($error) && $error)
            <div class="oops">
                <div class="oops-cell">
                    <p>There was an error handling your request. Please try again later.</p>
                </div>
            </div>
        @else
            @include('includes.oops')
        @endif
        <div class="search">
          <div class="h2-container">
            @if($resultsTitle)
            <h2>{{ $resultsTitle }}</h2>
            @elseif($pageData)
            <h2>{{ $pageData->h1 }}</h2>
            @else
            <h2>Find, Compare and Reserve Self Storage in {{$city}}, {{$state}}</h2>
            @endif
          </div>
            @include('includes.filters')
            <div class="list {{$result->total()}}-facilities">
                <h2><span id="count">{{ $result->total() > 0 ? $result->total(): 0 }}</span> Facilities - {{ $city }}, {{ $state }}</h2>
                <div class="sort">
                    <label>
                        <select id="select_order">
                            <option value="" {{ empty($order) ? 'selected' : '' }}>Sort By</option>
                            <option value="default" {{ ($order == 'default') ? 'selected' : '' }}>Recommended</option>
                            <option value="distance" {{ ($order == 'distance') ? 'selected' : '' }}>Distance</option>
                            <option value="price" {{ ($order == 'price') ? 'selected' : '' }}>Price</option>
                        </select>
                    </label>
                </div>
                <ul id="listings">
                    @include('includes.results')
                </ul>
                <section id="custom-content">
                </section>
                <div class="show-more">
                    <button id="show_more_button">Show More</button>
                </div>

                <section class="content-container" id="custom-content">
                  <div class="price-section-bottom">
                  @if($contentImage)
                  <div class="content-image">
                    <img src="{{$contentImage}}" alt="{{$contentImageAltTag}}" />
                  </div>
                  @else
                    <h3>Self-storage in {{$city}}, {{$state}} Current Sizes & Prices</h3>
                    @if(!$hideBiggestFactor)
                    <p>
                    There are a number of things to consider when renting a self storage unit in  {{$city}}, {{$state}} - including the lowest price and best size. The monthly  storage prices shown below are for the most common sizes of storage space available.
                    </p>
                    @endif
                    @if(!$hidePricesTable)
                      @include('includes.priceStats')
                    @endif
                    @if(!$hideAveragePrice)
                      <p>The overall average price of a self-storage unit booked in {{$city}}, {{$state}} over the past 180 days is ${{number_format($overallAvg, 2, '.', ',')}}.</p>
                    @endif
                  @endif
                  </div>
                  @if($bottomLeftContent)
                    <div class="low-height-show bottom-content custom-content @if($customContentOrder)custom-content-top @endif">
                      {!! $bottomLeftContent !!}
                    </div>
                  @else
                  <p class="low-height-show bottom-content default-content @if($customContentOrder)custom-content-top @endif">
                    Storage Seeker offers the most comprehensive inventory of {{$city}} self-storage units that are available to reserve online for free. The process is quick and easy – just find a storage space near you, reserve it online for free and without a credit card, and then visit the facility to move in on the date you picked! By using Storage Seeker to find self-storage in {{$city}}, you can easily compare the best storage unit sizes and prices available. Not only that, but with the ability to get the best price you can also access move-in specials and discounts that are available at each location.
                  </p>
                  @endif
                </section>
            </div>
        </div>
      </div>
@endsection
@section('scripts')
    @include('includes.googlemapsIncludes')
@endsection
