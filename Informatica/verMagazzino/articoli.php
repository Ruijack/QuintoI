<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Articoli di <?php echo($_GET["fornitore"])?></h1>
    <?php
        include ("connMagazzino.php");
        $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
        $fileLog = fopen("log.txt", "w");
        
        if (!$conn) {
            fwrite($fileLog, "Errore di connessione: " . mysqli_connect_err()) . " " . date_timestamp_get();
            die();
        }

        $fornitore = $_GET["fornitore"];
        $sql = "SELECT * FROM fornitori, articoli 
        WHERE F_id = FK_fornitore and fornitori.ragione_sociale = '" . $fornitore . "'";
        $result = mysqli_query($conn, $sql);
        $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo("<table border='1'>");
    echo("<tr><th>Codice</th><th>Descrizione</th><th>Quantità</th><th>Prezzo</th></tr>");
    foreach ($righe as $riga) {
        echo("<tr>
        <td>{$riga['A_id']}</td>
        <td>{$riga['descrizione']}</td>
        <td>{$riga['quantita']}</td>
        <td>{$riga['prezzo']}</td>
        </tr>");
    }
    echo("</table>");
    ?>
</body>
</html>