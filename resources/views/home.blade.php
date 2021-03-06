@extends('layout.main')
@push('head')
<style>
body, html {
  height: 100%;
}
section#top {
  padding-bottom:0px;
  width: 100%;
  height: 100%;
}

@media (max-width: 1600px) {
  section#top {
    padding-top:50px;
  }
}

#map {
  height: 100%;
}
</style>
@endpush

@section('content')
  <section id="top">
    <div id="map"></div>
  </section>
@stop

@push('script')
<script>
// set handler for view-all btn
$('#view-all').on('click', function(){
  alert('Sorry, still working on it!');
});

const currentCoord      = { lat: 5.314434, lng: 100.294312 },
      icon              = {h: 35, w: 35},
      reverseGeocodeUrl = '//maps.googleapis.com/maps/api/geocode/json?latlng=' + currentCoord.lat + ',' + currentCoord.lng + '&sensor=true';

var markers = [];

var map = new GMaps({
  div: '#map',
  lat: currentCoord.lat,
  lng: currentCoord.lng,
});

// add marker for user position
$.getJSON( reverseGeocodeUrl, function(data){
  var addr = '';
  if(data.results.length){
    addr = '<p>' + data.results[0].formatted_address + '</p>';
  }

  map.addMarker({
    lat: currentCoord.lat,
    lng: currentCoord.lng,
    infoWindow: {
      content: '<b>You are here 😎</b>' + addr,
    },
  });
});

function fetchAndRenderMarkers(){
  $.getJSON( '{{ urlS(route('nearby')) }}?lat=5.314434&lng=100.294312&rad={{ \Request::input('rad') }}', addMarkers);
}

function setCountNearby(n){
  $('#count-nearby').text('(' + n + ')');
}

function addMarkers (data) {
  $('body').removeClass('loading');

  var markers_data = [];

  // get ids of previous markers
  currentMarkerIds = _.pluck(markers, 'id');

  // exclude currentMarkerIds from incoming data
  data = _.reject(data, function(marker){ 
    return currentMarkerIds.indexOf(marker.id) > -1;
  });

  if (data.length > 0) {
    // $.growl.notice({ title: data.length + ' object(s) just spawned!', message: 'Click the icons on map to see more detail.'});

    // append new data to current markers
    markers = markers.concat(data);

    for (var i = 0; i < markers.length; i++) {
      var item = markers[i];

      if (item.lat != undefined && item.lng != undefined) {
        icon.url = '//robohash.org/' + item.locatable.title + '?size=' + icon.h + 'x' + icon.w;
        
        distance = '<br/><br/>' + item.distance + ' KM from your location.';
        url = item.locatable.url 
            ? '<br><a href="' + item.locatable.url + '" target="_blank">Read more</a>'
            : '';

        markers_data.push({
          lat : item.lat,
          lng : item.lng,
          title : item.locatable.title,
          icon : {
            size : new google.maps.Size(icon.h, icon.w),
            url : icon.url
          },
          infoWindow: {
            content: '<b>' + item.locatable.desc + '</b><p>' + item.locatable.title + distance + url + '</p>'
          }
        });

        // update count nearby
        setCountNearby(markers_data.length);
      }
    }
  }

  map.addMarkers(markers_data);
}

$(document).ready(function(){
  fetchAndRenderMarkers();
  
  map.on('marker_added', function (marker) {
    var index = map.markers.indexOf(marker);

    if (index == map.markers.length - 1) {
      map.fitZoom();
    }
  });

  setInterval(fetchAndRenderMarkers, 3000);
});
  
</script>
@endpush