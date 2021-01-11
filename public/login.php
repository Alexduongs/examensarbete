<?php 
include '../src/config.php';
include '../layout/bottomnav.php';
include 'map-functions.php';

    $msg = "";
    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="error_msg">Obs! Sidan är inloggningsskyddad. Var snäll och logga in.</div>';
    }

    if (isset($_GET['logout'])) {
        $msg = '<div class="success_msg">Du har loggat ut.</div>';
    }


    if (isset($_POST['doLogin'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        try {
            $query = "
                SELECT * FROM users
                WHERE email = :email;
            ";

            $stmt = $conn->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->execute(); // returns true/false
            // fetch() fetches 1 record, fetchAll() fetches alla records 
            $user = $stmt->fetch(); // returns the user record if exists, else returns false
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        // fetch() found a user by email. This array would be considered true in bool, in if-condition
        // [
        //     [id] => 1
        //     [username] => Henrik
        //     [password] => qweqwe
        //     [email] => henke@asd.se
        //     [register_date] => 2020-05-06 13:20:03
        // ]

        // Empty array is considered false in if-condition
        // $array = [
        // ];


        // If user exists AND password is correct, will be considered true. Meaning you are logged in
        if ($user && $password === $user['password']) {
            $_SESSION['email'] = $user['email'];
            header('Location: index.php');
            exit;
        } else {
           // If user doesnt Exist, will be considered false
            // OR if user exists but password is wrong. will also be considered false
            $msg = '<div class="error_msg">Fel inloggningsuppgifter. Var snäll och försök igen.</div>';
        }
    }
    // echo("<pre>");
    // print_r($_POST);
    // echo("</pre>");
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
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLxvMUJc1j9h0hVAFB0A5K2B3KMk_PSA0&callback=myMap&libraries=places"
    defer>
  </script>
  <title>Office finder</title>
</head>
<body>
<div class="wrapper">
    <div class="content1"> 
        <article class="border">
            <?=$msg?>
            <div class="login">
                <h1 class="rubrik-login">Logga in</h1>
            </div>
                    <!-- Visa errormeddelanden -->
                        
            <form method="POST" action="#">
                <div class="login-background">
                    <div>
                        <label for="input1">E-post:</label> <br>
                        <input type="text" class="text" name="email">
                    </div>

                    <div>
                        <label for="input2">Lösenord:</label> <br>
                        <input type="password" class="text" name="password">
                    </div>

                    <div>
                        <input type="submit" name="doLogin" value="Login" class="loginBtn">
                    </div>
                </div>
            </form>
    </div>
    <div class="content2">
        <article class="border">
        <h1 class="rubrik-home-reg">Registera dig här</h1>
        <form action="reg.php" method="POST">
            <input type="submit" value="Registera" class="regBtn">
        </form>
    </div>
</div>
</body>
</html>