<div class="unit">
    <div class="details">
        <div class="details-table">
            <div class="icon">
                @if($unit->type=='Wine Storage')
                <img src="/storage/images/unit100sqft-thumb.png" width="100" alt="" />
                @elseif(strpos($unit->type, 'Parking') !== false)
                <img src="/storage/images/unitparking-thumb.png" width="100" alt="" />
                @elseif($unit->type=='Locker')
                <img src="/storage/images/unit100sqft-thumb.png" width="100" alt="" />
                @elseif($unit->type=='Workspace')
                <img src="/storage/images/unit100sqft-thumb.png" width="100" alt="" />
                @elseif($unit->type=='Unit')
                <img src="/storage/images/unit{{$unit->squarefoot}}sqft-thumb.png" width="100" alt="{{$unit->dimensions}}" />
                @endif
            </div>
            <div class="unit-details">
                <h3 class="size">{{$unit->dimensions}} {{$unit->type}}</h3>
                <p class="features">{{ implode(', ', \App\Models\Unit::getUnitAmenities($unit->amenities)) }}</p>
                @if(!empty($unit->promotion))
                <p class="special">{{$unit->promotion}}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="price">
        <div class="discount">
            <h4>Discount Price</h4>
            <h5>${{ $unit->price }}</h5>
        </div>
        @if($unit->regularPrice > $unit->price)
        <div class="regular">
            <h4>Regular Price</h4>
            <h5><del>${{ $unit->regularPrice }}</del></h5>
        </div>
        @endif
    </div>
    <div class="link">
        <a id="unit-continue-{{$unit->spaceId}}" href="{{config('host')}}/unit/{{$unit->spaceId}}" id="unit-{{$unit->spaceId}}">continue</a>
    </div>
</div>
