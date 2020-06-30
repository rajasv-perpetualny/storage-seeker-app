@extends('layout')
@section('content')
    <div class="page-hero home-hero">
        <div class="page-hero-cell">

            <div class="home-hero-heading">
              <h2>Compare Self Storage Facilities</h2>
              <h1>Find and reserve a storage unit in minutes with Storage Seeker.</h1>
            </div>
            @include('includes.homeForm')
        </div>
    </div>
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
              <h2 class="content-h2">Save Money with Storage Seeker</h2>
                <p>Storage Seeker is the most comprehensive online database of storage units that allows you to
                find, compare and reserve space in self-storage facilities. Using state-of-the-art mapping and
                comparison tools, Storageseeker.com gives you the ability to search for the best prices for
                storage units or space for RVs and vehicles and make reservations online. You can reserve a
                self-storage space online for the move-in date that works for you for free and then visit the
                facility to finalize the rental. By comparing prices for storage units online and then getting the
                best discount or move-in special, you can save a lot of money over time!</p>
                <br/>
              <h2 class="content-h2">
                StorageSeeker.com gives you the ability to easily:
              </h2>
                <ul>
                  <li>Find self-storage units near you</li>
                  <li>Compare storage unit prices between cities</li>
                  <li>Reserve a mini storage space online for free</li>
               </ul>
               <h2 class="content-h2">
                 Filter Units to Find Exactly What You Need
               </h2>
              <p>
                When someone is trying to find a self-storage unit for rent, there are a lot of options out there. That can be really overwhelming! Luckily StorageSeeker can help you find the right storage unit in a number of different ways including: filtering space amenities, showing available discounts, and letting you compare storage prices for multiple properties in your neighborhood. This helps potential storage unit renters obtain the most complete picture of the available options when they need to store items for their home, business, or recreational vehicles.
                <br/>
                <br/>
              </p>
                <h2 class="content-h2">
                  The Perfect Fit
                </h2>
                <p>
                Storageseeker.com provides a variety of <a href="/size-guides">self-storage size options</a> available as well when renters are looking for units in their respective cities. These range from smaller sizes such as 5’x5’ or 5’x10’ units that are closet-sized and can store a few household items or act as excess space for small apartments - to larger sizes such as 10’x10’ and 10’x15’ units that can store entire households that are moving or business inventory. The unit sizes also get as large as 10’x20’ to 10’x30’ and above, which can store items for a large house, major business, boat, RV or other vehicle.
              </p>
            </div>
        </div>
    </article>
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
      </article>
@endsection
@section('scripts')
    @include('includes.googlemapsIncludes')
@endsection
