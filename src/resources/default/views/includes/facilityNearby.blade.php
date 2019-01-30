<div class="facilities-nearby">
    @if(count($facilitiesNearby) > 0)

    <div class="panel panel-default panel-nearby-facilities">
        <div class="panel-heading">
            <h4 class="panel-title">Nearby Storage Facilities</h4>
        </div>
        <table class="table">
            <?  foreach($facilitiesNearby as $facility) { ?>
            <tr>
                <td>
                    <?
                    if($facility->image){ ?>
                    <a href="{{config('host')}}/facility/{{$facility->facilityId}}">
                        <img src="{{$facility->image}}" alt="{{$facility->city}} self storage from {{$facility->name}}" /></a>
                    <? }else{ ?>
                    <img src="/storage/images/default-facility.gif')?>" width="100" height="75" alt="<?=$facility->name?>" />
                    <? } ?>
                </td>
                <td>
                    <h5><a href="{{config('host')}}/facility/{{$facility->facilityId}}">{{$facility->name}}</a></h5>
                    <span>{{$facility->address}}</span><br />
                    <span>{{$facility->city}}</span>, <abbr title="{{$facility->state}}"></abbr> <span>{{$facility->zip}}</span>
                    <br />
                   <?if($facility->numRatings > 0 ){ ?>
                    <? $numReviews = $facility->numRatings;
                    $averageReview = $facility->averageRating;

                    ?>
                    <div class="rating-stars">
                    @for($starIterator=0; $starIterator<5; $starIterator++)
                        @if($starIterator < floor($averageReview))
                            <i class="icon-star review-star"></i>
                        @elseif($starIterator < floor($averageReview*2)/2)
                            <i class="icon-star-half review-star"></i>
                        @else
                            <i class="icon-star-empty review-star"></i>
                        @endif
                    @endfor
                    </div>
                    <a href="{{config('host')}}/facility/{{$facility->facilityId}}#reviews">
                        <span><?=$numReviews?> review<?=($numReviews>1)?'s':''?></span>
                    </a>
                    <? } ?>

            <? } ?>
                </td>
            </tr>
        </table>
    </div>
   @endif
</div>