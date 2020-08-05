<?php
session_start();
?>

<!DOCTYPE htm>
<html>

<head>
  <title> Classificazione </title>
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
        <form class="text-center border border-light p-5">
          <p class="h4 mb-4"> Classificazione </p>
          <?php
          $NomeLatino = $_POST['NomeLatino'];
          $CodiceSegnalazione =  $_POST['CodiceSegnalazione'];
          $Commento = $_POST['Commento'];
          $nome = $_SESSION['nome'];
          $link = mysqli_connect("localhost", "root", "", "nature");
          // Check connection
          if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          $check1 = "SELECT * FROM UTENTE WHERE ((UTENTE.Nome = '$nome') AND ((UTENTE.TipoUtente='Semplice') OR (UTENTE.TipoUtente='Premium')))";
          $check2 = "SELECT * FROM SPECIE WHERE (SPECIE.NomeLatino = '$NomeLatino')";
          $check3 = "SELECT * FROM Segnalazione WHERE (Segnalazione.CodiceSegnalazione = '$CodiceSegnalazione')";
          $check4 = "SELECT * FROM Classificazione WHERE (Classificazione.CodiceSegnalazione = '$CodiceSegnalazione' and Classificazione.NomeUtente = '$nome')";
          $result1 = mysqli_query($link, $check1);
          $result2 = mysqli_query($link, $check2);
          $result3 = mysqli_query($link, $check3);
          $result4 = mysqli_query($link, $check4);
          $num1 = mysqli_num_rows($result1);
          $num2 = mysqli_num_rows($result2);
          $num3 = mysqli_num_rows($result3);
          $num4 = mysqli_num_rows($result4);
          $sql = "CALL InserisciClassificazione('$Commento', '$nome', '$CodiceSegnalazione', '$NomeLatino')";
          $sql2 = "CALL SetAffidabilita('$nome')";
          if ($num1 == 0) {
            echo ("ERRORE: L'utente non ha i permessi per eseguire l'inserimento di una segnalazione");
          } else if ($num2 == 0) {
            echo ("ERRORE: La specie inserita non è presente all'interno del database");
          } else if ($num3 == 0) {
            echo ("ERRORE: Il codice segnalazione inserito non corrisponde a nessuna segnalazione presente nel database");
          } else if ($num4 != 0) {
            echo ("ERRORE: hai già inserito una classificazione a questa segnalazione");
          } else if (mysqli_query($link, $sql) and $num1 == 1 and $num2 == 1 and $num3 == 1 and $num4 == 0 and mysqli_query($link, $sql2)) {
            echo ("La classificazione è stata inserita con successo");


            $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            $bulk = new MongoDB\Driver\BulkWrite();
            $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Inserimento Classificazione', 'nomeLatino' => $NomeLatino, 'CodiceSegnalazione' => $CodiceSegnalazione, 'Commento' => $Commento, 'nomeUtente' => $nome];
            $bulk->insert($doc);

            $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
          ?>
          <p style="text-align: center;"> <a href="classificazione.php"> Premere qua per tornare alla pagina precedente </a> </p>
          <p style="text-align: center;"> <a href="home.php"> Premere qua per tornare alla home </a> </p>
        </form>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br>
  <?php require_once("footer.php") ?>
</body>
