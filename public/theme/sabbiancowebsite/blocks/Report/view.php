<?php


?>
<div>
   <div style="margin: 50px;">
      Remote Xml:<input type="text" value="https://sabbiancoproperties.com/?feed=estate_rss_v2&limit=10&offset=" id="remoteXML" style="margin: 10px 20px 10px 10px;width: 550px;">
      <button onclick="loadDataReport();">Import</button>
   </div>
</div>
<script>
   function loadDataReport(){
      remoteXML = document.getElementById("remoteXML").value;
      const url = "/api/load-xml";
      data = {
         "remoteXML":remoteXML,
      }
      let xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-type', 'application/json');
      xhr.send(JSON.stringify(data));
      xhr.onload = function () {
         console.log(xhr.response);
      }
   }
</script>