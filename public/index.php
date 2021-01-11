<?php
include '../src/config.php';
include '../layout/bottomnav.php';
include 'map-functions.php';

try {
  $query = "SELECT * FROM office_specs";
  $stmt = $conn->query($query);
  $office_specs = $stmt->fetchall();
  }   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../map-icons-master/dist/css/map-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/bottomnav.css">
  <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap&libraries=places"
    defer>
  </script>
  <title>Office finder</title>
</head>
<body>

<!-- sökfunktion form -->
<div class="input-group">
  <input
  id="pac-input"
  class="controls"
  type="text"
  placeholder="Vart ska du?"
  />
</div>

<div id="googleMap" style="width:100%;height:80%;"></div>
  
<!-- knapp på startsidan (visa lista) -->
<!-- <div></div> -->
<a href="officelist.php" class="list-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg></a>

  <table style='border: solid 1px black;'>
    <tr><th>Id</th><th>Office</th><th>Street</th></tr>
    <?php foreach ($offices as $key => $office) { ?>
      <tr>
        <td style='width:150px;border:1px solid black;'><?=($office['id'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($office['office_name'])?></td>
        <td style='width:150px;border:1px solid black;'><?=($office['street'])?></td>
      </tr>
    <?php } ?>
  </table>


  
  <?php foreach ($office_specs as $key => $office_specss) { ?>
    lat = <?=($office_specss['lat'])?>";
    lng = "<?=($office_specss['lng'])?>";
    <?php } ?> 

    
  

  <!-- <script> 
  
    
    var markers = [
      {
        coords:{lat:lat,lng:lng},
        iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
        content:'<h4>Norrsken</h4>'
      },
      {
        coords:{lat:42.8584,lng:-70.9300},
        content:'<h1>Amesbury MA</h1>'
      },
      {
        coords:{lat:42.7762,lng:-71.0773}
      }
    ];

    for(var i = 0;i < markers.length;i++){
      // Add marker
      addMarker(markers[i]);
    }

    // Add Marker Function
    function addMarker(props){
      var marker = new google.maps.Marker({
        position:props.coords,
        map:map,
        //icon:props.iconImage
      });

      // Check for customicon
      if(props.iconImage){
        // Set icon image
        marker.setIcon(props.iconImage);
      }

      // Check content
      if(props.content){
        var infoWindow = new google.maps.InfoWindow({
          content:props.content
        });

        marker.addListener('click', function(){
          infoWindow.open(map, marker);
        });
      }
    }
    </script> -->
  </body>
</html>