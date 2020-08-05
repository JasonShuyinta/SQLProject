<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
    <title> Correzione </title>
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
    <?php require_once("header.php") ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="h4 mb-4">Visualizza Classificazioni</p>
                <div class="form-group">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Codice Classificazione</th>
                                <th scopre="col">Commento</th>
                                <th scope="col">Data</th>
                                <th scope="col">Nome Utente</th>
                                <th scope="col">Codice Segnalazione</th>
                                <th scope="col">Nome Latino</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $link = mysqli_connect("localhost", "root", "", "nature");

                            if ($link == false) {
                                die("Error: Could not connect " . mysqli_connect_error());
                            }
                            $sql = "SELECT * FROM classificazione";
                            $result = mysqli_query($link, $sql);
                            while ($riga = mysqli_fetch_array($result)) {
                                echo "<tr>
                    <th scope='row'> " . $riga['CodiceClassificazione'] . "</th> <td> " . $riga['Commento'] . "</th><td> " . $riga['Data'] . "</th><td> " . $riga['NomeUtente'] . "</th><td> " . $riga['CodiceSegnalazione'] . "</th><td> " . $riga['NomeLatino'] . "</th></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <p class="h4 mb-4" style="text-align: center;"> Correggi la classificazione </p>
                <form class="text-center border border-light p-5" action="inserisciCorrezione.php" method="post">
                    <div class="form-group">
                        <label>Inserisci codice classificazione</label>
                        <input type="number" class="form-control w-50 center-block" name="codiceClassificazione" required>
                    </div>
                    <button type="submit" class="btn btn-info my-4 w-50 center-block btn-block"> Correggi </button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("footer.php") ?>
</body>

</html>
