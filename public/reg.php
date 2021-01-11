<?php
  include '../src/config.php';
  include '../layout/bottomnav.php';
  include 'map-functions.php';

  $first_name  = '';
  $last_name   = '';
  $email       = '';
  $phone       = '';
  $error       = '';
  $msg         = '';

  if (isset($_POST['register'])) {
      $first_name      = trim($_POST['first_name']);
      $last_name       = trim($_POST['last_name']);
      $email           = trim($_POST['email']);
      $password        = trim($_POST['password']);
      $confirmPassword = trim($_POST['confirmPassword']);
      $phone           = trim($_POST['phone']);

      if (empty($first_name)) {
          $error .= "<li>Förnamn är obligatoriskt</li>";
      } 
      if (empty($last_name)) {
          $error .= "<li>Efternamn är obligatoriskt</li>";
      }
      if (empty($email)) {
          $error .= "<li>E-post är obligatoriskt</li>";
      }
      if (empty($password)) {
          $error .= "<li>Lösenord är obligatoriskt</li>";
      }
      if (!empty($password) && strlen($password) < 6) {
          $error .= "<li>Lösenordet får inte vara mindre än 6 tecken lång</li>";
      }
      if ($confirmPassword !== $password) {
          $error .= "<li>Det bekräftade lösenordet matchar inte</li>";
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error .= "<li>Ogiltig e-post</li>";
      }
      

      if ($error) {
          $msg = "<ul class='error_msg'>{$error}</ul>";
      }

      if (empty($error)) {
          try {
              $query = "
                  INSERT INTO users (first_name, last_name,  password, email, phone)
                  VALUES (:first_name, :last_name, :password, :email, :phone);
              ";

              $stmt = $conn->prepare($query);
              $stmt->bindValue(':first_name', $first_name);
              $stmt->bindValue(':last_name', $last_name);
              $stmt->bindValue(':password', $password);
              $stmt->bindValue(':email', $email);
              $stmt->bindValue(':phone', $phone);
              $result = $stmt->execute(); // returns true/false
          } catch(\PDOException $e) {
              throw new \PDOException($e->getMessage(), (int) $e->getCode());
          }
          // header('Location: ');
          // exit;

          if ($result) {
              $msg = '<div class="success_msg">Ditt konto är nu skapat</div>';
          } else {
              $msg = '<div class="error_msg">Regisreringen misslyckades. Var snäll och försök igen senare!</div>';
          }
      }
  }
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
<?=$msg?>
    <div class="reg-form-wrapper">
        <div class="container-reg">
            <article class="border">
                <form method="POST" action="#" class="form-reg">
                    <fieldset class="fieldset-reg">
                        <h1 class="rubrik-center">Registrera dig här</h1>
                    
                    <div class="firstname-form">
                            <label for="input1">Förnamn:</label> <br>
                            <input type="text" class="text" name="first_name" placeholder="John" value="<?=htmlentities($first_name)?>">
                        </div>
                    <div class="lastname-form">
                            <label for="input1">Efternamn:</label> <br>
                            <input type="text" class="text" name="last_name" placeholder="Doe" value="<?=htmlentities($last_name)?>">
                        </div>
                    <div class="email">
                    <div class="email-form">
                            <label for="input1">E-post:</label> <br>
                            <input type="text" class="text" name="email" placeholder="John.doe@hotmail.com" value="<?=htmlentities($email)?>">
                        </div>
                    </div>
                        <div class="phone-form">
                            <label for="input1">Telefon:</label> <br>
                            <input type="text" class="text" name="phone" placeholder="070-78-392-10" value="<?=htmlentities($phone)?>">
                        </div>
                    <div class="password-form">
                            <label for="input2">Lösenord:</label> <br>
                            <input type="password" class="text" name="password">
                        </div>
                    <div class="confirmPassword-form">
                            <label for="input2">Bekräfta lösenord:</label> <br>
                            <input type="password" class="text" name="confirmPassword">
                        </div>
                        <div class="submit-btn">
                            <input type="submit" name="register" value="Registrera" class="submit-reg-btn">
                        </div>
                    </fieldset>
                </form>
            </article>
        </div>
    </div>
</body>
</html>