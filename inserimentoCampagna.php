<?php
session_start();
?>

<html>

<head>
  <title> Inserisci habitat </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php require_once("header.php"); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">
        <!-- Default form register -->
        <form class="text-center border border-light p-5" action="submit.php" method="post">
          <p class="h4 mb-4"> Creazione campagna fondi</p>

          <?php

          $link = mysqli_connect("localhost", "root", "", "nature");

          if ($link == false) {
            die("Error: could not connect. " . mysqli_connect_error());
          }

          $descrizione = $_POST['descrizione'];
          $importo = $_POST['importo'];
          $nomeUtente = $_SESSION['nome'];

          $checkAdmin = "SELECT TipoUtente FROM UTENTE WHERE Nome = '$nomeUtente' ";
          $result = mysqli_query($link, $checkAdmin);
          while ($riga = mysqli_fetch_array($result)) {
            if ($riga['TipoUtente'] != "Amministratore") {
              echo "Non puoi creare campagne fondi poichè non sei amministratore"; ?>
              <p style="text-align: center;"> <a href="campagna.php"> Premera qua per ritornare alla pagina precedente </a> </p>
          <?php
            } else {

              $myQuery = "CALL InserisciCampagnaFondi('$descrizione', '$importo','$nomeUtente')";

              if (mysqli_query($link, $myQuery)) {
                echo "Inserimento campagna fondi avvenuta con successo";


                $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

                $bulk = new MongoDB\Driver\BulkWrite();
                $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Inserimento di una campagna fondi', 'descrizione' => $descrizione, 'importo' => $importo, 'nomeUtente' => $nomeUtente];
                $bulk->insert($doc);

                $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
              } else {
                echo "Inserimento non riuscito ";
              }
            }
          }
          ?>

          <p style="text-align: center;"> <a href="home.php"> Premera qua per ritornare alla home </a> </p>
        </form>
      </div>
    </div>
  </div>
    <br><br><br><br><br><br><br><br><br><br>
    <?php require_once("footer.php") ?>
</body>

</html>
