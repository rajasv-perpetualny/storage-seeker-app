@extends('layout')
@section('content')
<div class="page-hero home-hero state-hero">
    <div class="page-hero-cell">

        <div class="home-hero-heading no-bottom-margin">
          <h1>Find Self Storage Near You</h1>
        </div>
        @include('includes.homeForm')
    </div>
</div>


    <article class="page">
        <div class="container size-guide">
          <h2 class="content-h2">Make Your Search Easier</h2>
          <p>Storage Seeker allows you to easily <a href="/self-storage">find self-storage units by state</a>, city, zip code or address. From there you can compare each storage facilities’ rates, availability, and then book online for free without a credit card. Need a climate controlled storage unit? You can narrow down those facilities that have various features such as climate control, drive-up units and RV storage, among other choices. Storage Seeker provides you with all of the details for each storage company as well as any potential special pricing offers. Start searching now!</p>
          <br/>
          <h2 class="content-h2">Find the Best Price</h2>
          <p>
            It can be very beneficial for consumers and businesses to use Storage Seeker to compare self-storage prices and find the best move-in specials in their respective cities. Often if you look at different self-storage facilities that are in different cities but that are actually in very close proximity to each other, you can find a much better price for space. We help you do that by showing every available storage facility in that particular search area on a map (which may include different cities located near each other) and letting you see lower-priced options in nearby cities. The savings by comparing options for storage can add up over time.
          </p>
          <br/>
          <h2 class="content-h2">Find the Best Facility for Your Storage Needs</h2>
          <p>
            If someone rents a storage unit for 12 months, then renting a space that has a 20% lower price could end up being hundreds of dollars in savings. Similarly, for business storage, since businesses usually rent storage space for 2+ years, those savings could add up to thousands of dollars. Finally, for RV or other vehicle storage such as boats, since those vehicles are stored for long periods of time and the cost for interior vehicle space rivals the cost of a business-sized unit, the savings could add up to thousands of dollars as well. A simple comparison using our site can yield a lot of cost savings for both consumers and businesses. In summary, Storage Seeker believes that the following is true about different renter profiles:
          </p>
          <ul>
            <li>Household Storage: average savings over 12 months can be hundreds of dollars</li>
            <li>Business Storage: average savings over 2 years can be in the thousands of dollars range</li>
            <li>RV or Other Vehicle Storage: average savings over 2+ years might also be thousands of dollars</li>
          </ul>
          <p>
          Knowing all the available options for self-storage near you has never been easier using StorageSeeker.com. Be sure to compare facilities by price, discounts, amenities, and location in order to save you the most money over time.
          </p>

        </div>
    </article>

    <article class="page value-prop-container find-storage-value-prop">
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
@section('scripts')
    @include('includes.googlemapsIncludes')
@endsection
