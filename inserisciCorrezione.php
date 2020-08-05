<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Correzione </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once("header.php");
    $link = mysqli_connect("localhost", "root", "", "nature");

    if ($link == false) {
        die("Error; could not connect " . mysqli_connect_error());
    }

    $codiceClassificazione = $_POST['codiceClassificazione'];
    $_SESSION['codiceClassificazione'] = $codiceClassificazione;


    $query = "SELECT * FROM classificazione WHERE CodiceClassificazione = '$codiceClassificazione' ";

    $result = mysqli_query($link, $query);
    while ($riga = mysqli_fetch_array($result)) { ?>

        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <form class="text-center border border-light p-5" action="verificaCorrezione.php" method="post">
                        <p class="h4 mb-4">Correggi la classificazione</p>
                        <div class="form-group">
                            <label>Codice della classificazione </label>
                            <input type="text" class="form-control" placeholder=" <?php echo $codiceClassificazione ?>" name="codiceClass" disabled>
                        </div>
                        <div class="form-group">
                            <label> Commento </label>
                            <input type="text" class="form-control" value="<?php echo $riga['Commento'] ?>" name="commento">
                        </div>
                        <div class="form-group">
                            <label>Nome Latino</label>
                            <input type="text" class="form-control" value="<?php echo $riga['NomeLatino'] ?>" name="nomeLatino">
                        </div>
                        <button type="submit" class="btn btn-info my-4 btn-block w-50 center-block">Invia la correzione</button>
                    </form>
                </div>
            </div>
        </div>

    <?php
    }
    ?>
    <br><br><br><br><br><br><br><br><br><br><br><br><br>

    <?php require_once("footer.php") ?>
</body>

</html>
