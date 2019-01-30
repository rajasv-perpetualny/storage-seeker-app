<div id="review-form">
    <div id="review-form-content">
        {!! Form::open( ['url' => config('host') . '/facility/' . $unit->facility->id . '/review', 'method' => 'post', 'id' => 'send-review-form', 'class' => 'form-horizontal'] ) !!}
            <a name="review-form"></a>
            <input type="hidden" name="facility_id" id="facility_id" value="<?=$unit->facility->id?>"/>

            <h4>Rate and review</h4>

            <div class="control-group">
                <label class="control-label">Overall rating (1-5 stars)</label>
                <div class="controls">
                    <input id="review05" type="radio" class="star {split:2}" name="rating" value="0.5" />
                    <input id="review10" type="radio" class="star {split:2}" name="rating" value="1" />
                    <input id="review15" type="radio" class="star {split:2}" name="rating" value="1.5" />
                    <input id="review20" type="radio" class="star {split:2}" name="rating" value="2" />
                    <input id="review25" type="radio" class="star {split:2}" name="rating" value="2.5" />
                    <input id="review30" type="radio" class="star {split:2}" name="rating" value="3" />
                    <input id="review35" type="radio" class="star {split:2}" name="rating" value="3.5" />
                    <input id="review40" type="radio" class="star {split:2}" name="rating" value="4" />
                    <input id="review45" type="radio" class="star {split:2}" name="rating" value="4.5" />
                    <input id="review50" type="radio" class="star {split:2}" name="rating" value="5" />
                    <span class="rating_hint2" id="rating_overall"></span>
                </div>
            </div>
            <br />

            <h2>Tell Your Storage Story</h2>
            
            <div class="control-group">
                <label class="control-label">One-line summary</label>
                <div class="controls">
                    <input type="text" class="form-control" name="title" id="title" size="39" />
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">Review</label>
                <div class="controls">
                    <textarea class="form-control" name="message" id="message" rows="7" cols="40"></textarea>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">Your name</label>
                <div class="controls">
                    <input type="text" class="form-control" name="nickname" id="nickname" size="39" />
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label">Your email address</label>
                <div class="controls">
                    <input type="email" class="form-control" name="review-email" id="review-email" size="39" value=""/>
                    <input type="text" name="email_address" class="hide" id="email_address" value="" size="39" />
                    <p><label for="review-tos" class="checkbox"><input type="checkbox" id="review-tos" name="tos" /> By submitting this review, I acknowledge and agree to the <a href="https://www.sparefoot.com/legal/reviewstoc.html"/>Review Terms and Conditions</a>. In doing so, I certify that this review reflects my honest opinion and is based on a real experience with the facility. I further certify that I have no relationship with this facility, and have not been offered any compensation by the facility to write this review. I understand that submitting a fraudulent review is a serious violation of our Review Terms and Conditions and may be prohibited by law in your jurisdiction. <a href="//ftc.gov/os/2009/10/091005revisedendorsementguides.pdf">Learn more.</a></label></p>
                </div>
            </div>

            <div class="form-actions">
                <input id="review-submit" type="submit" value="Submit Review" class="btn btn-primary btn-large">
            </div>

        {!! Form::close() !!}
    </div>
</div>