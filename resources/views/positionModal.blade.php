<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
  <title>Google Maps</title>
  <link href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
  <!-- <script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet-src.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/leaflet.esri/2.0.0/esri-leaflet.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script>
  <style>
    body {
      height: 100vh;
      padding: 0;
      margin: 0;
      background: rgba(73,155,234,1);
      background: -moz-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
      background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(73,155,234,1)), color-stop(100%, rgba(32,124,229,1)));
      background: -webkit-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
      background: -o-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
      background: -ms-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
      background: radial-gradient(ellipse at center, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5', GradientType=1 );
    }

    .example-container {
      background: white;
      width: 400px;
      box-sizing: border-box;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-family: helvetica;
      font-size: 16px;
      padding: 1.5em;
      -webkit-box-shadow: 1px 5px 5px 0px rgba(0,0,0,0.15);
      -moz-box-shadow: 1px 5px 5px 0px rgba(0,0,0,0.15);
      box-shadow: 1px 5px 5px 0px rgba(0,0,0,0.15);
      border-radius: 8px;
    }

    .example-container * {
      box-sizing: inherit;
      font-size: inherit;
    }

    .example-container .header {
      margin: 1em 0;
    }

    .example-container #MapLocation {
      margin-bottom: 0.75em;
    }

    .example-container input {
      width: 100%;
      margin: 0.5em 0;
      padding: 0.5em;
      border: 1px solid #569ae3;
    }
    </style>
</head>
<body>
  <div class="example-container">
    <div class="row">
      <section class="col col-2 header">Location</section>
      <section class="col col-10">
        <div class="row">
          <section class="col col-6">
            <div id="MapLocation" style="height: 350px"></div>
          </section>
        </div>
        <div class="row">
          <section class="col col-3">
            <label class="input">
              <input id="Latitude" placeholder="Latitude" value=<?php echo $listing->latitude; ?> name="Location.Latitude" />
              <!-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) -->
            </label>
          </section>
          <section class="col col-3">
            <label class="input">
              <input id="Longitude" placeholder="Longitude" value=<?php echo $listing->longitude; ?> name="Location.Longitude" />
              <!-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) -->
            </label>
          </section>
        </div>
        <div class="row">
          <div style="margin-top: 13px;display: flex; align-self: center;justify-content: center;" >
              <button class="btn btn-success btn-submit btn-sm">Submit</button>
              <input type="hidden" id="index" style="margin: 5px;" value=<?php echo $listing->id; ?>>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
<script type="text/javascript">
  $(function() {
    // use below if you want to specify the path for leaflet's images
    //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';
    lat = document.getElementById('Latitude').value;
    lng = document.getElementById('Longitude').value;

    var curLocation = [lat, lng];
    // use below if you have a model
    // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

    if (curLocation[0] == 0 && curLocation[1] == 0) {
      curLocation = [5.9714, 116.0953];
    }

    var map = L.map('MapLocation').setView(curLocation, 10);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    map.attributionControl.setPrefix(false);

    var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider();

    var searchControl = L.esri.Geocoding.geosearch({
      providers: [arcgisOnline]
    }).addTo(map);

    var marker = new L.marker(curLocation, {
      draggable: 'true'
    });

    marker.on('dragend', function(event) {
      var position = marker.getLatLng();
      marker.setLatLng(position, {
        draggable: 'true'
      }).bindPopup(position).update();
      $("#Latitude").val(position.lat);
      $("#Longitude").val(position.lng).keyup();
    });

    $("#Latitude, #Longitude").change(function() {
      var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
      marker.setLatLng(position, {
        draggable: 'true'
      }).bindPopup(position).update();
      map.panTo(position);
    });

    map.addLayer(marker);
    
    map.on("click", addMarker);

    function addMarker(e) {

      $("#Latitude").val(e.latlng.lat);
      $("#Longitude").val(e.latlng.lng);

      marker.setLatLng(e.latlng, {
        draggable: 'true'
      }).bindPopup(e.latlng).update();
      
    }

  })
  $(".btn-submit").click(function(e){
        let data = {
            "latitude": document.getElementById("Latitude").value,
            "longitude": document.getElementById("Longitude").value,
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
</html>
