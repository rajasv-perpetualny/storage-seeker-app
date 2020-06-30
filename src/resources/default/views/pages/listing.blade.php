@extends('layout')
@section('content')
    @include('includes.googlemarks', [])
    <main>
        @if((!isset($noLocation) || !$noLocation) && $result->total() > 0)
            @include('includes.map')
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
            @include('includes.search')
            <div class="list {{$result->total()}}-facilities">
                <h1><span id="count">{{ $result->total() > 0 ? $result->total(): 0 }}</span> Facilities - {{ $location }}</h1>
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
                <section id="custom-content">
                        @include('includes.articles')
                </section>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    @include('includes.googlemapsIncludes')
@endsection