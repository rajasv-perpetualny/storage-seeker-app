@extends('layout')
@section('content')
    <main>
        <div class="facility">
            <div class="primary">
                <div class="details">
                    <h1>{{ $result->name }}</h1>
                    <div>
                <span class="address">
                    {{ $result->address }}
                    , {{ $result->city }}
                    , {{ $result->state }}
                    {{ $result->zip }}
                </span>
                        @if($result->showPhoneNumber)
                        <span class="phone"><span class="glyphicon glyphicon-phone-alt"></span> <span id="facility-phone-number">{{ config('site.' . config('domain') . '.phone') }}</span></span>
                        @endif
                    </div>

                    <div class="rating">
                        @if($reviews->numRatings)
                            <div class="stars">
                                @for($starIterator=0; $starIterator<5; $starIterator++)
                                    @if($starIterator < floor($reviews->averageRating))
                                        <i class="icon-star review-star"></i>
                                    @elseif($starIterator < floor($reviews->averageRating*2)/2)
                                        <i class="icon-star-half review-star"></i>
                                    @else
                                        <i class="icon-star-empty review-star"></i>
                                    @endif
                                @endfor
                                <p class="reviews"
                                   data-average="{{$reviews->averageRating}}"
                                   data-number="{{$reviews->numRatings}}" >
                                    <a href="#reviews"> See all {{$reviews->numRatings}} reviews </a></p>
                            </div>
                        @else
                            Be the first to <a href="#reviews"> leave a review</a>
                        @endif
                    </div>
                    <div class="demand-banner">
                      <div class="icon">
                        <img src="{{ url('/storage/images/ic_clock.svg') }}" alt="Book Now" title="Book Now" class="value-prop-image" width="37" height="37"/>

                      </div>
                      <div class="copy">
                        <p>
                          We are experiencing high demand in this area.<br/>
Make sure you reserve a unit for free today to hold a storage space.
                        </p>
                      </div>
                    </div>
                </div>
                <div class="units">
                    @if ($result->live == "true" && $facilityUnitGroupsByType)
                    <ul>
                        @foreach($facilityUnitGroupsByType as $key=>$unit)
                        <li data-unit-id="{{ $unit->spaceId }}">
                            @include('includes.unitsTab')
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <h2>No Units available for this facility</h2>
                    @endif
                </div>
            </div>
            <div class="secondary">
                <div class="images">
                    <div id="carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($result->images as $i => $image)
                            <li data-target="#carousel" data-slide-to="{{$i}}"<?=($i==0)?' class="active"':''?>></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner" role="listbox">
                            @foreach($result->images as $i => $image)
                            <div class="item {{($i==0) ? ' active' : ''}}">
                                <img src="{{str_replace("medium", "large", $image)}}" alt="Facility photo: {{ $image }}">
                                <div class="carousel-caption">

                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="how-it-works">
                  <div class="how-it-works-header">
                    <h3>How it works</h3>
                  </div>
                  <div class="how-it-works-content">
                    <div class="how-it-works-item">
                      <img src="{{ url('/storage/images/ic_reserve.svg') }}" alt="Reserve" title="Reserve" class="value-prop-image" width="50" height="50"/>
                      <span class="circle-number">1</span>
                      <p>
                        Reserve your<br/>
                        storage unit for free
                      </p>
                    </div>
                    <div class="how-it-works-item">
                      <img src="{{ url('/storage/images/ic_facility.svg') }}" alt="Facility" title="Facility" class="value-prop-image" width="50" height="50"/>
                      <span class="circle-number">2</span>
                      <p>
                      Visit the facility to finalize the rental
                      </p>
                    </div>
                    <div class="how-it-works-item">
                      <img src="{{ url('/storage/images/ic_move.svg') }}" alt="Move" title="Move" class="value-prop-image" width="50" height="50"/>
                      <span class="circle-number">3</span>
                      <p>Move-in!</p>
                    </div>
                  </div>
                </div>
                <div class="hours">
                    <h2>Operating Hours</h2>
                    <div class="office">
                        <h3>Office</h3>
                        <table>
                            <tbody>
                                @foreach($result->officeHours as $oneOf)
                                    <tr>
                                        <th>{{substr($oneOf, 0, 3)}}</th>
                                        <td>{{strtolower(substr($oneOf, 5, strlen($oneOf) - 5))}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="access">
                        <h3>Unit Access</h3>
                        <table>
                            <tbody>
                            @foreach($result->accessHours as $oneOf)
                                <tr>
                                    <th>{{substr($oneOf, 0, 3)}}</th>
                                    <td>{{strtolower(substr($oneOf, 5, strlen($oneOf) - 5))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="amenities">
                    <h2>Features and Amenities</h2>
                    <ul>
                        @foreach($result->amenities as $amenity)
                        <li><i></i>{{html_entity_decode(str_replace('("null")','', $amenity))}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="info">
                    <h2>Additional information</h2>
                    <p>{{ $result->description }}</p>
                </div>
            </div>
        </div>
        <div id="reviews" data-rpp="{{ $reviews->perPage() }}">
            <div id="review-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="review-form-title">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="review-form-title">Post A Review</h3>
                        </div>
                        <div class="modal-body">
                            @include('includes.reviewForm')
                        </div>
                    </div>
                </div>
            </div>
            <div class="reviews-control">
                <h2>Customer Reviews</h2>
                <div class="review-btn-wrapper">
                    <a href="#review-form" class="leave-a-review" data-toggle="modal" data-target="#review-form" >Leave a review</a>
                </div>
                <div id="loadReviews" style="position: relative;">
                    @include('includes.reviewsSection')
                </div>
            </div>
        </div>

        <div id="consumerlead-form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="review-form-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title" id="review-form-title">Get Facility Hours and Directions</h3>
                    </div>
                    <div class="modal-body">
                        {-- include 'CafeBundle::consumerlead-form.html.twig' with {"form": consumerLeadForm} --}
                    </div>
                </div>
            </div>
        </div>
        @include('includes.backToTop')
    </main>
@endsection
