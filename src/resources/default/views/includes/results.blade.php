@php
    if($source=='ajax' && count($result)>0){
        ob_start();
        $response['json'] = ''.$markers;
    }
@endphp
@foreach($result as $item)
    <li class="facility" id="facility-{{$item->facilityId}}" data-facility-id="{{$item->facilityId}}" data-lat="{{$item->latitude}}" data-lng="{{$item->longitude}}" data-distance="{{$item->distance}}">
            <div class="facility-wrapper">
                <div class="image">
                    <div class="crop">
                        <a href="{{config('host')}}/self-storage/{{$pageData->state}}/{{str_slug(strtolower($city), "-")}}/{{str_slug($item->name, "-")}}/{{$item->facilityId}}" >
                            @if($item->image)
                                <img src="{{$item->image}}" alt="{{$item->name}}" />
                            @else
                                <img src="/storage/images/1581825550f1905fcf3.jpg" alt="noPhoto" />
                            @endif
                        </a>
                    </div>
                </div>
                <div class="details">
                    <div class="details-wrapper">
                        <h3 class="title"><a id="facility-title-{{$item->facilityId}}" href="{{config('host')}}/self-storage/{{$pageData->state}}/{{str_slug(strtolower($city), "-")}}/{{str_slug($item->name, "-")}}/{{$item->facilityId}}">{{$item->name}}</a></h3>
                        <p class="address">{{ $item->address }}, {{ $item->city }}, {{ $item->state }}, {{ $item->zip }}</p>
                        <p class="distance">{{ $item->distance }} miles away</p>
                        <p class="info-links">
                            <!--suppress HtmlUnknownAnchorTarget -->
                            <span class="call-now">
                    <a><i></i><span> Call Now</span></a>
                </span>
                        </p>
                    </div>
                    <div class="rating">
                        @if($item->numRatings)
                        <p class="stars">
                            @for($starIterator=0; $starIterator<5; $starIterator++)
                                @if($starIterator < floor($item->averageRating))
                                    <i class="icon-star review-star"></i>
                                @elseif($starIterator < floor($item->averageRating*2)/2)
                                    <i class="icon-star-half review-star"></i>
                                @else
                                    <i class="icon-star-empty review-star"></i>
                                @endif
                            @endfor
                        </p>
                        <p class="reviews"
                           data-average="{{$item->averageRating}}"
                           data-number="{{$item->numRatings}}" >
                            <a href="{{config('host')}}/self-storage/{{$pageData->state}}/{{str_slug(strtolower($city), "-")}}/{{str_slug($item->name, "-")}}/{{$item->facilityId}}#reviews"> See all {{$item->numRatings}} reviews </a></p>
                        @else
                        Be the first to <a href="{{config('host')}}/self-storage/{{$pageData->state}}/{{str_slug(strtolower($city), "-")}}/{{str_slug($item->name, "-")}}/{{$item->facilityId}}#reviews"> leave a review</a>
                        @endif
                    </div>
                </div>
                <div class="stack">
                    <ul>
<?php
$spaces = [
    'smallUnit' => is_object($item->smallUnit) ? $item->smallUnit->id : 0,
    'mediumUnit' => is_object($item->mediumUnit) ? $item->mediumUnit->id : 0,
    'largeUnit' => is_object($item->largeUnit) ? $item->largeUnit->id : 0
];

$url = config('host').'/self-storage/'.$pageData->state.'/'.str_slug(strtolower($city), "-").'/'.str_slug($item->name, "-").'/'.$item->facilityId;

?>
                        @includeWhen(!in_array($item->primaryUnit->id, $spaces), 'includes.stackedUnit', ['unit' => $item->primaryUnit, 'class' => 'recommended', 'maxReservableDate' => $item->primaryUnitReservableDate, 'url' => $url])
                        @if($spaces['smallUnit'] != 0)
                        @include('includes.stackedUnit', ['unit' => $item->smallUnit, 'class' => "5' x 5'", 'maxReservableDate' => $item->smallUnitReservableDate, 'url' => $url])
                        @endif
                        @if($spaces['mediumUnit'] != 0)
                        @include('includes.stackedUnit', ['unit' => $item->mediumUnit, 'class' => "5' x 10'", 'maxReservableDate' => $item->mediumUnitReservableDate, 'url' => $url])
                        @endif
                        @if($spaces['largeUnit'] != 0)
                        @include('includes.stackedUnit', ['unit' => $item->largeUnit, 'class' => "10' x 10'", 'maxReservableDate' => $item->largeUnitReservableDate, 'url' => $url])
                        @endif
                    </ul>
                </div>
            </div>
            <div class="view-more-btn btn btn-primary">
                <a href="{{config('host')}}/self-storage/{{$pageData->state}}/{{str_slug(strtolower($city), "-")}}/{{str_slug($item->name, "-")}}/{{$item->facilityId}}">View More Units</a>
            </div>

        </li>
@endforeach
@php
    if($source=='ajax' && count($result)>0){
        $response['html'] = ob_get_contents();
        ob_end_clean();
        echo json_encode($response);
    }
@endphp
