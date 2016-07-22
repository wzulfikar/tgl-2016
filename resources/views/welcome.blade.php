<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
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
        </style>
    </head>
    <body id="map">
    </body>
    
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBYUTX2BMi7YeXkQj2PbEl_V2ORd-iNhu8"></script>
    <script src="{{ bower() }}/gmaps/gmaps.min.js"></script>
    <script src="{{ bower() }}/jquery/dist/jquery.min.js"></script>
    <script>

var map = new GMaps({
  div: '#map',
  lat: 5.314434,
  lng: 100.294312
});

function addMarkers (data) {
  var items, markers_data = [];
  if (data.length > 0) {
    items = data;
    icon  = {h: 35, w: 35};

    for (var i = 0; i < items.length; i++) {
      var item = items[i];

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

    $(marker).trigger('click');
    if (index == map.markers.length - 1) {
      map.fitZoom();
    }
  });

  var xhr = $.getJSON('{{ urlS(route('nearby')) }}?lat=5.314434&lng=100.294312&rad={{ \Request::input('rad') }}');

  xhr.done(addMarkers);
});
  
    </script>

</html>