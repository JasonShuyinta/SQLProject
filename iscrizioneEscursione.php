<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Escursioni </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php require_once("header.php") ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 style="text-align: center;">Escursioni</h3>
                <br>
                <table class="table" style="margin-left: -6rem;">
                    <thead>
                        <tr>
                            <th scope="col"> Codice Escursione </th>
                            <th scope="col"> Titolo </th>
                            <th scope="col">Data </th>
                            <th scope="col">Orario Partenza</th>
                            <th scope="col"> Orario Ritorno </th>
                            <th scope="col">Tragitto</th>
                            <th scope="col">Descrizione</th>
                            <th scope="col"> Nome Utente </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $link = mysqli_connect("localhost", "root", "", "nature");
                        if ($link === false) {
                            die("ERROR:Could not connect. " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM escursione ";
                        $result = mysqli_query($link, $sql);
                        while ($riga = mysqli_fetch_array(($result))) {
                            echo "<tr>
                        <th scope='row' > " . $riga['CodiceEscursione'] . "</th> <td>  " . $riga['Titolo'] . "</td><td> " . $riga['DATA'] . "</td><td> " . $riga['OrarioPartenza'] . "</td><td> " . $riga['OrarioRitorno'] . "</td><td> " . $riga['Tragitto'] . "</td><td> " . $riga['Descrizione'] . "</td><td> " . $riga['NomeUtente'] . "</th></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h3 style="text-align: center;">
                    Iscrizione a una escursione
                </h3>
                <form class="text-center border border-light p-5" style="margin-left: 8rem; " action="iscrizioneEscursione2.php" method="post">

                    <div class="form-group">
                        <label style="text-align: center; ">Codice Escursione </label>
                        <input type="number" class="form-control" name="codiceEscursione" required>
                    </div>
                    <button type="submit" name="subDonazione" class="btn btn-info my-4 w-50 center-block btn-block"> Invia Iscrizione </button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>
