<div class="facility-address-block">
    <span itemprop="address" itemscope itemtype="//schema.org/PostalAddress">
        <span itemprop="streetAddress">{{$facility->address}}</span><br />
        <span itemprop="addressLocality">{{$facility->city}}</span>,
        <abbr itemprop="addressRegion" title="{{$facility->state}}">{{$facility->state}}</abbr>
        <span itemprop="postalCode">{{$facility->zip}}</span><br />
    </span>
    @if($facility->showPhoneNumber == "true")
        {{$facility->trackedPhoneNumber}}
    @endif

    <div itemprop="geo" itemscope itemtype="//schema.org/GeoCoordinates">
        <meta itemprop="latitude" content="<?=$facility->latitude?>" />
        <meta itemprop="longitude" content="<?=$facility->longitude?>" />
    </div>
    @if($facilityReviewsCount)
        <div itemprop="aggregateRating" itemscope itemtype="//schema.org/AggregateRating">
            <div class="rating">
                <div class="rating-stars">
                    @for($starIterator=0; $starIterator<5; $starIterator++)
                        @if($starIterator < floor($facilityReviewsAverageRating))
                            <i class="icon-star review-star"></i>
                        @elseif($starIterator < floor($facilityReviewsAverageRating*2)/2)
                            <i class="icon-star-half review-star"></i>
                        @else
                            <i class="icon-star-empty review-star"></i>
                        @endif
                    @endfor
                </div>
                <span itemprop="ratingValue">{{$facilityReviewsAverageRating}}</span> out of <span itemprop="bestRating">5</span>
            </div>

            <p>
                @if ($facilityReviewsCount > 1)
                <a href="#reviews" class="js-show-tab">
                    See all <span itemprop="reviewCount">{{$facilityReviewsCount}}</span> reviews
                </a><br>
                @elseif ($facilityReviewsCount > 0)
                <a href="#reviews" class="js-show-tab">
                    See <span itemprop="reviewCount">{{$facilityReviewsCount}}</span> review
                </a><br>
                @endif

                <a href="#reviews" class="js-show-review-form">Review this facility</a>
            </p>
        </div>
    @elseif(isset($internetReview))
        <div class="rating">
            <div class="rating-stars online">
                @for($starIterator=0; $starIterator<5; $starIterator++)
                    @if($starIterator < floor($facilityReviewsInternetAverageRating))
                        <i class="icon-star review-star"></i>
                    @elseif($starIterator < floor($facilityReviewsInternetAverageRating*2)/2)
                        <i class="icon-star-half review-star"></i>
                    @else
                        <i class="icon-star-empty review-star"></i>
                    @endif
                @endfor
            </div>
            <span><?=$facilityReviewsInternetAverageRating?></span> out of <span>5</span>
        </div>
        <p id="online_review_description"><a class="js-show-tab" href="#reviews">Online reviews</a> <i class="icon-info-sign online_reviews_description"></i></p>
    @else
        <p>No stars yet</p>
        <p><a href="#reviews" class="js-show-review-form">Be the first to review</a></p>
    @endif
</div>