<!DOCTYPE html>

 
<html>
 
  <head>
    <title>Geolocation Tracking Demo</title>
    <script>
    

   
    var track =  {
      // (A) PROPERTIES & SETTINGS
      rider : 999, // Rider ID - Fixed to 999 for this demo.
      delay : 10000, // Delay between GPS update, in milliseconds.
      timer : null, // Interval timer.
      display : null, // HTML <p> element.

      // (B) INIT
      init : function () {
        track.display = document.getElementById("display");
        if (navigator.geolocation) {
          track.update();
          setInterval(track.update, track.delay);
        } else {
          track.display.innerHTML = "Geolocation is not supported!";
        }
      },
      

      // (C) UPDATE CURRENT LOCATION TO SERVER
      
      
      
      update : function () {
        navigator.geolocation.getCurrentPosition(function (pos) {
          // (C1) LOCATION DATA
          var data = new FormData();
          data.append('req', 'update');
          data.append('rider_id', track.rider);
          data.append('lat', pos.coords.latitude);
          data.append('lng', pos.coords.longitude);
          
         

          // (C2) AJAX
          var xhr = new XMLHttpRequest();
          xhr.open('POST', "2b-ajax-track.php");
          xhr.onload = function () {
            var res = JSON.parse(this.response);
            if (res.status==1) {
              track.display.innerHTML = Date.now() + " | Lat: " + pos.coords.latitude + " | Lng: " + pos.coords.longitude;
            } else {
              track.display.innerHTML = res.message;
            }
          };
          xhr.send(data);
        });
      }
    };
    window.addEventListener("DOMContentLoaded", track.init);
    </script>
  </head>
  <body>
  
    <p id="display"></p>

    
  </body>
 
</html>