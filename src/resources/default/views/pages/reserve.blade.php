@extends('layout')
@section('content')
<div class="content-container container">
    @if($errors->any())
        <div class="alert alert-danger">
            <h3>Oops...</h3>
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif
    @includeWhen(is_object($breadcrumb), 'includes.crumbs', ['breadcrumb' => $breadcrumb])
    <h2>Reserve Unit</h2>
    <div class="row">
        <div class="col-md-8" id="booking-form-container">
            <p>Provide your details below to make a commitment-free reservation.
                You’ll lock in this price at no charge, and we’ll hold the unit for you.
                @if(!isset($no_phone) || $no_phone != true )
                    Cancel or change your reservation anytime by calling us at {{ config('site.' . config('domain') . '.phone') }}.
                @endif
            </p>
            <br />

            {!! Form::open( ['url' => config('host') . "/unit/reservation/" . $unit->space->spaceId, 'method' => 'post', 'id' => 'booking-form'] ) !!}
            {!! Form::hidden('doReservation', '', ['value'=> 1]) !!}
            {!! Form::hidden('takeDeposit', '', ['value'=> 1]) !!}
            <h4>Renter Information</h4>

            <div class="form-horizontal">

                <div class="form-group{{old('first_name') ? ' error': null}}">
                    <label for="first-name" class="col-lg-2 control-label">First Name</label>
                    <div class="col-lg-10">
                        {!! Form::text('first_name', "" ,
                        ['class' => 'form-control', 'id' => 'first-name', 'value' => old('first_name')]
                        ) !!}
                    </div>
                </div>
                <div class="form-group{{old('last_name') ? ' error': null}}">
                    <label for="last-name" class="col-lg-2 control-label">Last Name</label>
                    <div class="col-lg-10">
                        {!! Form::text('last_name', "" ,
                        ['class' => 'form-control', 'id' => 'last-name', 'value' => old('last_name')]
                        ) !!}
                    </div>
                </div>
                <div class="form-group{{old('email') ? ' error': null}}">
                    <label for="email" class="col-lg-2 control-label">Email Address</label>
                    <div class="col-lg-10">
                        {!! Form::email('email', "" ,
                        ['class' => 'form-control', 'id' => 'email', 'value' => old('email')]
                        ) !!}
                    </div>
                </div>
                <div class="form-group{{old('phone') ? ' error': null}}">
                    <label for="phone" class="col-lg-2 control-label">Phone Number</label>
                    <div class="col-lg-10">
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{old('phone')}}" />
                    </div>
                </div>
                @if(isset($unit->facility->aaa) && $unit->facility->aaa == "true")
                <div class="form-group{{old('aaa_member_number') ? ' error': null}}">
                    <label for="aaa-member-number" class="col-lg-2 control-label">AAA Member Number</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="aaa-member-number" name="aaa_member_number" value="{{old('aaa_member_number')}}" autocomplete="off" maxlength="16" />
                    </div>
                    <div class="col-lg-10">
                        <p>A valid AAA membership card matching the name on this reservation must be presented at the facility to receive the discount.</p>
                    </div>
                </div>
                @endif
                <fieldset>

                    <div class="form-group{{old('move_in_date') ? ' error': null}}">
                        <label class="col-lg-2 control-label" for="move-in-date">Planned Start Date</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="move-in-date" name="move_in_date" min="<?=date('Y-m-d')?>" max="<?=date('Y-m-d', $unit->space->maxReservableDate)?>" value="{{old('move_in_date')}}" autocomplete="off" placeholder="MM/DD/YYYY" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <br />
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-sm-6 col-lg-6">
                            {!! Form::submit('Complete Reservation',
                            ['class' => 'btn btn-lg btn-block btn-primary js-btn-loader', 'id' => 'hold-button']
                            ) !!}
                        </div>
                    </div>

                </fieldset>
                <br /><br />
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-4">

        <?php /**   ONLY FOR STORAGE QUOTE <? $this->load->view('cpanw/_unit/modules/discount_reserve.php'); ?> */ ?>

            @if(isset($unit->facility->aaa) && $unit->facility->aaa == "true")
            <div class="aaa-promo2" rel="popover" data-toggle="popover"  data-placement="top" data-trigger="hover"
                 data-content="AAA members get first month free (prorated if facility bills on 1st of<br>every month) + $20 Amazon gift<br>card with SpareFoot.<br><strong>Click the AAA logo to learn more.</strong>">
                <a href="//marketing.sparefoot.com/aaa-discount-terms/"
                   target="_blank"
                   class="sparefoot-click"
                   data-campaign-key="click-test"
                   data-site-id="211"
                >
                    <img class="aaa-banner2" src="/storage/images/aaa-discounts-rewards2.png" alt="AAA discount rewards">
                </a>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Your storage facility</h4>
                </div>
                <div class="panel-body">
                    @if(false) <!-- !$facility->isIntegrated()) -->
                        <img src="< //?=$this->url->getFacilityImageUrl($facility->getImages()->uniqueResult(),'small')?>" alt="< //?=$facility->getTitle()?>" />
                    @elseif(false) <!-- $unit->facility) ->getImages()->uniqueResult()) -->
                        <a href="<? //=$this->url->unitDetailsUrl($unit)?>"><img src="<?//$this->url->getFacilityImageUrl($facility->getImages()->uniqueResult(),'small')?>" alt="<?//=$facility->getTitle()?>" /></a>
                    @endif
                        <div>
                            <div class="adr">
                                <h4 class="fn n">{{$unit->facility->name}}</h4>
                                <span class="street-address">{{$unit->facility->address}}</span><br />
                                <span class="locality">{{$unit->facility->city}}</span>, <abbr class="region" title="{{$unit->facility->state}}">{{$unit->facility->state}}</abbr> <span class="postal-code">{{$unit->facility->zip}}</span> <a href="{{config('host')}}/unit/{{$unit->space->spaceId}}#map">map</a><br />
                                @if(!isset($no_phone) || $no_phone != true )
                                    @if(true) <!-- $facility->displayPpcPhone()) -->
                                        <span class="phone"><? //=$facility->stringPpcPhone()?></span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if($unit->facility->numRatings)
                            @php
                            if('SITE_ID' == 27) {
                                $averageReview = $facility->getAverageReviewBySiteId(SITE_ID,true);
                            } else {
                                $averageReview = $unit->facility->averageRating;
                            }
                            $averageReview = 4;
                            @endphp

                        <div class="rating">
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
                            <p><span class="average">{{$averageReview}}</span> out of <span class="best">5</span></p>
                        </div>
                       @endif

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="pull-right" href="{{config('host')}}/facility/{{$unit->facility->id}}#units">change size</a>
                    <h4 class="panel-title">Your storage unit</h4>
                </div>
                <div class="panel-body listing-unit-wrapper">
                    <div class="listing-unit-details">
                        @if(false) <!-- $unit->stringType()=='Wine Storage'){ ?> -->
                        <img src="/storage/images/size-guide/unitwine-thumb.png" width="50" alt="" />
                        @elseif(true) <!-- $unit->stringType()=='Parking' && $unit->getCovered()) -->
                        <img src="/storage/images/size-guide/unitparking-thumb.png" width="50" alt="" />
                        @elseif(false) // $unit->stringType()=='Parking')
                        <img src="/storage/images/size-guide/unitparkingoutdoor-thumb.png" width="50" alt="" />
                        @elseif(false) <!--$unit->stringType()=='Locker'){ ?> -->
                        <img src="/storage/images/size-guide/unitlocker-thumb.png" width="50" alt="" />
                        @elseif(false) <!--$unit->stringType()=='Workspace'){ ?> -->
                        <img src="/storage/images/size-guide/unitworkspace-thumb.png" width="50" alt="" />
                        @elseif(false) <!-- //$unit->stringType()=='Unit'){ ?> -->
                        <img src="/storage/images/size-guide/unit'.$unit->getSquareFootageClass().'sqft-thumb.png" width="50" alt="" />
                        @endif

                        <div class="listing-unit-amenities">
                            <div>
                                <p class="listing-unit-size">{{$unit->space->dimensions}} {{$unit->space->type}}</p>
                                <ul>
                                    @foreach( $unit->space->amenities as $tag)
                                        <li><span>{{$tag}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="listing-unit-pricing">
                            @if($unit->space->regularPrice > $unit->space->price)
                                <del></del><br />
                                <span class="price price-highlight">${{$unit->space->price}}</span><br />
                                <span>per month</span><br />
                                <span class="unit-special">Exclusive!</span>
                            @else
                                <span class="price">${{$unit->space->regularPrice}}</span><br />
                                <span>per month</span><br />
                            @endif
                        </div>
                        <div class="clear"></div>
                    @if(config('domain') !== 'aaa')
                        @if($unit->space->promotion)
                            <p class="highlight">{{$unit->space->promotion}}</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p class="legalese clear">No obligation to rent. Leasing this space is month-to-month,
                        with no long term commitment. By clicking to reserve this unit, you agree to our
                        <a href="{{ config('app.terms_of_use_url') }}" class="legal-link">Terms of Service</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @include('includes.jsVars')
    @include('includes.jsonVars')
@endsection
