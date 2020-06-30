@extends('layout')
@section('content')
    <div class="page-hero home-hero state-hero">
        <div class="page-hero-cell">

            <div class="home-hero-heading">
              <h1>Find Self Storage by State</h1>
            </div>
               @include('includes.homeForm')
        </div>
    </div>
    <article class="value-prop-container states-value-prop">
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
    <div class="container container-small">
      <div class="states-list">
        <ul>
        @foreach($pageData as $state)
          <li><a href="{{ url('/self-storage', ['slug' => strtoupper($state->slug)]) }}">{{ $state->post_title}}</a></li>
        @endforeach
        </ul>
      </div>
    </div>

@endsection

