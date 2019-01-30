{!! Form::open( ['url' => config('host') ."/facility/$result->id/review", 'method' => 'post', 'name' => 'review', 'id' => 'send-review-form'] ) !!}
<div class="ratings">
    <div class="overall-rating">
        <p><strong>Overall rating (1-5 stars)</strong></p>
        <div class="rating-widget" data-field="rating" >
            <div class="star">
                <div data-rating="0.5" class="star-left" ></div>
                <div data-rating="1" class="star-right" ></div>
            </div>
            <div class="star">
                <div data-rating="1.5" class="star-left" ></div>
                <div data-rating="2" class="star-right" ></div>
            </div>
            <div class="star">
                <div data-rating="2.5" class="star-left" ></div>
                <div data-rating="3" class="star-right" ></div>
            </div>
            <div class="star">
                <div data-rating="3.5" class="star-left" ></div>
                <div data-rating="4" class="star-right" ></div>
            </div>
            <div class="star">
                <div data-rating="4.5" class="star-left" ></div>
                <div data-rating="5" class="star-right" ></div>
            </div>
        </div>

    </div>
</div>

    <div id="review"><input type="hidden" id="review_facilityId" name="facilityId" value="{{$result->id}}" />
        <input type="hidden" id="review_rating" name="rating" />
        <div class="form-group"><label class="control-label required" for="review_title">One-line summary</label>
            <input type="text" id="review_title" name="title" required="required" class="form-control" /></div>
        <div class="form-group"><label class="control-label required" for="review_message">Review</label>
            <input type="text" id="review_message" name="message" required="required" class="form-control" />
        </div><div class="form-group"><label class="control-label required" for="review_nickname">Your name</label>
            <input type="text" id="review_nickname" name="nickname" required="required" class="form-control" />
        </div>
        <div class="form-group"><label class="control-label required" for="review_email">Your email address</label>
            <input type="text" id="review_email" name="email" required="required" class="form-control" />
        </div>
        <div class="form-group"><button type="submit" id="review_submit" name="review_submit" class="btn-default btn">Submit</button>
        </div>
    </div>
{!! Form::close() !!}