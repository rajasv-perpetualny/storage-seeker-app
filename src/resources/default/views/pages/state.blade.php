@extends('layout')
@section('content')
    @if($headerImage)
      <div class="page-hero home-hero custom-hero" style="background: url({{$headerImage}})">
    @else
      <div class="page-hero home-hero">
    @endif
        <div class="page-hero-cell">

            <div class="home-hero-heading">
                <h1>Find Self Storage in {{ $pageData->title }}</h1>
                <h2>{{ $pageData->content }}</h2>
            </div>
            @include('includes.homeForm')
        </div>
    </div>
    <article class="value-prop-container">
        <div class="container">
            <div class="value-props">
                <div class="value-prop">
                    <img src="{{ url('/storage/images/value-prop-1-orange.svg') }}" alt="Magnifying glass" title="Search" class="value-prop-image" width="50" height="50"/>
                    <h3><span class="circle-number">1</span> Search</h3>
                    <p>10,000+ locations nationwide.<br/>Get started by telling us where you need storage.</p>
                </div>
                <div class="value-prop">
                    <img src="{{ url('/storage/images/value-prop-2-orange.svg') }}" alt="Checkboxes" title="Compare" class="value-prop-image" width="50" height="50"/>
                    <h3><span class="circle-number">2</span> Compare</h3>
                    <p>See all options near you.<br/>Compare by price, amenities, discounts and more.</p>
                </div>
                <div class="value-prop">
                    <img src="{{ url('/storage/images/value-prop-3-orange.svg') }}" alt="Wallet" title="Reserve" class="value-prop-image" width="50" height="50"/>
                    <h3><span class="circle-number">3</span> Reserve</h3>
                    <p>Reserve with a single click.<br/>It’s 100% free, no obligations or fine print.</p>
                </div>
            </div>
        </div>
    </article>
    <article id="listings" class="popular-facilities container">
      <div class="state-description">
        <h2 class="state-title">
          {{ $pageData->h2 }}
        </h2>
        <p>
          @if($pageData->description)
            {!! $pageData->description !!}
          @else
          Storage Seeker covers {{sizeOf($featuredCities)}} cities in the State of {{ $pageData->title }} that have self-storage units for rent.
          By finding the closest city to your location, you can easily find the right-sized storage space for
          lease near you that has the best price that meets your needs. {{ $pageData->title }} storage space is
          categorized into all of the different cities and zip codes around the state where Storage Seeker
          has storage units for rent. Comparing prices between two nearby cities to your location will also
          help you find the cheapest self-storage unit available for rent. Over time, this may save you a
          lot of money in rent payments for storage in {{ $pageData->title }}.
          @endif
        </p>
      </div>
      @include('includes.popularFacilities')
    </article>
@endsection
@section('scripts')
    @include('includes.googlemapsIncludes')
@endsection
