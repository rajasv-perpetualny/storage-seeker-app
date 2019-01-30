<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><?=$bookingTileTitle?></h3>
    </div>

    <div class="panel-body">

        {!! Form::open( ['url' => config('host') . '/unit/reservation/' . $unit->space->spaceId, 'method' => 'post', 'id' => 'booking-form'] ) !!}
            <input type="hidden" name="doReservation" value="1" />
            <input type="hidden" name="originalUnit" value="<?=$unit->space->spaceId?>" />
            <input type="hidden" name="takeDeposit" value="0" />


            <ul>
                <?
                foreach($bullets as $bullet) {
                    echo '<li>'.$bullet.'</li>';
                }
                ?>
            </ul>

            <p><strong><?= ($unit->space->promotion && $unit->space->promotion!= $unit->facility->promotion) ? $unit->space->promotion :'' ?></strong></p>

            <div class="listing-unit-wrapper clear">
                <div itemprop="makesOffer" itemscope itemtype="//schema.org/Offer">
                  <div itemprop="itemOffered" itemscope itemtype="//schema.org/Product" class="listing-unit-details">

                    <? if($unit->space->type=='Wine Storage'){ ?>
                        <img itemprop="image" src="/storage/images/size-guide/unitwine-thumb.png" width="50" alt="" />
                    <? }elseif($unit->space->type=='Parking' && $unit->getCovered()){ ?>
                        <img itemprop="image" src="/storage/images/size-guide/unitparking-thumb.png" width="50" alt="" />
                    <? }elseif($unit->space->type=='Parking'){ ?>
                        <img itemprop="image" src="/storage/images/size-guide/unitparkingoutdoor-thumb.png" width="50" alt="" />
                    <? }elseif($unit->space->type=='Locker'){ ?>
                        <img itemprop="image" src="/storage/images/size-guide/unitlocker-thumb.png" width="50" alt="" />
                    <? }elseif($unit->space->type=='Workspace'){ ?>
                        <img itemprop="image" src="/storage/images/size-guide/unitworkspace-thumb.png" width="50" alt="" />
                    <? }elseif($unit->space->type=='Unit'){ ?>
                        <img itemprop="image" src="/storage/images/size-guide/unit{{$unit->squarefoot}}sqft-thumb.png" width="50" alt="" />
                    <? } ?>

                    <div class="listing-unit-amenities">
                        <div>
                            <p class="listing-unit-size"><span itemprop="name"><?=$unit->space->dimensions?> <?=$unit->space->type?></span></p>
                            <br />
                            <ul>
                            <? foreach($unit->space->amenities as $tag){ ?>
                                <li><span itemprop="description"><?=$tag?></span></li>
                            <? } ?>
                            </ul>
                        </div>
                    </div>
                  </div>
                    <div class="listing-unit-pricing">
                        <? if($unit->space->price < $unit->space->regularPrice){ ?>
                            <del>$<?=$unit->space->regularPrice?></del><br />
                            <span itemprop="price" class="price price-highlight">$<?=$unit->space->price?></span><br />
                            <meta itemprop="priceCurrency" content="USD" />
                            <meta itemprop="businessFunction" content="//purl.org/goodrelations/v1#LeaseOut" />
                            <span>per month</span><br />
                            <span class="unit-special">Exclusive!</span>
                        <? }else{ ?>
                            <span class="price">$<?=$unit->space->regularPrice?></span><br />
                            <span>per month</span><br />
                        <? } ?>
                        <span itemprop="availability" href="//schema.org/InStock">In Stock</span>
                    </div>
                    <div class="clear"></div>
                    <div id="select_other_unit">&raquo; <a href="#units" class="js-show-tab">Choose a Different Unit Size</a></div>
                </div>
            </div>

            <div class="form-group{{old('first_name') ? ' error': null}}">
                <label class="control-label" for="first-name">First Name</label>
                <div class="controls">
                    <input type="text" id="first-name" name="first_name" value="{{old('first_name')}}" class="form-control" />
                </div>
            </div>

            <div class="form-group{{old('last_name') ? ' error': null}}">
                <label class="control-label" for="last-name">Last Name</label>
                <div class="controls">
                    <input type="text" id="last-name" name="last_name" value="{{old('last_name')}}" class="form-control" />
                </div>
            </div>

            <div class="form-group{{old('email') ? ' error': null}}">
                <label class="control-label" for="email">Email Address</label>
                <div class="controls">
                    <input type="text" id="email" name="email" value="{{old('email')}}" class="form-control" />
                </div>
            </div>

            <div class="form-group{{old('phone') ? ' error': null}}">
                <label class="control-label" for="phone">Phone Number</label>
                <div class="controls">
                    <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="form-control" />
                </div>
            </div>

            <? if (isset($unit->facility->aaa) && $unit->facility->aaa == "true"){ ?>
                <div class="form-group{{old('aaa_member_number') ? ' error': null}}">
                    <label class="control-label" for="aaa-member-number">AAA Member Number</label>
                    <div class="controls">
                        <input type="text" class="form-control" id="aaa-member-number" name="aaa_member_number" value="{{old('aaa_member_number')}}" autocomplete="off" maxlength="16" />
                    </div>
                    <div>
                        <p>A valid AAA membership card matching the name on this reservation must be presented at the facility to receive the discount.</p>
                    </div>
                </div>
            <? } ?>

            <fieldset>

                <div class="form-group{{old('move_in_date') ? ' error': null}}">
                    <label for="move-in-date">Planned Start Date</label>
                    <div>
                        <input type="text" class="form-control" id="move-in-date" name="move_in_date" min="<?=date('Y-m-d')?>" max="<?=date('Y-m-d', $unit->space->maxReservableDate)?>" value="{{old('move_in_date')}}" autocomplete="off" placeholder="MM/DD/YYYY" />
                    </div>
                </div>
            </fieldset>

            <div id="book-button-container">
                <input onclick="" id="hold-button" type="submit" class="btn btn-lg btn-block btn-primary js-btn-loader" value="Hold Now" />
            </div>

            <p class="legalese clear"><br />No obligation to rent. Leasing this space is month-to-month, with no long term commitment. By clicking to reserve this unit, you agree to our <a href="{{ config('app.terms_of_use_url') }}" class="legal-link">Terms of Service</a>.</p>
            <div class="clear"></div>
        {!! Form::close() !!}
    </div>
</div>
