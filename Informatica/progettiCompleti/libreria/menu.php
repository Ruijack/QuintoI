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
    if (!$_SESSION["loggato"]) {
        header("location: logga.php");
    }
    ?>
    <button><a href="selectModLibro.php">Modifica libri</a></button>
    <button><a href="insertLibri.php">Inserisci libri</a></button>
    <button><a href="selectLibri.php">Visualizza libri</a></button>

    <button type="button"><a href="logout.php">Logout</a></button>
</body>
</html>