<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ bower() }}/growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css">
        <link href="{{ bower() }}/PACE/themes/red/pace-theme-minimal.css" rel="stylesheet" type="text/css">
        
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            #map {
              width: 100%;
              height: 100%;
            }
        </style>
    </head>
    <body>
      <div id="map"></div>
    </body>
    <script src="{{ bower() }}/underscore/underscore-min.js"></script>
    <script src="{{ bower() }}/PACE/pace.min.js"></script>
    
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBYUTX2BMi7YeXkQj2PbEl_V2ORd-iNhu8"></script>
    <script src="{{ bower() }}/gmaps/gmaps.min.js"></script>
    <script src="{{ bower() }}/jquery/dist/jquery.min.js"></script>
    <script src="{{ bower() }}/growl/javascripts/jquery.growl.js"></script>
    <script>

const currentCoord      = { lat: 5.314434, lng: 100.294312 },
      icon              = {h: 35, w: 35},
      reverseGeocodeUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + currentCoord.lat + ',' + currentCoord.lng + '&sensor=true';

var markers = [];

var map = new GMaps({
  div: '#map',
  lat: currentCoord.lat,
  lng: currentCoord.lng,
});

$(document).ajaxStart(function() {
  $('body').addClass('loading');
});
$(document).ajaxStop(function() {
  $('body').removeClass('loading');
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
    $.growl.notice({ title: data.length + ' object(s) just spawned!', message: 'Click the icons on map to see more detail.'});

    // append new data to current markers
    markers = markers.concat(data);

    for (var i = 0; i < markers.length; i++) {
      var item = markers[i];

      if (item.lat != undefined && item.lng != undefined) {
        icon.url = '//robohash.org/' + item.locatable.title + '?size=' + icon.h + 'x' + icon.w;

        markers_data.push({
          lat : item.lat,
          lng : item.lng,
          title : item.locatable.title,
          icon : {
            size : new google.maps.Size(icon.h, icon.w),
            url : icon.url
          },
          infoWindow: {
            content: '<b>' + item.locatable.desc + '</b><p>' + item.locatable.title + '</p>'
          }
        });
      }
    }
  }

  map.addMarkers(markers_data);
}

$(document).ready(function(){
  
  map.on('marker_added', function (marker) {
    var index = map.markers.indexOf(marker);

    if (index == map.markers.length - 1) {
      map.fitZoom();
    }
  });

  setInterval(fetchAndRenderMarkers, 3000);
});
  
    </script>

</html>