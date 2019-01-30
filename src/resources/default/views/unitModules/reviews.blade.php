<h4>Help your fellow storage searchers make the right choice!</h4>

    <img class="pull-left chuck_review" src="/storage/images/chuck-reviews.png">
    <p>&quot;Reviews from previous tenants help others find self-storage more quickly and confidently. If you like reading reviews, leaving one yourself is just good karma. Please take a moment to share your storage story, and think of all the future tenants you'll help guide in the right direction. Thanks!&quot;<br/>
    <em>- Chuck, SpareFoot CEO</em></p>
    <p>
        <strong>P.S. Want $250? Leave a review to enter our monthly drawing for a $250 Amazon gift card. </strong> <a data-toggle="modal" href="#review-drawing-modal" target="_blank">Eligibility details.</a>
    </p>

<div id="review-drawing-modal" class="modal fade">
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

<p class="leave-review-link"><a href="#reviews" class="js-show-review-form">Leave a review of <?=$unit->facility->name?></a></p>

<? if($unit->facility->numRatings) {
		$x = 0;
?>

            <h4><?=$unit->facility->numRatings?> Customer Reviews of this Facility</h4>
            <? //$reviews = $this->_facilityService->getReviews($facility);   ?>
                
    <?
        \Debugbar::info($reviews);
        foreach ($reviews->facilityReviews as $review) {
            
    		$x++;
    ?>
        <div itemprop="review" itemscope itemtype="//schema.org/Review" class="sf-review">
            
            <div class="about-review">
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
                <span class="rating-written-out" itemprop="reviewRating" itemscope itemtype="//schema.org/Rating">
                    <meta itemprop="worstRating" content = "1">
                    <span class="rating" itemprop="ratingValue"><?=$review->rating?></span> out of
                    <span itemprop="bestRating">5</span> stars
                </span>
                <div class="reviewer" itemprop="author"><?=wordwrap($review->nickname, 15, '<br />', true)?></div>
                <meta itemprop="datePublished" content="<?=date("Y-m-d", strtotime($review->timestamp))?>"><?=date("M. j, Y", strtotime($review->timestamp))?>
            </div>
            
            <div class="review-body">
                    <p><span class="summary"><strong><?=$review->title?></strong></span><br /> <span itemprop="description" class="description"><?=$review->review?></span></p>
            </div>
            <div class="clear"></div>
        </div>
    <? } ?>
<? } ?>
