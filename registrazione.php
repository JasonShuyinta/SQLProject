<?php
$mysql_host = "localhost";
$mysql_database = "nature";
$mysql_user = "root";
$mysql_password = "";
# MySQL with PDO_MYSQL
$db = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

?>

<!DOCTYPE html>
<html>
<br><br><br>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> Nature </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-3">
        <!-- Default form register -->
        <form class="text-center border border-light p-5" action="submit.php" method="post">
          <p class="h4 mb-4">WELCOME TO NATURE!</p>
          <div class="form-row mb-4">
            <div class="col">
              <!-- First name -->
              <input type="text" name="nome" class="form-control" placeholder="Nome" required>
            </div>
          </div>
          <!-- E-mail -->
          <div class="form-row mb-2">
            <div class="col">
              <input type="email" name="email" class="form-control mb-4" placeholder="E-mail" required>
            </div>
            <!-- Password -->
            <div class="col">
              <input type="password" name="psw" class="form-control" placeholder="Password" required>
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col">
              <!-- Anno nascita  -->
              <input type="number" name="annoNascita" class="form-control" placeholder="Anno di nascita" required>
            </div>
            <div class="col">
              <input type="text" name="professione" class="form-control" placeholder="Professione" required>
            </div>
          </div>
          <form>
            <div class="form-group">
              <label for="file" class="inserimentoFoto">Inserisci foto </label>
              <input type="file" class="form-control-file " name="foto">
            </div>
            <button type="submit" name="submit" class="btn btn-info my-4 btn-block">Submit</button>
          </form>
      </div>
    </div>
  </div>
</body>

</html>
