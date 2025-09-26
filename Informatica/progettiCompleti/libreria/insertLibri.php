<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert dei libri</title>
</head>
<body>
<?php
    session_start();
    if (!$_SESSION["loggato"]) {
        header("location: logga.php");
    }

    include "connessione.php";

    $conn = mysqli_connect($indirizzoDB, $userDB, $passDB, $nomeDB);
    if (!$conn) {
        die("Errore di connessione: " . mysqli_connect_err());
    }
    ?>
    <form action="" method="post">
        <input type="text" id="nomeLibro" name="nomeLibro" maxlength="25" placeholder="Inserire nome del libro">
        <label for="nomeLibro">Nome</label><br>
        <input type="date" id="dataPubblicazione" name="dataPubblicazione">
        <label for="dataPubblicazione">Data di pubblicazione</label><br>

        <label for="autore">Autore</label>
        <select name="autore" id="autore">
            <?php
                $sql = "select * from Autore";
                $result = mysqli_query($conn, $sql);
                $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($righe as $riga){
                    echo "<option value='{$riga["A_id"]}'>{$riga['nome']} - {$riga['cognome']}</option>";
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
                    echo "<option value='{$riga["C_id"]}'>{$riga['nome']}</option>";
                }
            ?>
        </select>

        <input type="submit" name="inserisci" value="Inserisci">
    </form>
    <button><a href="menu.php">Torna al menu</a></button>
    <button type="button"><a href="logout.php">Logout</a></button>
    <?php
        if(isset($_POST["inserisci"])){
            $sql = "INSERT into Libri(nome, dataPubblicazione, FK_Autore, FK_Categoria)
            Values('{$_POST["nomeLibro"]}', '{$_POST["dataPubblicazione"]}', {$_POST["autore"]}, {$_POST["categoria"]})";
            $inserisce = mysqli_query($conn, $sql);
            echo("Libro registrato con successo");
        }

    ?>

    
</body>
</html>