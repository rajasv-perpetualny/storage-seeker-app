<script type="text/javascript">
    var facilityId = {{$unit->facility->id}};
    var holidays = {{$calendar->holidays}};
    var closures = {{$calendar->closures}};
    var closedDays = {{$calendar->closedDays}};
    var closingTime = '{{$calendar->closingTime}}:00';
    var facilityLatitude = {{$unit->facility->latitude}};
    var facilityLongitude = {{$unit->facility->longitude}};

    <?php
    $today = new DateTime("now");
    $maxReservable = new DateTime($unit->space->maxReservableDateFormatted);
    $interval = $today->diff($maxReservable);
     ?>
        @if(isset($unit))
          var maxBookDays = {{$interval->format('%a')}};
        @else
          var maxBookDays= 60;
        @endif

    var moveInDate = '{{old('move_in_date')}}';
    var moveDate = '';
    var facilityActive = true ;
</script>