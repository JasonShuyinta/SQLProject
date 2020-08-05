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
        <!-- Default form register -->
        <form class="text-center border border-light p-5" action="invia messaggio2.php" method="post">
          <p class="h4 mb-4">Invio Messaggio</p>

          <div class="form-group">
            <label>Titolo</label>
            <input type="text" class="form-control" placeholder="Titolo" name="titolo" required>
          </div>

          <div class="form-group">
            <label>Testo</label>
            <textarea class="form-control" placeholder="Testo" rows="4" name="testo" required></textarea>
          </div>

          <div class="form-group">
            <label>Destinatario</label>
            <input type="text" class="form-control" placeholder="Destinatario" name="destinatario" required>
          </div>
          <button type="submit" name="submit" class="btn btn-info my-4 btn-block w-50 center-block">Invia</button>
        </form>
      </div>
    </div>
  </div>
  <?php require_once("footer.php") ?>
</body>

</html>
