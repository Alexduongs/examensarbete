<?php
require '../src/dbconnect.php';
include '../src/config.php';

try {

  $query = "SELECT * FROM offices WHERE id = :id;";

  $stmt = $conn->prepare($query);
  $stmt->bindValue(':id', $_GET['id']);
  $stmt->execute();
  $offices = $stmt->fetch();
}   catch (\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int) $e->getCode());
  }
  
  try {

    $query = "SELECT * FROM office_specs WHERE office_id = :id;";
  
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $office_specs = $stmt->fetch();
  }   catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

?>


  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/officespecs.css">
  <title>Office Specs</title>
</head>
<body>

<?php foreach ($offices as $key => $office) { ?>
  <img class="img-fluid" src="<?=($offices['office_img'])?>" alt=""></img>
  <div class="p-4">
    <h2 class="text-center"><?=($offices['office_name'])?></h2>
    <p class="street text-center"><?=($offices['street'])?>, <?=($offices['postal_code'])?></p>
    <p class=""><?=($offices['description'])?></p>
  <hr class="m-4">
</div>
  <?php break; } ?>

  <?php foreach ($office_specs as $key => $officespecs) { ?>
  <h4 class="text-center">Bekvämligheter</h4>
  <br><div class="p-4">
    <p class="">Storlek: <?=htmlentities($office_specs['conf_kvm'])?></p>
    <p class=""><?=htmlentities($office_specs['conf_wifi'])?></p>
    <p class=""><?=htmlentities($office_specs['conf_coffe'])?></p>
    <p class="">Rumstyp: <?=htmlentities($office_specs['room_type'])?></p><br>
    <p class="">Platser lediga: <?=htmlentities($office_specs['room_qty'])?></p>
    <a id="cardnav" href="#" class="btn btn-primary">Boka</a>
    </div>
</body>
</html>
<?php break; } ?>

<?php
include '../layout/bottomnav.php';
?>