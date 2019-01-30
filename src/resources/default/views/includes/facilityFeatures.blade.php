@if($facilityAmenities)
<h5>Features</h5>
<div id="amenities">
    <ul>
        @foreach($facilityAmenities as $amenity)
            <li><i class="checkmark"></i>{{html_entity_decode(str_replace('("null")','', $amenity))}}</li>
        @endforeach
    </ul>
</div>

@endif