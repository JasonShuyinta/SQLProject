<?php
session_start();
?>


<!DOCTYPE htm>
<html>

<head>
  <title> Inserisci specie animale </title>
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
    <div class="col-md-6 offset-3">
      <form class="text-center border border-light p-5">
        <h3 style="text-align: center;"> Classifica degli utenti più attivi </h3>
        <p class="h4 mb-4"> in base al numero di segnalazioni </p>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"> N.</th>
              <th scope="col"> Nome </th>
              <th scope="col"> Email </th>
              <th scope="col"> N. Segnalazioni </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $link = mysqli_connect("localhost", "root", "", "nature");
            if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM UTENTE WHERE Nome = ANY (SELECT NomeUtente FROM SEGNALAZIONE)";
            $result = mysqli_query($link, $sql);
            $num = 0;
            while ($riga = mysqli_fetch_array($result)) {
              $num = $num + 1;
              echo "<tr><td>" . $num . "</td><th scope='row'>" . $riga['Nome'] . "</th> <td>  " . $riga['Email'] . "</th> <td>  " . $riga['Contatore'] . "</th></tr>";
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
  <?php require_once("footer.php")?>

</body>

</html>
