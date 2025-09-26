<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutti gli eventi</title>
</head>
<body>
<button><a href="menu.php">menu</a></button>
    <?php
    include("connEventi.php");
    session_start();
    if (empty($_SESSION["loggato"])|| !$_SESSION["loggato"]) {
        header("location: login.php");
    }

    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    if(!$conn){
        die("Errore: " . mysqli_connect_err());
    }

    $queryEventi = "SELECT * FROM eventi";
    $resultEventi = mysqli_query($conn, $queryEventi);
    if (mysqli_num_rows($resultEventi) == 0) {
        echo("<h1>Nessun evento disponibile</h1>");
    }else{
    $eventi = mysqli_fetch_all($resultEventi, MYSQLI_ASSOC);

    
    echo("<table border='1'>");
    echo("<tr><th>nome</th><th>data</th><th>posti disponibili</th></tr>");

    foreach($eventi as $evento){
        $queryPosti = "SELECT sum(prenotazioni.numPosti) as postiPrenotati, eventi.E_id
        FROM eventi, prenotazioni
        where eventi.E_id = prenotazioni.FK_evento
        and eventi.E_id = {$evento['E_id']}
        group by eventi.E_id";
        $posti = 0;
        //calcola i posti disponibili di un evento
        if (mysqli_num_rows($resultPosti = mysqli_query($conn, $queryPosti)) != 0) {
            $rigaPosti = mysqli_fetch_assoc($resultPosti);
            $posti = $rigaPosti["postiPrenotati"];
        }
        $postiRimanenti = $evento['posti'] - $posti;

        echo("<tr>
        <td>{$evento['nome']}</td>
        <td>{$evento['data']}</td>
        <td>{$postiRimanenti}</td>
        </tr>");
    }
    echo("</table>");
}
    ?>

</body>
</html>