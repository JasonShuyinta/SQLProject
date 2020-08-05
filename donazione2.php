<?php
session_start();
?>

<!DOCTYPE htm>
<html>

<head>
  <title> Inserisci specie animale </title>
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
          <p class="h4 mb-4">Donazione</p>
          <?php
          $codiceCampagnaDonazione = $_POST['codiceCampagnaDonazione'];
          $importoDonazione = $_POST['importoDonazione'];
          $campoNote = $_POST['campoNote'];
          $nome = $_SESSION['nome'];

          /* Attempt MySQL server connection. Assuming you are running MySQL
             server with default setting (user 'root' with no password) */
          $link = mysqli_connect("localhost", "root", "", "nature");
          // Check connection
          if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }

          $check1 = "SELECT * FROM CAMPAGNA_FONDI WHERE (CAMPAGNA_FONDI.CodiceCampagna = $codiceCampagnaDonazione and Stato ='Aperto')";
          $result1 = mysqli_query($link, $check1);
          $num1 = mysqli_num_rows($result1);
          $sql = "INSERT INTO DONAZIONE (CodiceCampagna, NomeUtente, Importo, Note) VALUES ('$codiceCampagnaDonazione','$nome','$importoDonazione','$campoNote')";
          if ($num1 == 0) {
            echo ("ERRORE: il codice inserito non è corretto");
          } else if (mysqli_query($link, $sql) and $num1 == 1) {
            echo ("La donazione è andata a buon fine");

            $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            $bulk = new MongoDB\Driver\BulkWrite();
            $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Donazione a campagna fondi', 'codiceCampagna' => $codiceCampagnaDonazione, 'importo' => $importoDonazione, 'CampoNote' => $campoNote, 'nomeUtente' => $nome];
            $bulk->insert($doc);

            $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }

          ?>
        </form>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br>
  <?php require_once("footer.php") ?>
</body>
