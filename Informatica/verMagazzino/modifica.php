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

    if(isset($_POST["articolo"])){
        $sql = "SELECT * from articoli where A_id = '{$_POST["articolo"]}'";
        $result = mysqli_query($conn, $sql);
        $articolo = mysqli_fetch_assoc($result);
    }
    if(!isset($_POST["aggiorna"])){
    ?>
    
    <form action='' method='post'>
        <input value='<?php echo($articolo["descrizione"])?>' type='text' name='newDescrizione'>
        <label>Descrizione</label><br>
        <input value='<?php echo($articolo["quantita"])?>' type='number' name='newQuantita'>
        <label>Quantità</label><br>
        <input value='<?php echo($articolo["prezzo"])?>' type='number' name='newPrezzo'>
        <label>Prezzo</label><br>
        <select name="newfornitore" id="fornitore">
        <?php
            $sql = "SELECT * from fornitori";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($riga = mysqli_fetch_assoc($result)){
                    if($riga["F_id"] == $articolo["FK_articolo"]){
                        echo "<option value='{$riga["F_id"]}' selected>{$riga["ragione_sociale"]}</option>";
                    }else{
                        echo "<option value='{$riga["F_id"]}'>{$riga["ragione_sociale"]}</option>";
                    }
                }
            }
        ?>
    </select>
    <label>Fornitore</label><br>
    <input type="hidden" value="<?php echo($articolo["A_id"])?>" name="idArticolo">
        <input type='submit' name='aggiorna' value='Aggiorna'>
    </form>

    <?php
    }
        if(isset($_POST["aggiorna"])){
            $sql = "update articoli
            set descrizione='{$_POST["newDescrizione"]}',
            quantita='{$_POST["newQuantita"]}',
            prezzo='{$_POST["newPrezzo"]}',
            FK_fornitore = '{$_POST["newfornitore"]}'
            where A_id = '{$_POST["idArticolo"]}'";
            $result = mysqli_query($conn, $sql);
            if(!$result){
                echo("Errore query inserimento");
            }else{
                echo("L'articolo è stato aggiornato");
            }
        }
        mysqli_close($conn);
    ?>

</body>
</html>