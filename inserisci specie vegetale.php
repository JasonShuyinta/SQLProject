<?php
session_start();
?>


<!DOCTYPE htm>
<html>

<head>
  <title> Inserisci specie vegetale </title>
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
        <form class="text-center border border-light p-5" action="inserisci specie vegetale2.php" method="post">
          <p class="h4 mb-4"> Inserimento di una specie vegetale </p>
          <div class="form-group">
            <label> Classe </label>
            <input type="text" class="form-control" placeholder="Classe" name="Classe" required>
          </div>
          <div class="form-group">
            <label> Nome Latino </label>
            <input type="text" class="form-control" placeholder="Nome Latino" name="NomeLatino" required>
          </div>

          <div class="form-group">
            <label> Nome Italiano </label>
            <input type="text" class="form-control" placeholder="Nome Italiano" name="NomeItaliano" required>
          </div>

          <div class="form-group">
            <label> Anno Classificazione </label>
            <input type="text" class="form-control" placeholder="Anno Classificazione" name="AnnoClassificazione" required>
          </div>

          <div class="form-group">
            <label> Livello Vulnerabilita </label>
            <input type="text" class="form-control" placeholder="Livello Vulnerabilita" name="LivelloVulnerabilita" required>
          </div>

          <div class="form-group">
            <label> Link Wikipedia </label>
            <input type="text" class="form-control" placeholder="Link Wikipedia" name="LinkWikipedia">
          </div>

          <div class="form-group">
            <label> Altezza </label>
            <input type="text" class="form-control" placeholder="Altezza" name="Altezza" required>
          </div>

          <div class="form-group">
            <label> Diametro </label>
            <input type="text" class="form-control" placeholder="Diametro" name="Diametro" required>
          </div>

          <div class="form-group">
            <label> Nome Habitat </label>
            <input type="text" class="form-control" placeholder="Nome Habitat" name="NomeHabitat" required>
          </div>
          <button type="submit" name="submit" class="btn btn-info my-4 btn-block w-50 center-block">Inserisci Specie</button>
      </div>
    </div>
  </div>
    <?php require_once("footer.php") ?>
</body>

</html>
