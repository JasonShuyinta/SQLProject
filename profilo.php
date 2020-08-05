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

  <title> Modifica profilo </title>

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



  <!-- Default form register -->



  <?php
  $link = mysqli_connect("localhost", "root", "", "nature");

  // Check connection
  if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  $nome = $_SESSION['nome'];
  $sql = "SELECT * FROM Utente Where UTENTE.Nome='$nome'";
  $result = mysqli_query($link, $sql);
  while ($riga = mysqli_fetch_array($result)) { ?>

    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-3">
          <form class="text-center border border-light p-5" action="modificaProfilo.php" method="post">
            <p class="h4 mb-4">Modifica il tuo Profilo</p>
            <div class="form-group">
              <div class="form-group">
                <label> Email </label>
                <input type="email" class="form-control" value=" <?php echo $riga['Email'] ?>" name="Email">
              </div>
              <div class="form-group">
                <label> Password </label>
                <input type="password" class="form-control" value=" <?php echo $riga['Password'] ?> " name="Password">
              </div>
              <div class="form-group">
                <label>Anno di nascita</label>
                <input type="number" class="form-control" value=" <?php echo $riga['AnnoNascita'] ?> " name="AnnoNascita">
              </div>
              <div class="form-group">
                <label> Professione </label>
                <input type="text" class="form-control" value=" <?php echo $riga['Professione'] ?> " name="Professione">
              </div>
              <div class="form-group">
                <label>Foto </label>
                <input type="file" class="form-control-file" value=" <?php echo $riga['Foto'] ?> " name="Foto">
              </div>
              <button type="submit" class="btn btn-info my-4 btn-block w-50 center-block">Salva i dati </button>
            </div>
        </div>
      </div>
    </div>
    </form>
  <?php
  }

  require_once("footer.php")
  ?>


</body>

</html>