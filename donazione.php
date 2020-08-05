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

    <title> Donazioni </title>

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
            <div class="col-md-6">
                <h3 style="text-align: center;"> Campagne Fondi</h3>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"> Codice Campagna </th>
                            <th scope="col"> Stato </th>
                            <th scope="col"> Data Inizio </th>
                            <th scope="col"> Descrizione </th>
                            <th scope="col"> Importo Massimo </th>
                            <th scope="col"> Nome Utente </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $link = mysqli_connect("localhost", "root", "", "nature");
                        if ($link === false) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM campagna_fondi WHERE Stato = 'Aperto' ";
                        $result = mysqli_query($link, $sql);
                        while ($riga = mysqli_fetch_array(($result))) {
                            echo "<tr>
                        <th scope='row' > " . $riga['CodiceCampagna'] . "</th> <td>  " . $riga['Stato'] . "</td><td> " . $riga['DataInizio'] . "</td><td> " . $riga['Descrizione'] . "</td><td> " . $riga['ImportoMassimo'] . "</td><td> " . $riga['NomeUtente'] . "</th></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h3 style="text-align: center;">
                    Donazione
                </h3>
                <form class="text-center border border-light p-5" action="Donazione2.php" method="post">

                    <div class="form-group">
                        <label style="text-align: center; "> Codice Campagna a cui vuoi donare </label>
                        <input type="number" class="form-control" name="codiceCampagnaDonazione" required>
                    </div>

                    <div class="form-group">
                        <label style="text-align: center; "> Importo da devolvere </label>
                        <input type="number" class="form-control" name="importoDonazione" required>
                    </div>

                    <div class="form-group">
                        <label style="text-align: center; "> Note </label>
                        <textarea class="form-control" name="campoNote" placeholder="Testo" rows="4"></textarea>
                    </div>

                    <button type="submit" name="subDonazione" class="btn btn-info my-4 w-50 center-block btn-block"> Invia Donazione </button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>
