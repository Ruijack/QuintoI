<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if (empty($_SESSION["loggato"]) || !$_SESSION["loggato"]) {
        header("location: login.php");
    }
    ?>
    <button><a href="logout.php">Logout</a></button>
    <button><a href="lista_eventi.php">Eventi disponibili</a></button>
    <button><a href="nuova_prenotazione.php">Prenota il tuo posto</a></button>

    <?php
        if($_SESSION["ruolo"] == "admin"){
            echo("<button><a href='nuovo_evento.php'>Crea evento</a></button>");
            echo("<button><a href='lista_prenotazioni.php'>Lista prenotazioni</a></button>");
        }
    ?>
</body>
</html>