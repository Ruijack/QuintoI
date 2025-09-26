<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        $serverName = "10.1.0.52";
        $username = "hu";
        $passw = "hu";
        $database = "hu_olimpiadi";
        $conn = mysqli_connect($serverName, $username, $passw, $database);
        if (!$conn) {
            die("Errore connessione: " .mysqli_connect_err());
        }
    ?>
</head>
<body>
<button><a href="menu.html">Menù</a></button>
    <?php
        if (!isset($_POST["modifica"])) {
            
    ?>
    <form action="" method="post">
    <label for="listaAtleti">Scegli l'atleta da modificare</label>
    <select name="atleti" id="listaAtleti">
        <option >Scegli l'atleta</option>
        <?php
            $sql = "select * from atleti";
            $result = mysqli_query($conn, $sql);
            $idAtleta = $_POST["atleti"];
            if (mysqli_num_rows($result) > 0) {
                while($riga = mysqli_fetch_assoc($result)){
                    echo "<option value='{$riga["ID_atleta"]}'>{$riga["nome"]} - {$riga["cognome"]}</option>";
                }
            }
        ?>
    </select>
    <input type="submit" value="Modifica" name="modifica">
    </form>
    <?php
    }
    
    if (isset($_POST["modifica"])) {
        
        $sql = "select * from atleti where ID_atleta = {$_POST["atleti"]}";
        $result = mysqli_query($conn, $sql);
        $atleta = mysqli_fetch_assoc($result);
        echo "<form action='' method='post'>
            <input value='{$atleta["nome"]}' type='text' name='newNome'>
            <label>Nome</label><br>
            <input value='{$atleta["cognome"]}' type='text' name='newCognome'>
            <label>Cognome</label><br>
            <input value='{$atleta["nazione"]}' type='text' name='newNazione'>
            <label>Nazione</label><br>
            <input type='hidden' name='idAtleta' value='{$_POST["atleti"]}'>

            <input type='submit' name='elimina' value='Elimina'>
            <input type='submit' name='aggiorna' value='Aggiorna'>
            </form>
        ";
        // <input type='radio' name='operazione' value='delete'>
            // <label>Elimina</label><br>
            // <input type='radio' name='operazione' value='alter'>
            // <label>Aggiorna</label>
    }

    if (isset($_POST["elimina"])) {
        $sql = "delete from atleti where ID_atleta = {$_POST["idAtleta"]}";
        $result = mysqli_query($conn, $sql);
        //header : fa il reloard della pagina per aggiornare la select
        header("Location: alter_atleti.php");
        echo("Il record è stato eliminato");
    }

    if (isset($_POST["aggiorna"])) {
        $sql = "update atleti
        set cognome='{$_POST["newCognome"]}', nome='{$_POST["newNome"]}', nazione='{$_POST["newNazione"]}'
        where ID_atleta = {$_POST["idAtleta"]}";
        $result = mysqli_query($conn, $sql);
        header("Location: alter_atleti.php");
        echo("Il record è stato aggiornato");
    }

    mysqli_close($conn);

?>
</body>
</html>