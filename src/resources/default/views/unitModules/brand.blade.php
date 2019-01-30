<h1 itemprop="name">{{$unit->facility->name}}</h1>

<span itemprop="address" itemscope itemtype="//schema.org/PostalAddress">
<span itemprop="streetAddress">{{$unit->facility->address}}</span><br />
<span itemprop="addressLocality">{{$unit->facility->city}}</span>,
<abbr itemprop="addressRegion" title="{{$unit->facility->state}}">{{$unit->facility->state}}</abbr>
<span itemprop="postalCode">{{$unit->facility->zip}}</span><br />
</span>
@if($unit->facility->showPhoneNumber != true)
    <span class="phone" itemprop="telephone">{{$unit->facility->trackedPhoneNumber}}</span>
@endif
<div itemprop="geo" itemscope itemtype="//schema.org/GeoCoordinates">
<meta itemprop="latitude" content="{{$unit->facility->latitude}}" />
<meta itemprop="longitude" content="{{$unit->facility->longitude}}" />
</div>

@if($unit->facility->numRatings)
<div itemprop="aggregateRating" itemscope itemtype="//schema.org/AggregateRating">
    <div class="rating">
        <div class="rating-stars">
            <?php for($starIterator=0; $starIterator<5; $starIterator++){
            if($starIterator < floor($unit->facility->averageRating)){
            echo '<i class="icon-star review-star"></i>';
            } elseif($starIterator < floor($unit->facility->averageRating*2)/2) {
            echo '<i class="icon-star-half review-star"></i>';
            } else {
            echo '<i class="icon-star-empty review-star"></i>';
            }
            } ?>
        </div>
        <span itemprop="ratingValue"><?=$unit->facility->averageRating?></span> out of <span itemprop="bestRating">5</span>
    </div>

    <p>
        <a href="#reviews" class="js-show-tab"><?=($unit->facility->numRatings==1 ? 'See <span itemprop="reviewCount">'.$unit->facility->numRatings.'</span> review' : 'See all <span itemprop="reviewCount">'.$unit->facility->numRatings.'</span> reviews')?></a><br />
        <a href="#reviews" class="js-show-review-form">Review this facility</a>
    </p>
</div>
@else
    <p>No stars yet</p>
    <p><a href="#reviews" class="js-show-review-form">Be the first to review</a></p>
@endif
