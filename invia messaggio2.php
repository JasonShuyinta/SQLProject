<?php
session_start();
?>

<!DOCTYPE htm>
<html>

<head>
  <title> Invio Messaggio </title>
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
          <p class="h4 mb-4">Invio Messaggio</p>
          <?php
          $titolo = $_POST['titolo'];
          $testo = $_POST['testo'];
          $destinatario = $_POST['destinatario'];
          $nome = $_SESSION['nome'];
          /* Attempt MySQL server connection. Assuming you are running MySQL
          server with default setting (user 'root' with no password) */
          $link = mysqli_connect("localhost", "root", "", "nature");
          // Check connection
          if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          $check = "SELECT nome FROM UTENTE WHERE (Utente.Nome = '$destinatario')";
          $result = mysqli_query($link, $check);
          $num = mysqli_num_rows($result);
          $sql = "CALL ScambiaMessaggio('$testo','$titolo','$nome', '$destinatario')";
          if ($num == 0) {
            echo ("Il destinatario inserito non è presente all'interno del database.");
          } else if (mysqli_query($link, $sql) and $num == 1) {
            echo "Il messaggio è stato inviato con successo";
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
          // Close connection
          mysqli_close($link);
          ?>
          <p style="text-align: center;"> <a href="invia messaggio.php"> Premera qua per tornare alla pagina precedente </a> </p>
          <p style="text-align: center;"> <a href="home.php"> Premera qua per tornare alla home </a> </p>
        </form>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br>
  <?php require_once("footer.php") ?>
</body>
</html>
