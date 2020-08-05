<?php
session_start();


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Crea escursione </title>

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
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <h3 style="text-align: center"> Crea una nuova escursione! </h3>
                <form class="text-center border border-light p-5" action="inserimentoEscursione.php" method="post">

                    <div class="form-group">
                        <label style="text-align: center; "> Titolo </label>
                        <input type="text" class="form-control" name="titoloEscursione" required>
                    </div>

                    <div class="form-group">
                        <label style="text-align: center;"> Data </label>
                        <input type="date" class="form-control" name="data" required>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col">
                            <label style="text-align: center;"> Orario di partenza </label>
                            <input type="time" class="form-control" name="orarioPartenza" required>
                        </div>
                        <div class="col">
                            <label style="text-align: center;"> Orario di ritorno </label>
                            <input type="time" class="form-control" name="orarioRitorno" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="text-align: center;"> Tragitto </label>
                        <textarea class="form-control" name="tragitto" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="text-align: center;"> Descrizione </label>
                        <textarea class="form-control" name="descrizione" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="text-align: center; "> N° massimo di partecipanti </label>
                        <input type="number" class="form-control" name="nPartecipanti" require>
                    </div>

                    <button type="submit" name="subEscursione" class="btn btn-info my-4 w-50 center-block"> Crea escursione </button>
                </form>
            </div>
        </div>
    </div>
</body>

<?php require_once("footer.php") ?>

</html>