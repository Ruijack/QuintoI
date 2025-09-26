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
    <h1>Seleziona l'articolo da modificare</h1>
    <form action="modifica.php" method="post">
    <select name="articolo" id="articolo">
        <?php
            $sql = "SELECT * from articoli, fornitori WHERE F_id = FK_fornitore ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($riga = mysqli_fetch_assoc($result)){
                    echo "<option value='{$riga["A_id"]}'>{$riga["descrizione"]} - {$riga["ragione_sociale"]}</option>";
                }
            }
        ?>
    </select>
    <button name="sceltaArticolo">Modifica</button>
</form>
</body>
</html>