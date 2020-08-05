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
    <?php require_once("header.php"); ?>
    <div class="container" style="margin-top: 10rem;">
        <div class="row">
            <div class="col-md-6 offset-3">
                <!-- Default form register -->
                <form class="border border-light p-5" action="#" method="post">
                    <p class="h4 mb-4">GRAZIE PER l'ISCRIZIONE!</p>

                    <?php

                    $link = mysqli_connect("localhost", "root", "", "nature");

                    if ($link == false) {
                        die("Error: could not connect. " . mysqli_connect_error());
                    }

                    $codiceEscursione = $_POST['codiceEscursione'];
                    $nomeUtente = $_SESSION['nome'];


                    $callProcedure = "CALL InserisciIscrizione('$nomeUtente','$codiceEscursione')";
                    $checkOne = "SELECT * FROM UTENTE WHERE UTENTE.Nome = '$nomeUtente' AND (UTENTE.TipoUtente = 'Premium' OR UTENTE.TipoUtente = 'Semplice') ";
                    $checkTwo = "SELECT * FROM ESCURSIONE WHERE Escursione.CodiceEscursione = '$codiceEscursione'";

                    $result1 = mysqli_query($link, $checkOne);
                    $result2 = mysqli_query($link, $checkTwo);

                    $num1 = mysqli_num_rows($result1);
                    $num2 = mysqli_num_rows($result2);

                    if ($num1 != 1) {
                        echo "Non hai i permessi per iscriverti ";
                    } else if ($num2 != 1) {
                        echo "L'escursione è inesistente ";
                    } else if (mysqli_query($link, $callProcedure) and $num1 == 1 and $num2 == 1) {
                        echo "L'iscrizione è andata a buon fine";

                        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

                        $bulk = new MongoDB\Driver\BulkWrite();
                        $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Iscrizione ad una escursione', 'Codice Escursione' => $codiceEscursione, 'Nome Utente' => $nomeUtente];
                        $bulk->insert($doc);

                        $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
                    } else {
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    ?>

                </form>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br>
    <?php require_once("footer.php") ?>
</body>

</html>
