<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "nature");

if ($link === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title> Segnalazione </title>

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
  <?php require_once("header.php"); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">
        <form class="text-center border border-light p-5">
          <p class="h4 mb-4">Inserisci Segnalazione</p>
          <?php
          $Latitudine =  $_POST['Latitudine'];
          $Longitudine =  $_POST['Longitudine'];
          $NomeHabitat =  $_POST['NomeHabitat'];
          $Foto =  $_POST['Foto'];
          $nome = $_SESSION['nome'];

          $check1 = "SELECT * FROM UTENTE WHERE ((UTENTE.Nome = '$nome') AND ((UTENTE.TipoUtente='Semplice') OR (UTENTE.TipoUtente='Premium')))";
          $check2 = "SELECT * FROM HABITAT WHERE (HABITAT.NomeHabitat = '$NomeHabitat')";
          $result1 = mysqli_query($link, $check1);
          $result2 = mysqli_query($link, $check2);
          $num1 = mysqli_num_rows($result1);
          $num2 = mysqli_num_rows($result2);
          $sql = "CALL InserisciSegnalazione('$Latitudine','$Longitudine', '$NomeHabitat', '$Foto', '$nome')";

          if ($num1 == 0) {
            echo ("ERRORE: L'utente non ha i permessi per eseguire l'inserimento di una segnalazione");
          } else if ($num2 == 0) {
            echo ("ERRORE: l'habitat inserito non è presente all'interno del database");
          } else if (mysqli_query($link, $sql) and $num1 == 1 and $num2 == 1) {
            echo ("La segnalazione è stata inserita con successo");


            $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            $bulk = new MongoDB\Driver\BulkWrite();
            $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Inserimento di una segnalazione', 'Latitudine' => $Latitudine, 'Longitudine' => $Longitudine, 'Nome Habitat' => $NomeHabitat, 'Foto' => $Foto, 'Nome Utente' => $nome];
            $bulk->insert($doc);

            $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
          ?>

          <p style="text-align: center;"> <a href="segnalazione.php"> Premere qua per tornare alla pagina precedente </a> </p>
          <p style="text-align: center;"> <a href="home.php"> Premere qua per tornare alla home </a> </p>

        </form>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br>
  <?php require_once("footer.php")?>
</body>
</html>
