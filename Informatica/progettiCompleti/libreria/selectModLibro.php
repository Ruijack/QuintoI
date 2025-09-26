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
        die("Errore di connessione: " . mysqli_connect_err());
    }
    ?>
    <form action="" method="post">
        <label for="libro">Seleziona il libro da modificare o eliminare</label>
        <select name="libro" id="libro">
        <?php
                $sql = "select * from Libri";
                $result = mysqli_query($conn, $sql);
                $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                foreach($righe as $riga){
                    echo "<option value='{$riga["L_id"]}'>{$riga['nome']}</option>";
                }
            ?>
        </select>
        <button name="modifica">Modifica</button>
        <button name="elimina">Elimina</button>
    </form>
    <button><a href="menu.php">Torna al menu</a></button>

    <?php
        
        if (isset($_POST["elimina"])) {
            $sql = "DELETE from Libri where L_id = '{$_POST["libro"]}'";
            $elimina = mysqli_query($conn, $sql);
            echo("Libro eliminato con successo");
        }

        if (isset($_POST["modifica"])) {
            $_SESSION["libroSelected"] = $_POST["libro"];
            header("location: updateLibro.php");
        }
    ?>
    <button type="button"><a href="logout.php">Logout</a></button>
</body>
</html>