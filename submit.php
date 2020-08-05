<!DOCTYPE html>
<html>

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
          $nome = $_POST['nome'];
          $email = $_POST['email'];
          $psw = $_POST['psw'];
          $annoNascita = $_POST['annoNascita'];
          $professione = $_POST['professione'];
          $foto = $_POST['foto'];
          /* Attempt MySQL server connection. Assuming you are running MySQL
          server with default setting (user 'root' with no password) */
          $link = mysqli_connect("localhost", "root", "", "nature");
          // Check connection
          if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
          }
          // Attempt insert query execution
          if ($_POST['foto'] != "") {
            $check = "SELECT nome FROM UTENTE WHERE (Utente.Nome = '$nome')";
            $result = mysqli_query($link, $check);
            $num = mysqli_num_rows($result);
            $sql = "CALL InserisciUtente2('$nome','$email','$psw','$annoNascita', '$professione', '$foto')";
            if ($num == 1) {
              echo ("Il nume utente e' gia' presente nel database. Inserire un nuovo nome utente.");
            } else if (mysqli_query($link, $sql) and $num == 0) {
              echo "La registrazione è avvenuta con successo";
            } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            // Close connection
            mysqli_close($link);
          } else {
            $check = "SELECT nome FROM UTENTE WHERE (Utente.Nome = '$nome')";
            $result = mysqli_query($link, $check);
            $num = mysqli_num_rows($result);
            $sql = "CALL InserisciUtente('$nome','$email','$psw','$annoNascita', '$professione')";
            if ($num == 1) {
              echo ("Il nume utente e' gia' presente nel database. Inserire un nuovo nome utente.");
            } else if (mysqli_query($link, $sql) and $num == 0) {
              echo "La registrazione è avvenuta con successo";

              $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

              $bulk = new MongoDB\Driver\BulkWrite();
              $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Registrazione utente', 'name' => $nome, 'email' => $email, 'password' => $psw, 'annoNascita' => $annoNascita, 'professione' => $professione];
              $bulk->insert($doc);

              $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
            } else {
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
            // Close connection
            mysqli_close($link);
          }
          ?>
          <p style="text-align: center;"> <a href="index.php"> Premere qua per ritornare alla home </a> </p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
