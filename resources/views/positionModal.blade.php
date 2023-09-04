<?php
  if(isset($_GET['index'])){
    $index = $_GET['index'];
  }else{
    $index = 0;
  }
  if(isset($_GET['flag'])){
    $flag = $_GET['flag'];
  }else{
    $flag = "";
  }
?>
    <style>
    body {
      height: 100vh;
      padding: 0;
      margin: 0;
      background: currentcolor;
      
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
              <?php if($data->latitude){ ?>
                <input id="Latitude" placeholder="Latitude" value=<?php echo $data->latitude;?> name="Location.Latitude"  />
              <?php }else{ ?>
                <input id="Latitude" placeholder="Latitude"  name="Location.Latitude" value="35.12647019957552"/>
              <!-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) -->
              <?php } ?>
            </label>
          </section>
          <section class="col col-3">
            <label class="input">
              <?php if($data->longitude){ ?>
                <input id="Longitude" placeholder="Longitude" value=<?php echo $data->longitude;?>  name="Location.Longitude" />
              <?php }else{ ?>
                <input id="Longitude" placeholder="Longitude"  name="Location.Longitude" value="33.446207830810565"/>
              <?php } ?>
              <!-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) -->
            </label>
          </section>
        </div>
        <div class="row">
          <div style="margin-top: 13px;display: flex; align-self: center;justify-content: center;" >
              <button class="btn btn-success btn-submit btn-sm">Submit</button>
              <input type="hidden" id="index" style="margin: 5px;" value=<?php echo $data->id; ?>>
              <input type="hidden" id="flag" style="margin: 5px;" value=<?php echo $flag; ?>>
          </div>
        </div>
      </section>
    </div>
  </div>
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

    searchControl.on('results', function(data){
      $("#Latitude").val(data.latlng.lat);
      $("#Longitude").val(data.latlng.lng);

      marker.setLatLng(data.latlng, {
        draggable: 'true'
      }).bindPopup(data.latlng).update();

      // console.log(data);
      // results.clearLayers();
      // for (var i = data.results.length - 1; i >= 0; i--) {
      //   results.addLayer(L.marker(data.results[i].latlng));
      // }
    });

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
    /*
    console.log(document.getElementById("Latitude").value);
    console.log(document.getElementById("Longitude").value);
    console.log(document.getElementById("index").value);
    console.log(document.getElementById("flag").value);
    */

    let data = {
        "latitude": document.getElementById("Latitude").value,
        "longitude": document.getElementById("Longitude").value,
        "index": document.getElementById("index").value,
        "flag": document.getElementById("flag").value,
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
            window.parent.location.reload();
        }
    }
  });
</script>
