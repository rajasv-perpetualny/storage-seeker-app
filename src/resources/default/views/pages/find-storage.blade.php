@extends('layout')
@section('content')
    <div class="page-hero">
        <div class="page-hero-cell">
            <div class="phone-number">
                <h3>{{ config('site.default.phone')  }}</h3>
            </div>
            <div class="logo-wrapper">
                <a href="/"><img src="{{url('/storage/images/storageseeker-logo.png')}}" class="logo" alt="Storage Seeker" width="375" /></a>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="/size-guide">Storage Size Guide</a></li>
                    <li><a href="http://blog.storageseeker.com">Blog</a></li>
                </ul>
            </nav>
            @include('includes.homeForm')
        </div>
    </div>

    <article class="page">
        <div class="container">
            <div class="find-storage-copy">
                <h3><i class="fa fa-check"></i> Find Self Storage Units By Zip Codes</h3>
                <h3><i class="fa fa-check"></i> Storage Facility's Rates, Availability, and Book Online</h3>
                <h3><i class="fa fa-check"></i> Climate Controlled Storage Unit</h3>
                <p>Storage Seeker allows you to easily find self storage units by zip codes or your address. From there you can compare each storage facility’s rates, availability, and book online. Need a climate controlled storage unit? Storage Seeker provides you with all of the details for each storage company as well as any potential special pricing offers. Start searching now!</p>
            </div>
        </div>
    </article>

    <article class="page">
        <div class="container">
            <div class="how-it-works-copy">
                <h3>How it works</h3>
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
        </div>
    </article>
@endsection
