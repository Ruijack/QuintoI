<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutte le prenotazioni</title>
</head>
<body>
    <h1>Prenotazioni</h1>
    <?php
    session_start();
    if (empty($_SESSION["loggato"]) || !$_SESSION["loggato"]) {
        header("location: login.php");
    }

    if ($_SESSION["ruolo"] != "admin") {
        header("location: menu.php");
    }

    include("connEventi.php");

    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    if (!$conn) {
        die("Errore: " . mysqli_connect_err());
    }

    $queryPrenotazioni = "SELECT * from prenotazioni, eventi, utenti
    where prenotazioni.FK_utente = utenti.U_id and
    prenotazioni.FK_evento = eventi.E_id";
    $resultPrenotazioni = mysqli_query($conn, $queryPrenotazioni);
    $prenotazioni = mysqli_fetch_all($resultPrenotazioni, MYSQLI_ASSOC);

    echo("<table border='1'>");
    echo("<tr><th>Username</th><th>Evento</th><th>posti prenotati</th></tr>");
    foreach ($prenotazioni as $prenotazione) {
        echo("<tr>
        <td>{$prenotazione['username']}</td>
        <td>{$prenotazione['nome']}</td>
        <td>{$prenotazione['numPosti']}</td>
        </tr>");
    }
    echo("</table>");
    ?>
</body>
</html>