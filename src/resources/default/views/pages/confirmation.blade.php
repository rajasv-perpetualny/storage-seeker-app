@extends('layout')
@section('content')
    <h1>Your Reservation is Confirmed</h1>
    <h2>Confirmation Code: <strong>{{$unit->reservationConfirmation->confirmationCode}}</strong>
        <br/>This confirmation has been emailed to <a href="mailto:{{$unit->reservationConfirmation->customerEmailAddress}}">{{$unit->reservationConfirmation->customerEmailAddress}}</a></h2>

    <div class="primary">
        <div class="information">
            <div class="heading">Your <h2>Information</h2></div>
            <p>{{ $unit->reservationConfirmation->customerFirstName }} {{ $unit->reservationConfirmation->customerLastName }}</p>
            <p>{{$unit->reservationConfirmation->customerEmailAddress}}</p>
            <p>{{$unit->reservationConfirmation->customerPhoneNumber}}</p>
        </div>
        <div class="date">
            <div class="heading">Move-In <h2>Date</h2></div>
            <p>You're scheduled to move in on<br/>
                <strong>{{date('l, M. j', strtotime($unit->reservationConfirmation->moveInDate))}}</strong>.</p>
        </div>
        <div class="facility">
            <div class="heading">Your <h2>Storage Facility</h2></div>
            <div class="image">
                <div class="crop">
                    <img src="{{ url($unit->facility->images[0])  }}" alt="{{ $unit->facility->name }}" />
                </div>
            </div>
            <div class="details">
                <p><strong><a href="{{ url('/facility/'.$unit->facility->id) }}">{{ $unit->facility->name }}</a></strong></p>
                <p class="address">
                    <a href="{{"https://www.google.com/maps/place/".$unit->facility->address." ".$unit->facility->city." ".$unit->facility->state." ".$unit->facility->zip}}">{{ $unit->facility->address }}</a>,
                    <br>{{ $unit->facility->city }}
                    , {{ $unit->facility->state }}
                    {{ $unit->facility->zip }}
                </p>
                @if($unit->facility->showPhoneNumber)
                <p class="phone">{{ $unit->facility->trackedPhoneNumber }}</p>
                @endif
            </div>
        </div>
        <div class="unit">
            <div class="heading">Your <h2>Storage Unit</h2></div>
            <dl>
                <dd class="type">{{ $unit->space->dimensions }} {{ $unit->space->type }}</dd>
                @if(is_array($unit->space->amenities) && count($unit->space->amenities)>0)
                <dt><div class="heading">Your <h2>Features</h2></div></dt>
                    <dd>{!! implode('<br />', $unit->space->amenities) !!}</dd>
                @endif
                @if($unit->space->promotion != "")
                <dt><div class="heading">Your <h2>Special</h2></div></dt>
                    <dd class="special">{{ $unit->space->promotion }}</dd>
                @endif
            </dl>
            <div class="rent">
                <div>
                    <span class="period">Monthly Rent:</span>
                    <span class="cost">${{ number_format($unit->space->price, 2, '.', ',') }}</span>
                </div>
                <div class="regular">
                    <span>Regular Price</span>
                    <s>${{ number_format($unit->space->regularPrice, 2, '.', ',') }}</s>
                </div>
            </div>
        </div>
    </div>
    <div class="secondary">
        <div class="promotion">
            <div class="promotion-img"></div>
            <div class="wrapper">
                <div class="body">
                    <p class="title">Need Moving Supplies?</p>
                    <p>SpareFoot offers ready-made packs for your {{ $unit->space->dimensions }} Unit.</p>
                    <a class="btn-primary" href="http://supplies.sparefoot.com/">Get Boxes and Supplies</a>
                    <hr/>
                    <div class="supplies-wrapper">
                        <div class="supply">
                            <img src="{{ url('/storage/images/supplies-medium-moving-boxes.png') }}" width="50" />
                            <p>Medium moving boxes</p>
                        </div>
                        <div class="supply">
                            <img src="{{ url('/storage/images/supplies-small-bubble-roll.png') }}" width="50" />
                            <p>Small bubble roll</p>
                        </div>
                        <div class="supply">
                            <img src="{{ url('/storage/images/supplies-packing-tape.png') }}" width="50" />
                            <p>Packing Tape (4 Rolls)</p>
                        </div>
                    </div>
                    <div class="supplies-wrapper">
                        <div class="supply">
                            <img src="{{ url('/storage/images/supplies-large-moving-boxes.png') }}" width="50" />
                            <p>Large moving boxes</p>
                        </div>
                        <div class="supply">
                            <img src="{{ url('/storage/images/supplies-wardrobe-boxes.png') }}" width="50" />
                            <p>Wardrobe boxes</p>
                        </div>
                        <div class="supply">
                            <img src="{{ url('/storage/images/supplies-moving-kits.png') }}" width="50" />
                            <p>Moving kits</p>
                        </div>
                    </div>
                    <a href="http://supplies.sparefoot.com/" class="view-all-supplies">View all supplies</a>

                </div>
            </div>
        </div>
    </div>
    <div class="next-what-wrapper">
        <div class="next">
            <h2>Next Steps</h2>
            <img src="{{ url('/storage/images/confirmation-phone.png') }}" height="50">
            <p>Your facility will contact you within 24 hours. If you don't hear from them, give them a call to discuss move-in details.</p>
        </div>
        <div class="what">
            <h2>What to Bring</h2>
            <div class="id">
                <img src="{{ url('/storage/images/confirmation-id.png') }}" height="50">
                <h3>A government-issued ID</h3>
            </div>
            <div class="lease">
                <img src="{{ url('/storage/images/confirmation-lease.png') }}" height   ="50">
                <h3>A copy of this reservation</h3>
            </div>
        </div>


        <div class="now-available"><p>The unit is available now. You can move in or sign paperwork in advance.</p></div>
    </div>
@endsection
@section('tracking')
    @include('includes.conversionCode')
@endsection
@section('scripts')
@endsection
