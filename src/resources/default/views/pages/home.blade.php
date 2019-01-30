@extends('layout')
@section('content')
    <div class="page-hero home-hero">
        <div class="page-hero-cell">
            <div class="phone-number">
                <h3>{{config('site.default.phone')}}</h3>
            </div>
            <div class="logo-wrapper">
                <a href="/"><img src="{{ url('/storage/images/storageseeker-logo.png') }}" class="logo" alt="Storage Seeker" width="375" /></a>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="/size-guide">Storage Size Guide</a></li>
                    <li><a href="http://blog.storageseeker.com">Blog</a></li>
                </ul>
            </nav>
            <div class="home-hero-heading">
                <h1>Compare Self Storage Facilities</h1>
                <h2>Find and reserve a storage unit in minutes with Storage Seeker.</h2>
            </div>
            @include('includes.homeForm')
            <article>
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
                    <div class="about-storageseeker">
                        <p>StorageSeeker is the most comprehensive list that allows you to compare self storage facilities available online. Using state-of-the-art mapping and comparison features, StorageSeeker gives you the ability to search for the best rates on storage units and make reservations online. </p>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <article class="reviews-container">
        <div class="container">
            <div class="reviews">
                <h3>We help customers choose better facilities with reviews like these</h3>
                <div class="review-cards">
                    <div class="review-card-container">
                        <div class="review-card">
                            <div class="review-card-content">
                                <img src="{{ url('/storage/images/review-1.jpg') }}" class="review-img" width="70" />
                                <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                <p>They were professional, helpful, quick and kind. And a good bargain! The best combo!</p>
                            </div>
                            <div class="review-author">Michael</div>
                        </div>
                    </div>
                    <div class="review-card-container">
                        <div class="review-card">
                            <div class="review-card-content">
                                <img src="{{ url('/storage/images/review-2.jpg') }}" class="review-img" width="70" />
                                <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                <p>The managers Joy and Sharon were so welcoming and accommodating. They made my transition pleasant and smooth. Thanks so much!</p>
                            </div>
                            <div class="review-author">Tamara</div>
                        </div>
                    </div>
                    <div class="review-card-container">
                        <div class="review-card">
                            <div class="review-card-content">
                                <img src="{{ url('/storage/images/review-3.jpg') }}" class="review-img" width="70" />
                                <div class="review-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                                <p>The manager handles the business is if it were her own. Very impressive. I have already referred people to this facility!</p>
                            </div>
                            <div class="review-author">Samantha</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    @include('includes.googlempasIncludes')
@endsection
