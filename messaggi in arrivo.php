<?php
session_start();
$nome = $_SESSION['nome'];
?>

<!DOCTYPE html>

<html>

<head>
  <title> Messaggi in arrivo </title>
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
  <h1 style="text-align: center; text-transform: uppercase; "> Messaggi in arrivo </h1>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Titolo</th>
              <th scope="col">Testo</th>
              <th scope="col">Data e ora</th>
              <th scope="col">Mittente</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $link = mysqli_connect("localhost", "root", "", "nature");
            // Check connection
            if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM MESSAGGIO WHERE (Messaggio.NomeDestinatario = '$nome')";
            $result = mysqli_query($link, $sql);
            while ($riga = mysqli_fetch_array($result)) {
              echo "<tr>
      <th scope='row'>" . $riga['Titolo'] . "</th> <td>  " . $riga['Testo'] . "</td><td> " . $riga['Ora'] . "</td><td> " . $riga['NomeMittente'] . "</th></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php require_once("footer.php") ?>
</body>
</html>
