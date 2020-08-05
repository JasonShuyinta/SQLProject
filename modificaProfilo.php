<?php
session_start();
require_once("header.php");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title> Modifica profilo </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">

        <p class="h4 mb-4" style="text-align: center;"> MODIFICA PROFILO </p>

        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <?php


              /* Attempt MySQL server connection. Assuming you are running MySQL
     server with default setting (user 'root' with no password) */
              $link = mysqli_connect("localhost", "root", "", "nature");

              // Check connection
              if ($link === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
              }

              $nomeOriginale = $_SESSION['nome'];
              $email = $_POST['Email'];
              $password = $_POST['Password'];
              $annoNascita = $_POST['AnnoNascita'];
              $professione = $_POST['Professione'];
              $foto = $_POST['Foto'];


              $updateQuery = "UPDATE UTENTE SET  Email = '$email', Password = '$password', AnnoNascita = '$annoNascita', Professione = '$professione', Foto = '$foto' WHERE Nome = '$nomeOriginale'";
              if (mysqli_query($link, $updateQuery)) {
              ?> <p style="text-align: center;"> <?php echo "La tua modifica è avvenuta con successo!";

                                                  $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

                                                  $bulk = new MongoDB\Driver\BulkWrite();
                                                  $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Modifica del profilo utente', 'Nome Utente' => $nomeOriginale, 'email' => $email, 'password' => $password, 'Anno di Nascita' => $annoNascita, 'Professione' => $professione, 'foto' => $foto];
                                                  $bulk->insert($doc);


                                                  $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
                                                } else {

                                                  echo "Non è stato possibile effettuare la modifica";
                                                }
                                                  ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br>

  <?php require_once("footer.php") ?>
</body>

</html>
