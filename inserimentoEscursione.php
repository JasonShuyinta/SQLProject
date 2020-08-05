<?php
session_start();
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
    <?php require_once("header.php") ?>
    <br><br><br>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <form class="border border-light p-5" style="text-align: center;" action="#" method="post">
                    <?php
                    $link = mysqli_connect("localhost", "root", "", "nature");

                    if ($link === false) {
                        die("ERROR:Could not connect . " . mysqli_connect_error());
                    }

                    $nomeUtente = $_SESSION['nome'];
                    $titolo = $_POST['titoloEscursione'];
                    $data = $_POST['data'];
                    $orarioPartenza = $_POST['orarioPartenza'];
                    $orarioRitorno = $_POST['orarioRitorno'];
                    $tragitto = $_POST['tragitto'];
                    $descrizione = $_POST['descrizione'];
                    $nPartecipanti = $_POST['nPartecipanti'];

                    $checkUtente = "SELECT TipoUtente FROM UTENTE WHERE Nome = '$nomeUtente'";
                    $result = mysqli_query($link, $checkUtente);
                    while ($riga = mysqli_fetch_array($result)) {
                        if ($riga['TipoUtente'] != "Premium") {
                            echo "L'utente non ha i permessi per la creazione di un escursione"; ?>
                            <p style="text-align: center;"> <a href="campagna.php"> Premere qua per ritornare alla pagina precedente </a> </p>
                    <?php } else {

                            $query = "CALL InserisciEscursione ('$titolo','$data','$orarioPartenza','$orarioRitorno', '$tragitto', '$descrizione', '$nPartecipanti', '$nomeUtente')";

                            if (mysqli_query($link, $query)) {

                                echo "Hai inserito l'escursione correttamente! ";



                                $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

                                $bulk = new MongoDB\Driver\BulkWrite();
                                $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'azione' => 'Inserimento di una escursione', 'nomeUtente' => $nomeUtente, 'titolo' => $titolo, 'data' => $data, 'orarioParteza' => $orarioPartenza, 'orarioRitorno' => $orarioRitorno, 'tragitto' => $tragitto, 'descrizione' => $descrizione, 'numero Partecipanti' => $nPartecipanti];
                                $bulk->insert($doc);

                                $mng->executeBulkWrite('nature.mongoDBNature', $bulk);
                            } else {

                                echo "La donazione non è andata a buon fine ";
                            }
                        }
                    }

                    ?>
                    <p style="text-align: center;"> <a href="escursione.php"> Premere qua per ritornare alla pagina precedente</a> </p>
                    <p style="text-align: center;"> <a href="home.php"> Premere qua per ritornare alla home </a> </p>

                </form>
            </div>
        </div>
    </div>
    <br><br><br>
    <?php require_once("footer.php") ?>
</body>

</html>
