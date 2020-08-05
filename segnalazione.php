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
        <!-- Default form register -->

        <form class="text-center border border-light p-5" action="segnalazione2.php" method="post">
          <p class="h4 mb-4">Inserisci Segnalazione</p>
          <div class="form-group">
            <div class="col md-6">
              <div class="form-group">
                <label>Inserisci Latitudine</label>
                <input type="text" class="form-control" placeholder="Latitudine" name="Latitudine" required>
              </div>

              <div class="form-group">
                <label>Inserisci Longitudine</label>
                <input type="text" class="form-control" placeholder="Longitudine" name="Longitudine" required>
              </div>
              <div class="form-group">
                <label>Nome Habitat</label>
                <input type="text" class="form-control" placeholder="Nome Habitat" name="NomeHabitat" required>
              </div>
              <div>
                <label>Inserisci Foto</label>
                <input type="file" class="form-control-file " name="Foto" required>
              </div>
              <div>
                <button type="submit" class="btn btn-info my-4 btn-block"> Invia segnalazione </button>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php require_once("footer.php")?>
</body>

</html>
