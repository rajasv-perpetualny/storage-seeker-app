@if(empty($unit) || is_null($unit))
<li class="scarcity"> No {{$class}} units available.</li>
@else
<li class="unit {{$class}}">
    <div class="description">
        <a id="facility-unit-description-{{$unit->id}}" href="{{$url}}/unit/{{$unit->id}}">
            {{$unit->width}}'
            @if(!($unit->type=="Parking" && $unit->depth==0)) &nbsp;x&nbsp; {{$unit->depth}}' @endif
            &nbsp; {{$unit->type}}
        </a>
    </div>
    @if (date($maxReservableDate) >= date('-2days'))
        <div class="price">
          @if($unit->sparefootPriceParsed < $unit->priceParsed )
          <a id="facility-unit-price-{{$unit->id}}" href="{{$url}}/unit/{{$unit->id}}">${{ number_format( $unit->sparefootPriceParsed, 2) }}</a>
          @else
            <a id="facility-unit-price-{{$unit->id}}" href="{{$url}}/unit/{{$unit->id}}">${{ number_format( $unit->priceParsed, 2) }}</a>
          @endif
        </div>
        @if(!empty($unit->promotion))
        <div class="description promotion">
            <a id="facility-unit-promotion-{{$unit->id}}" href="{{$url}}/unit/{{$unit->id}}">{{$unit->promotion}}</a>
        </div>
        @endif
        @if($unit->sparefootPriceParsed < $unit->priceParsed )
          <div class="price">
            <del><a id="facility-unit-price-{{$unit->id}}-striked" href="{{$url}}/unit/{{$unit->id}}">${{ number_format( $unit->priceParsed, 2) }}</a></del>
          </div>
        @endif
    @else
    <div class="out-of-range">
        <a id="facility-unit-outofrange-{{$unit->id}}" href="{{$url}}/unit/{{$unit->id}}">Out of date range.</a>
    </div>
    @endif
</li>
@endif
