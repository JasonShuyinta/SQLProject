<!-- Form per l'inserimento di una campagna fondi -->
<?php
session_start();
require_once("header.php");
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title> Campagna Fondi </title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">
        <form class="text-center border border-light p-5" action="inserimentoCampagna.php" method="post">
          <h3 style="text-align: center; text-transform: capitalize;"> Crea la tua campagna fondi! </h3>
          <h5> La campagna fondi di <?php echo $_SESSION['nome']; ?></h5>
          <div class="form-group">
            <label style="text-align: center;">Descrizione</label>
            <input type="text" class="form-control" name="descrizione">
          </div>
          <div class="form-group">
            <label style="text-align: center;">Importo da raggiungere</label>
            <input type="number" class="form-control" name="importo">
          </div>
          <button type="submit" name="submitCampagna" class="btn btn-info my-4 w-50 center-block btn-block"> Carica </button>
        </form>
      </div>
    </div>
  </div>
  <?php require_once("footer.php") ?>
</body>

</html>
