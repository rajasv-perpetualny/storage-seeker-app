@if(count($facilityReviews))
    @php
        $x = 0;
    @endphp
    <div id="reviews-slideshow">
        @foreach($facilityReviews as $review)
        @php
        $x++;
        if (isset($facilityReviewsCountToDisplay) && $x > $facilityReviewsCountToDisplay)
            break;
        @endphp
        <div class="review-block">
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
                </div>
                <div class="clear"></div>
            </div>
        </div>
        @endforeach
    </div>

    @if(count($facilityReviews) > 1)
        <a href="#" id="prev"><img src="/images/arrow-prev.png" /></a>
        <a href="#" id="next"><img src="/images/arrow-next.png" /></a>
    @endif
@endif