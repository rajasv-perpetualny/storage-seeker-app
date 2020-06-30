@php
    if($source=='ajax' && count($result)>0){
        ob_start();
        $response['json'] = ''.$markers;
    }
@endphp
@foreach($result as $item)
    <div class="popular-facility" id="facility-{{$item->facilityId}}" data-facility-id="{{$item->facilityId}}" data-lat="{{$item->latitude}}" data-lng="{{$item->longitude}}" data-distance="{{$item->distance}}">
            <div class="facility-wrapper">
              <div class="facility-top">
                <div class="image">
                    <div class="crop">
                        <a href="{{config('host')}}/self-storage/{{$pageData->slug}}/{{str_slug($item->city, '-')}}/{{str_slug($item->name, '-')}}/{{$item->facilityId}}" >
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
                        <h2 class="title"><a id="facility-title-{{$item->facilityId}}" href="{{config('host')}}/self-storage/{{$pageData->slug}}/{{str_slug($item->city, '-')}}/{{str_slug($item->name, '-')}}/{{$item->facilityId}}">{{$item->name}}</a></h2>
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
                            @else
                            Be the first to <a href="{{config('host')}}/self-storage/{{$pageData->slug}}/{{str_slug($item->city, '-')}}/{{str_slug($item->name, '-')}}/{{$item->facilityId}}#reviews"> leave a review</a>
                            @endif
                        </div>
                        <p class="address">{{ $item->address }}</p>
                        <p class="distance">{{ $item->distance }} miles away</p>
                    </div>
                </div>
              </div>
              <div class="action-row">
                <div class="action-item">
                  <span class="call-now">
                      <a><i></i><span> Call Now</span></a>
                  </span>
                </div>
                <div class="action-item">

                      <a href="{{config('host')}}/self-storage/{{$pageData->slug}}/{{str_slug($item->city, '-')}}/{{str_slug($item->name, '-')}}/{{$item->facilityId}}#reviews"> See Reviews </a>
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
$url = config('host').'/self-storage/'.$pageData->slug.'/'.str_slug(strtolower($item->city), "-").'/'.str_slug($item->name, "-").'/'.$item->facilityId;

?>
                        @includeWhen(!in_array($item->primaryUnit->id, $spaces), 'includes.stackedUnit', ['unit' => $item->primaryUnit, 'class' => 'recommended', 'maxReservableDate' => $item->primaryUnitReservableDate, 'url' => $url])
                        @include('includes.stackedUnit', ['unit' => $item->smallUnit, 'class' => "5' x 5'", 'maxReservableDate' => $item->smallUnitReservableDate, 'url' => $url])
                        @include('includes.stackedUnit', ['unit' => $item->mediumUnit, 'class' => "5' x 10'", 'maxReservableDate' => $item->mediumUnitReservableDate, 'url' => $url])
                        @include('includes.stackedUnit', ['unit' => $item->largeUnit, 'class' => "10' x 10'", 'maxReservableDate' => $item->largeUnitReservableDate, 'url' => $url])
                    </ul>
                </div>
            </div>
            <div class="more ">
                <a class="btn btn-primary" href="{{config('host')}}/self-storage/{{$pageData->slug}}/{{str_slug($item->city, '-')}}/{{str_slug($item->name, '-')}}/{{$item->facilityId}}">View More Units</a>
            </div>
        </div>
@endforeach
@php
    if($source=='ajax' && count($result)>0){
        $response['html'] = ob_get_contents();
        ob_end_clean();
        echo json_encode($response);
    }
@endphp
