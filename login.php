<!DOCTYPE html>
<html>
<br><br><br><br>
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
          <?php
          session_start();
          /* Attempt MySQL server connection. Assuming you are running MySQL
          server with default setting (user 'root' with no password) */
          $link = mysqli_connect("localhost", "root", "", "nature");
          // Check connection
          if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          $nome = $_POST['nome'];
          $psw = $_POST['password'];
          $sql = "SELECT Nome FROM UTENTE WHERE Nome = '$nome' and Password = '$psw'";
          $result = mysqli_query($link, $sql);
          $num = mysqli_num_rows($result);
          if ($num == 1) {
            $_SESSION['nome'] = $nome;
            header('location: home.php');
          } else {
            echo "Nome utente o password errati";
          }
          ?>
          <p style="text-align: center;"> <a href="index.php"> Premera qua per ritornare alla home </a> </p>
        </form>
      </div>
    </div>
  </div>
