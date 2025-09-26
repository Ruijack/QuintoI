<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include ("connMagazzino.php");
    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    $fileLog = fopen("log.txt", "w");
    
    if (!$conn) {
        fwrite($fileLog, "Errore di connessione: " . mysqli_connect_err()) . " " . date_timestamp_get();
        die();
    }
    ?>
    <h1>Mostra gli articoli che sono inferiori a una quantità specifica</h1>
    <form action="" method="get">
        <input type="number" name ="quantita" >
        <button name="mostra">Mostra</button>
    </form>
    <?php
    

        if(isset($_GET["mostra"])){
            $sql = "SELECT * FROM articoli, fornitori 
            WHERE F_id = FK_fornitore and articoli.quantita < " . $_GET["quantita"];
            $result = mysqli_query($conn, $sql);
            $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);

            echo("<table border='1'>");
    echo("<tr><th>Codice</th><th>Descrizione</th><th>Quantità</th><th>Prezzo</th><th>Fornitore</th></tr>");
    foreach ($righe as $riga) {
        echo("<tr>
        <td>{$riga['A_id']}</td>
        <td>{$riga['descrizione']}</td>
        <td>{$riga['quantita']}</td>
        <td>{$riga['prezzo']}</td>
        <td>{$riga['ragione_sociale']}</td>
        </tr>");
    }
    echo("</table>");
        }
    ?>
</body>
</html>