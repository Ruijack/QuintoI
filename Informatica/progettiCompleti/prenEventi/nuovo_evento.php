<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento di un evento</title>
</head>
<body>
    <?php

    session_start();
    if (empty($_SESSION["loggato"]) || !$_SESSION["loggato"]) {
        header("location: login.php");
    }else{
        if ($_SESSION["ruolo"] != "admin") {
            header("location: menu.php");
        }
    }

    include "connEventi.php";
    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    if (!$conn) {
        die("Errore:" . mysqli_connect_err());
    }
    ?>
    <h1>Aggiungi un evento</h1>
    <form action="" method="post">
        <label for="nomeEvento">Nome evento:</label>
        <input type="text" max="40" name="nomeEvento" id="nomeEvento">
        <label for="dataEvento">Data: </label>
        <input type="date">
        <label for="postiEvento">Numero posti: </label>
        <input type="number">
        <button name="inserisciEvento">Inserisci</button>
    </form>
    <?php
    if (isset($_POST["inserisciEvento"])) {
        $query = "INSERT into eventi(nome, data, posti)
        Values('{$_POST["nomeEvento"]}', '{$_POST["dataEvento"]}', {$_POST["postiEvento"]})";
        if(!mysqli_query($conn, $query)){
            echo ("Errore con inserimento. ". mysqli_error());
        }
    }
    ?>
    <button><a href="menu.php">menu</a></button>
</body>
</html>