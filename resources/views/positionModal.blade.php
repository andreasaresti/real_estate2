<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <title>Google Maps</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript">
    function initialize() {
      lat = document.getElementById('latitude').value;
      lng = document.getElementById('longitude').value;
      var myLatlng = new google.maps.LatLng(lat,lng);
      var myOptions = {
        zoom: 9,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
      var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
      
      var marker = new google.maps.Marker({
          position: myLatlng, 
          map: map,
          draggable:true
      });
      google.maps.event.addListener(
          marker,
          'drag',
          function() {
              document.getElementById('latitude').value = marker.position.lat();
              document.getElementById('longitude').value = marker.position.lng();
          }
      );
    }
  </script>
</head>
<body onload="initialize()">
  <div style="display: grid;justify-content: center;margin-top: 50px;">
    <div id="map_canvas" style="width:800px;height:500px;"></div>
    <div style="display: flex;padding: 25px;justify-content: center;">
      <div>
        Lat: <input type="text" id="latitude" style="margin: 5px;" value=<?php echo $listing->latitude; ?>><br>
        Lng: <input type="text" id="longitude" style="margin: 5px;" value=<?php echo $listing->longitude; ?>>
      </div>
      <input type="hidden" id="index" style="margin: 5px;" value=<?php echo $listing->id; ?>>
      <div style="margin-left: 55px;align-self: center;" >
          <button class="btn btn-success btn-submit btn-sm">Submit</button>
      </div>
    </div>
  </div>
</body>

</html>

<script type="text/javascript">
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
    $(".btn-submit").click(function(e){
        let data = {
            "latitude": document.getElementById("latitude").value,
            "longitude": document.getElementById("longitude").value,
            "index": document.getElementById("index").value,
        };
        const url = "/api/savelisting_position";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(data));
        xhr.onload = function () {
            console.log(xhr.response);    
            if(xhr.response == "fail"){
                alert("Add Fail");
            }else{
                alert("Add Ok");
            }
        }
    });
</script>
