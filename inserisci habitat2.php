<?php
session_start();
?>

<!DOCTYPE htm>
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
        <form class="text-center border border-light p-5">
          <p class="h4 mb-4">Inserimento habitat</p>
          <?php
          $NomeHabitat = $_POST['NomeHabitat'];
          $Descrizione = $_POST['Descrizione'];
          $nome = $_SESSION['nome'];
          /* Attempt MySQL server connection. Assuming you are running MySQL
          server with default setting (user 'root' with no password) */
          $link = mysqli_connect("localhost", "root", "", "nature");
          // Check connection
          if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          $check1 = "SELECT * FROM UTENTE WHERE ((UTENTE.Nome = '$nome') AND (UTENTE.TipoUtente = 'Amministratore'))";
          $check2 = "SELECT * FROM HABITAT WHERE (HABITAT.NomeHabitat = '$NomeHabitat')";
          $result1 = mysqli_query($link, $check1);
          $result2 = mysqli_query($link, $check2);
          $num1 = mysqli_num_rows($result1);
          $num2 = mysqli_num_rows($result2);
          $sql = "CALL InserisciHabitat('$NomeHabitat', '$Descrizione', '$nome')";

          if ($num1 == 0) {
            echo ("ERRORE: L'utente non ha i permessi per eseguire l'inserimento di un habitat");
          } else if ($num2 == 1) {
            echo ("ERRORE: L'habitat è gia' presente all'interno del database");
          } else if (mysqli_query($link, $sql) and $num1 == 1 and $num2 == 0) {
            echo ("L'habitat è stato inserito con successo");

            $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            $bulk = new MongoDB\Driver\BulkWrite();
            $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Inserimento di un habitat', 'descrizione' => $Descrizione, 'nome Habitat' => $NomeHabitat, 'nomeUtente' => $nome];
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
  <br><br><br><br><br><br><br><br><br><br>
  <?php require_once("footer.php") ?>
</body>
</html>
