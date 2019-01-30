@if(empty($unit) || is_null($unit))
<li class="scarcity"> No {{$class}} units available.</li>
@else
<li class="unit {{$class}}">
    <div class="description">
        <a id="facility-unit-description-{{$unit->id}}" href="{{config('host')}}/unit/{{$unit->id}}">
            {{$unit->width}}'
            @if(!($unit->type=="Parking" && $unit->depth==0)) &nbsp;x&nbsp; {{$unit->depth}}' @endif
            &nbsp; {{$unit->type}}
        </a>
    </div>
    @if (date($maxReservableDate) >= date('-2days'))
        <div class="price">
            <a id="facility-unit-price-{{$unit->id}}" href="{{config('host')}}/unit/{{$unit->id}}">${{ number_format( $unit->sparefootPriceParsed < $unit->priceParsed ? $unit->sparefootPriceParsed :  $unit->priceParsed, 2) }}</a>
        </div>
        @if(!empty($unit->promotion))
        <div class="promotion">
            <a id="facility-unit-promotion-{{$unit->id}}" href="{{config('host')}}/unit/{{$unit->id}}">{{$unit->promotion}}</a>
        </div>
        @endif
    @else
    <div class="out-of-range">
        <a id="facility-unit-outofrange-{{$unit->id}}" href="{{config('host')}}/unit/{{$unit->id}}">Out of date range.</a>
    </div>
    @endif
</li>
@endif
