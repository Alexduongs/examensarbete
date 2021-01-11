<?php
include '../src/config.php';
include '../layout/bottomnav.php';
include 'map-functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
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
<div class="login-container">
<div class="text-btn-con m-4">
<div>
  <h2><b>Din Profil</b></h2>
  <p>Logga in för att hitta ditt nästa kontor.</p>
</div>

<div class="d-grid">
  <a href="login.php"><button class="btn btn-primary btn-lg" type="button">Logga in</button></a>
</div>
</div>
</div>
<div class="list-group mt-2">
  <a href="#" class="list-group-item list-group-item-action border-bottom">Cras justo odio</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Dapibus ac facilisis in</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Morbi leo risus</a>
  <a href="#" class="list-group-item list-group-item-action border-bottom">Porta ac consectetur ac</a>
  <a href="#" class="list-group-item list-group-item-action border-0" tabindex="-1" aria-disabled="true">Vestibulum at eros</a>
</div>
  
</body>
</html>