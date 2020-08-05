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

  <title> Classificazione </title>

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
      <div class="col-md-5" style="margin-left: 5rem;">
        <h3 style="text-align: center;"> Classificazione </h3>
        <br><br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Codice Segnalazione</th>
              <th scope="col"> Data </th>
              <th scope="col">Foto </th>
              <th scope="col">Latitudine </th>
              <th scope="col">Longitudine </th>
              <th scope="col">NomeHabitat </th>
              <th scope="col">Nome Utente </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $link = mysqli_connect("localhost", "root", "", "nature");
            // Check connection
            if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            $sql = "SELECT * FROM segnalazione";
            $result = mysqli_query($link, $sql);
            while ($riga = mysqli_fetch_array($result)) {
              echo "<tr>
      <th scope='row'>" . $riga['CodiceSegnalazione'] . "</th> <td>  " . $riga['Data'] . "</td><td> " . $riga['Foto'] . "</td><td> " . $riga['Latitudine'] . "</td><td> " . $riga['Longitudine'] . "</td><td> " . $riga['NomeHabitat'] . "</td><td> " . $riga['NomeUtente'] . "</th></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-5" style="margin-left: 14rem;">
        <h3 style="text-align: center;"> Inserisci una classificazione </h3>
        <form class="text-center" action="classificazione2.php" method="post">

          <div class="form-group">
            <label>Inserisci Codice Segnalazione</label>
            <input type="text" class="form-control w-50 center-block" placeholder="Codice Segnalazione" name="CodiceSegnalazione" required>
          </div>
          <div class="form-group">
            <label>Inserisci Nome Latino</label>
            <input type="text" class="form-control w-50 center-block" placeholder="Nome Latino" name="NomeLatino" required>
          </div>
          <div class="form-group">
            <label>Inserisci Commento</label>
            <textarea class="form-control w-50 center-block" placeholder="Commento" rows="4" name="Commento" required></textarea>
          </div>
          <div>
            <button type="submit" class="btn btn-info my-4 btn-block w-50 center-block"> Invia classificazione</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require_once("footer.php") ?>

</body>

</html>
