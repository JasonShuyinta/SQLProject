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

  <title> Visualizza Utenti </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <?php require_once("header.php"); ?>
  <!-- Default form register -->

  <form class="text-center">
    <p class="h4 mb-4">Visualizza Utenti</p>
    <div class="form-group">
      <div class="col md-6">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Password</th>
              <th scope="col">Anno <br>Nascita</th>
              <th scope="col">Professione</th>
              <th scope="col">Foto</th>
              <th scope="col">Data <br>Registrazione</th>
              <th scope="col">Contatore</th>
              <th scope="col">Numero Classificazione <br> Corrette</th>
              <th scope="col">Numero Classificazione <br>Errate</th>
              <th scope="col">Numero Classificazione <br> Totali</th>
              <th scope="col">Affidabilita</th>
              <th scope="col">TipoUtente</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM Utente";
            $result = mysqli_query($link, $sql);
            while ($riga = mysqli_fetch_array($result)) {
              echo "<tr>
                <th scope='row'>" . $riga['Nome'] . "</th> <td>  " . $riga['Email'] . "</td><td> " . $riga['Password'] . "</td><td> " . $riga['AnnoNascita'] . "</td><td> " . $riga['Professione'] . "</td><td> " . $riga['Foto'] . "</td><td> " . $riga['DataRegistrazione'] . "</td><td>" . $riga['Contatore'] . "</td><td>" . $riga['N_Classificazione_Corrette'] . "</td><td>" . $riga['N_Classificazione_Errate'] . "</td><td>" . $riga['N_Classificazione_Totali'] . "</td><td>" . $riga['Affidabilita'] . "</td><td>" . $riga['TipoUtente'] . "</th></tr>";
            }
            ?>
          </tbody>
      </div>
    </div>
  </form>
</body>

</html>
