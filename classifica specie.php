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
    <div class="row">
      <form class="text-center border border-light p-5">
        <p class="h4 mb-4">Classifica delle specie in base alle segnalazioni</p>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"> N.</th>
              <th scope="col"> Nome in latino </th>
              <th scope="col"> Classe</th>
              <th scope="col"> Nome in italiano </th>
              <th scope="col"> Anno di classificazione </th>
              <th scope="col"> Livello di vulnerabilità </th>
              <th scope="col"> Link di Wikipedia </th>
            </tr>
          </thead>
          <tbody>
            <?php
            $link = mysqli_connect("localhost", "root", "", "nature");
            if ($link === false) {
              die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM SPECIE WHERE NomeLatino = ANY (SELECT DISTINCT(NomeLatino) FROM SEGNALAZIONE)";
            $result = mysqli_query($link, $sql);
            $num = 0;
            while ($riga = mysqli_fetch_array($result)) {
              $num = $num + 1;
              echo "<tr><td>" . $num . "</td><th scope='row'>" . $riga['NomeLatino'] . "</th> <td>  " . $riga['Classe'] . "</th> <td>  " . $riga['NomeItaliano'] . "</th> <td>" . $riga['AnnoClassificazione'] . "</th> <td>" . $riga['LivelloVulnerabilita'] . "</th> <td>" . $riga['LinkWikipedia'] . "</th></tr>";
            }

            ?>
          </tbody>
        </table>
          </form>
    </div>
  </div>
  <br><br><br><br><br><br><br>
  <?php require_once("footer.php")?>

</body>

</html>
