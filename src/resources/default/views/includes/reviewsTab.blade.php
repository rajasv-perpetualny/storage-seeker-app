<h4>Help your fellow storage searchers make the right choice!</h4>

@if(isset($facilityReviewsShowMessaging))
<img class="pull-left chuck_review" src="/storage/images/chuck-reviews.png">
<p>
    &quot;Reviews from previous tenants help others find self-storage more quickly and confidently. If you like reading reviews, leaving one yourself is just good karma. Please take a moment to share your storage story, and think of all the future tenants you’ll help guide in the right direction. Thanks!&quot;<br/>
    <em>- Chuck, SpareFoot CEO</em>
</p>

@endif

<p><strong>Want $250? Leave a review to enter our monthly drawing for a $250 Amazon gift card. </strong> <a data-toggle="modal" href="#review-drawing-modal">Eligibility details.</a>
</p>

<div id="review-drawing-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Review Drawing Eligibility" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&#215;</button>
                <h4 class="modal-title">Renter Reviews: Amazon Gift Card Drawing</h4>
            </div>
            <div class="modal-body">
                <h4>Terms &amp; Conditions</h4>
                <p>On the first business day of every month, we randomly select one storage customer who left a review on SpareFoot during the previous month. We email this customer at the address provided with their review, letting them know they have won our drawing for a $250 Amazon gift card. Our email states that the customer has 7 days to reply and verify their preferred email address for electronic delivery of the gift card. If they reply in time, the customer will receive a $250 Amazon gift card, delivered electronically to their preferred email address within 1 business day. If the customer does not reply in time, we go back and randomly select a different storage customer, and this process repeats until we have a verified winner.</p>
                <h4>Eligibility</h4>
                <p>Every customer who submits a storage review with valid email address will be automatically entered into the Renter Reviews: Amazon Gift Card Drawing. Eligibility is dependent on your providing a valid email address in the review submission form of this page.</p>
            </div>
            <div class="modal-footer">
                <a data-dismiss="modal" class="btn btn-primary">Close</a>
            </div>
        </div>
    </div>
</div>

<p><a href="#reviews" class="js-show-review-form">Leave a review of {{$facilityName}}</a></p>

@if(count($facilityReviews))

<h4>Customer Reviews of this Facility ({{count($facilityReviews)}})</h4>

@foreach ($facilityReviews as $review)

