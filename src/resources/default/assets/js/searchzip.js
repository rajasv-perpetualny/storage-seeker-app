$(document).ready(() => {

  $('#near-me').click(getLocation);

});

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(p) {
  console.log("Latitude: " + p.coords.latitude +
  "Longitude: " + p.coords.longitude);
  var latlng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
  geocoder = new google.maps.Geocoder();

    geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                for (j = 0; j < results[0].address_components.length; j++) {
                    if (results[0].address_components[j].types[0] == 'postal_code')
                         window.location.href = `/search/${results[0].address_components[j].short_name}/zip`;
                }
            }
        } else {
            alert("Geocoder failed due to: " + status);
        }
    });
}
