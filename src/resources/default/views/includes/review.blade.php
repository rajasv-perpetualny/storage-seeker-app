<div class="review">
    <div class="about">
        <p class="stars">
            <div class="rating-stars">
                <?php for($starIterator=0; $starIterator<5; $starIterator++){
                    if($starIterator < floor($review->rating)){
                        echo '<i class="icon-star review-star"></i>';
                    } elseif($starIterator < floor($review->rating*2)/2) {
                        echo '<i class="icon-star-half review-star"></i>';
                    } else {
                        echo '<i class="icon-star-empty review-star"></i>';
                    }
                } ?>
            </div>
        </p>
        <p class="rating-text"><span class="value">{{ $review->rating }}</span> of 5 stars</p>
        <p class="nickname">{{ wordwrap($review->nickname, 15, '<br />', true) }}</p>
        <p class="date">{{ date("F jS, Y",strtotime($review->timestamp)) }}</p>
    </div>
    <div class="body">
        <div class="review-copy">
            <p class="title">{{ $review->title }}</p>
            <p class="message">{{ $review->review }}</p>
        </div>
    </div>
</div>