<? if(is_array($unit->facility->spaces)) { ?>
    <div id="units" class="ui-tabs-panel">
    
        <h4>Available Units</h4>

            <? foreach($unit->facility->spaces as $space){ ?>

                <div class="listing">
    
                    <? if($space->type=='Wine Storage'){ ?>
                        <img src="/storage/images/size-guide/unitwine-thumb.png" width="100" alt="" />
                    <? }elseif(strpos($space->type, 'Parking') !== false && in_array('Covered', $space->amenities)){ ?>
                        <img src="/storage/images/size-guide/unitparking-thumb.png" width="100" alt="" />
                    <? }elseif(strpos($space->type, 'Parking') !== false){ ?>
                        <img src="/storage/images/size-guide/unitparkingoutdoor-thumb.png" width="100" alt="" />
                    <? }elseif($space->type=='Locker'){ ?>
                        <img src="/storage/images/size-guide/unitlocker-thumb.png" width="100" alt="" />
                    <? }elseif($space->type=='Workspace'){ ?>
                        <img src="/storage/images/size-guide/unitworkspace-thumb.png" width="100" alt="" />
                    <? }elseif($space->type=='Unit'){ ?>
                        <img src="/storage/images/size-guide/unit{{$unit->getSquareFootageClass($space->dimensions)}}sqft-thumb.png" width="100" alt="" />
                    <? } ?>
    
                    <div class="listing-unit-details clearfix">
                        <div class="listing-unit-amenities">
                            <div>
                                <p class="listing-unit-size"><?=$space->dimensions?> <?=$space->type?></p>
                                <ul>
                                <? foreach($space->amenities as $tag){ ?>
                                    <li><span><?=$tag?></span></li>
                                <? } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="listing-unit-pricing">
                            <? if($space->price < $space->regularPrice){ ?>
                                <del>$<?=$space->regularPrice?></del><br />
                                <span class="price price-highlight">$<?=$space->price?></span><br />
                                <span>per&nbsp;month</span><br />
                                <span class="unit-special">Online Special!</span>
                            <? } else { ?>
                                <span class="price">$<?=$space->price?></span><br />
                                <span>per&nbsp;month</span><br />
                                <span class="unit-special"></span>
                            <? } ?>
                        </div>
                        <div class="listing-unit-select pull-right">
                            <a href="{{config('host')}}/unit/{{$space->spaceId}}" id="unit-<?=$space->spaceId?>" class="btn btn-primary btn-large">Reserve</a>
                        </div>
                    </div>
                    
                </div>
        <? } ?>
    </div>
<? } ?>
