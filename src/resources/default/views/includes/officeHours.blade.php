@if (isset($hours))
@php
    $openingHoursString = implode(", ", $hours);

    function getDayHours($day){
        return strtolower(explode(": ", $day)[1] );
    }
@endphp
<div itemprop="openingHours" datetime="<?=$openingHoursString?>" content='<?=$openingHoursString?>' class="facility-hours">
    <h5>{{$title}}</h5>
    <table class="hours">
        <tr>
            <th>Sun</th>
            <td>
                {{getDayHours($hours[0])}}
            </td>
        </tr>
        <tr>
            <th>Mon</th>
            <td>
                {{getDayHours($hours[1])}}
            </td>
        </tr>
        <tr>
            <th>Tue</th>
            <td>
                {{getDayHours($hours[2])}}
            </td>
        </tr>
        <tr>
            <th>Wed</th>
            <td>
                {{getDayHours($hours[3])}}
            </td>
        </tr>
        <tr>
            <th>Thu</th>
            <td>
                {{getDayHours($hours[4])}}
            </td>
        </tr>
        <tr>
            <th>Fri</th>
            <td>
                {{getDayHours($hours[5])}}
            </td>
        </tr>
        <tr>
            <th>Sat</th>
            <td>
                {{getDayHours($hours[6])}}
            </td>
        </tr>
    </table>
</div>
@endif