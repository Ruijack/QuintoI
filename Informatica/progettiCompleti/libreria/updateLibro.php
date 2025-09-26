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
    include "connessione.php";

    $conn = mysqli_connect($indirizzoDB, $userDB, $passDB, $nomeDB);

    if(!$conn){
        die("errore di connessione: " . mysqli_connect_err());
    }

    $sql = "Select * from Libri where L_id = '{$_SESSION["libroSelected"]}'";
    $result = mysqli_query($conn, $sql);
    $libroSelezionato = mysqli_fetch_assoc($result);

    ?>
    <form action="" method="post">
        <input type="text" id="nomeLibro" name="nomeLibro" maxlength="25" value=<?php echo "{$libroSelezionato["nome"]}"?>>
        <label for="nomeLibro">Nome</label><br>
        <input type="date" id="dataPubblicazione" name="dataPubblicazione" value= <?php echo "{$libroSelezionato["dataPubblicazione"]}"?>>
        <label for="dataPubblicazione">Data di pubblicazione</label><br>
        <label for="autore">Autore</label>
        <select name="autore" id="autore">
            <?php
                $sql = "select * from Autore";
                $result = mysqli_query($conn, $sql);
                $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($righe as $riga){
                    if($riga["A_id"] == $libroSelezionato["FK_Autore"]){
                        echo "<option value='{$riga["A_id"]}' selected>{$riga['nome']} - {$riga['cognome']}</option>";
                    }else{
                        echo "<option value='{$riga["A_id"]}'>{$riga['nome']} - {$riga['cognome']}</option>";
                    }
                    
                }
            ?>
        </select><br>

        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
        <?php
                $sql = "select * from Categorie";
                $result = mysqli_query($conn, $sql);
                $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($righe as $riga){
                    if($riga["C_id"] == $libroSelezionato["FK_Categoria"]){
                        echo "<option value='{$riga["C_id"]}' selected>{$riga['nome']}</option>";
                    }else{
                        echo "<option value='{$riga["C_id"]}'>{$riga['nome']}</option>";
                    }
                }
            ?>
        </select>

        <input type="submit" name="update" value="Aggiorna">
    </form>
    <?php
        if(isset($_POST["update"])){
            $sql = "UPDATE Libri
            set nome = '{$_POST["nomeLibro"]}',
            dataPubblicazione = '{$_POST["dataPubblicazione"]}',
            FK_Autore = '{$_POST["autore"]}',
            FK_Categoria = '{$_POST["categoria"]}'
            where L_id = '{$libroSelezionato["L_id"]}'";
            $result = mysqli_query($conn, $sql);
            echo("Libro aggiornato con successo");
        }
    ?>
    <button><a href="menu.php">Torna al menu</a></button>
    <button type="button"><a href="logout.php">Logout</a></button>
</body>
</html>