<div class="sf-review" itemprop="review" itemscope itemtype="//schema.org/Review">
    <div class="about-review">
        <div class="rating-stars">
            @for($starIterator=0; $starIterator<5; $starIterator++)
                @if($starIterator < floor($review->rating))
                    <i class="icon-star review-star"></i>
                @elseif($starIterator < floor($review->rating*2)/2)
                    <i class="icon-star-half review-star"></i>
                @else
                    <i class="icon-star-empty review-star"></i>
                @endif
            @endfor
        </div>
        <span class="rating-written-out" itemprop="reviewRating" itemscope itemtype="//schema.org/Rating">
                        <meta itemprop="worstRating" content = "1">
                        <span class="rating" itemprop="ratingValue">{{$review->rating}}</span> out of
                        <span itemprop="bestRating">5</span> stars
                    </span>
        <div class="reviewer" itemprop="author">{{wordwrap($review->nickname, 15, '<br />', true)}}</div>
        <meta itemprop="datePublished" content="{{date("Y-m-d", strtotime($review->timestamp))}}" />{{date("M. j, Y", strtotime($review->timestamp))}}
    </div>

    <div class="review-body">
        @if(isset($review->sourceUrl))
            <q><strong itemprop="name">{{$review->title}}</strong><br />
                <span class="description" itemprop="description">{{$review->review}}</span>
            </q>
            @php $url = parse_url($review->sourceUrl) @endphp
            <a class="full-review-link" href="{{$review->sourceUrl}}" target="_blank">Read full review on {{$url['host']}}</a>
        @else
            <p><span class="summary"><strong>{{$review->title}}</strong></span><br />
                <span class="description" itemprop="description">{{substr($review->review,0,135)}}{{(strlen($review->review > 135))?'...':'' }}</span>
            </p>
        @endif
        @if(isset($review->ratingPrice))
            @php
                $revPrice = isset($review->ratingPrice) ? $review->ratingPrice : 0;
                $revLocation = isset($review->ratingLocation) ? $review->ratingLocation : 0;
                $revPaperwork = isset($review->ratingPaperwork) ? $review->ratingPaperwork : 0;
                $revSecurity = isset($review->ratingSecurity) ? $review->ratingSecurity : 0;
                $revService = isset($review->ratingService) ? $review->ratingService : 0;
                $revClean = isset($review->ratingCleanliness) ? $review->ratingCleanliness : 0;
            @endphp

            @if($revPrice)
                <p class="clear"><span class="slider_wrapper"><span class="slider-yellow slider11of<?=$revPrice?>0">&nbsp;</span></span>
                    <span class="slider_detail"><strong>Price</strong> - <?=$revPrice?>/5 (<?=$review->getPriceValue($review->getRatingPrice())?>)</span>
                </p>
            @endif

            @if($revLocation)
                <p class="clear"><span class="slider_wrapper"><span class="slider-yellow slider11of<?=$revLocation?>0">&nbsp;</span></span>
                    <span class="slider_detail"><strong>Location</strong> - <?=$revLocation?>/5 (<?=$review->getLocationValue($review->getRatingLocation())?>)</span>
                </p>
            @endif

            @if ($revPaperwork)
                <p class="clear"><span class="slider_wrapper"><span class="slider-yellow slider11of<?=$revPaperwork?>0">&nbsp;</span></span>
                    <span class="slider_detail"><strong>Time on paperwork</strong> - <?=$revPaperwork?>/5 (<?=$review->getPaperworkValue($review->getRatingPaperwork());?>)</span>
                </p>
            @endif
            @if ($revSecurity)
                <p class="clear"><span class="slider_wrapper"><span class="slider-yellow slider11of<?=$revSecurity?>0">&nbsp;</span></span>
                    <span class="slider_detail"><strong>Security</strong> - <?=$revSecurity?>/5 (<?=$review->getSecurityValue($review->getRatingSecurity());?>)</span>
                </p>
            @endif
            @if ($revService)
                <p class="clear"><span class="slider_wrapper"><span class="slider-yellow slider11of<?=$revService?>0">&nbsp;</span></span>
                    <span class="slider_detail"><strong>Service</strong> - <?=$revService?>/5 (<?=$review->getServiceValue($review->getRatingService());?>)</span>
                </p>
            @endif

            @if ($revClean)
                <p class="clear"><span class="slider_wrapper"><span class="slider-yellow slider11of<?=$revClean?>0">&nbsp;</span></span>
                    <span class="slider_detail"><strong>Cleanliness</strong> - <?=$revClean?>/5 (<?=$review->getCleanlinessValue($review->getRatingCleanliness());?>)</span>
                </p>
            @endif
            <p class="clear"><br/><strong>Recommended:</strong> <?=$review->getRatingRecommended() ? 'Yes' : 'No'?></p>
        @endif
    </div>
    <div class="clearfix"></div>
</div>
@endforeach

{{-- if de InternetReviews--}}
@elseif (isset($internetReviews))
    <h2 class="clear" id="reviews">Online Reviews of {{$facilityTitle}}</h2>
    <div>
        <div class="rating-stars online">
            @for($starIterator=0; $starIterator<5; $starIterator++)
                @if($starIterator < floor($numStarsRounded))
                    <i class="icon-star review-star"></i>
                @elseif($starIterator < floor($numStarsRounded*2)/2)
                    <i class="icon-star-half review-star"></i>
                @else
                    <i class="icon-star-empty review-star"></i>
                @endif
            @endfor
        </div>
        <div>Average Online Review</div>
        <span class="rating">{{$numStarsRounded()}}</span> out of 5 stars<br />
        <span>This is an average review pulled from various websites including Google, Yelp, CitySearch and others</span>
    </div>
@endif
