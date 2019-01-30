@extends('layout')
@section('content')
    <h1>Complete Your Reservation</h1>
    <h2>Lock in this rate now. No credit card. No obligation.</h2>
    <div class="unit-wrapper">
        <div class="details">
            <div class="body">
                <div class="facility">
                    <div class="image">
                        <div class="crop">
                            @if(is_array($unit->facility->images) && count($unit->facility->images)>0)
                            <img src="{{ $unit->facility->images[0] }}" alt="{{ $unit->facility->name }}" />
                            @endif
                        </div>
                    </div>
                    <div class="details">
                        <p><strong>{{ $unit->facility->name }}</strong></p>
                        <p class="address">
                            {{ $unit->facility->address }},
                            <br>{{ $unit->facility->city }}
                            , {{ $unit->facility->state }}
                            {{ $unit->facility->zip }}
                        </p>
                        @if ($unit->facility->showPhoneNumber && !empty($unit->facility->trackedPhoneNumber))
                        <p class="phone"><span class="glyphicon glyphicon-phone-alt"></span> <span id="facility-phone-number">{{ config('site.' . config('domain') . '.phone') }}</span></p>
                        @endif
                    </div>
                </div>
                <div class="hours">
                    <div class="full">
                        <h3>Office Hours:</h3>
                        <table>
                            <tbody>
                            <?php  $today = array(); ?>
                            @foreach ($unit->facility->officeHours as $item)
                                <?php
                                $item = explode(': ',  $item);
                                if(date('D') == $item[0]){
                                    $today = $item;
                                }
                                ?>
                                <tr>
                                    <th>{{ $item[0] }}</th>
                                    <td>{{ strtolower($item[1]) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="abbreviated">
                        <strong>Office Hours for {{$today[0]}}:</strong> <span>{{$today[1]}}</span>
                        <a id="view-all-hours" href="#">View all hours</a>
                    </div>
                </div>
                <div class="unit">
                    <dl>
                        <dt>Unit Type:</dt>
                            <dd class="type">{{ $unit->space->dimensions }} {{ $unit->space->type }}</dd>
                        @if( count($unit->space->amenities) )
                        <dt>Features:</dt>
                            <dd>{!! implode("<br />", \App\Models\Unit::getUnitAmenities($unit->space->amenities))!!}</dd>
                        @endif
                        @if(empty($unit->space->promotion))
                        <dt>Special:</dt>
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
        </div>

        <div class="form">
            <div class="body">
                @include('includes.reservationForm',['maxReservableDate' => $unit->space->maxReservableDate, 'spaceId'=>$unit->space->spaceId])
            </div>
        </div>
    </div>


    <div class="disclaimer">
        No obligation to rent. Leasing this space is month-to-month, with no long term commitment. By clicking to reserve this unit, you agree to our <a href="{{url('/legal')}}">Terms of Service</a>.
    </div>
@endsection
