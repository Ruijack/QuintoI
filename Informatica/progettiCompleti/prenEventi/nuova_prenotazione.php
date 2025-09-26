<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenota un evento</title>
</head>
<body>
    <?php
        session_start();
        if (empty($_SESSION["loggato"]) || !$_SESSION["loggato"]) {
            header("location: login.php");
        }

        include("connEventi.php");
        $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
        if(!$conn){
            die("Errore: " . mysqli_connect_err());
        }
    ?>
    <h1>Prenota il tuo evento</h1>
    <form action="" method="post">
        <label for="eventi">Seleziona l'evento</label>
        <select name="evento" id="eventi">
            <?php
                $queryEventi = "SELECT * from eventi";
                $resultEventi = mysqli_query($conn, $queryEventi);
                $tabellaEventi = mysqli_fetch_all($resultEventi, MYSQLI_ASSOC);
                foreach($tabellaEventi as $evento){
                    echo("<option value ='{$evento["E_id"]}'>{$evento["nome"]}</option>");
                }
            ?>
        </select><br>
        <label for="posti">Quanti siete:</label>
        <input type="number" name="numPosti" id="posti">
        <button name="prenota">Prenota</button>
    </form>
    <?php
        if (isset($_POST["prenota"])) {
            $sqlInserisci = "INSERT into prenotazioni(FK_utente, FK_evento, numPosti)
            Values({$_SESSION['idUtente']}, {$_POST['evento']}, {$_POST['numPosti']})";
            if (!mysqli_query($conn, $sqlInserisci)) {
                echo("Problema nella prenotazione");
            }else{
                echo("Perfetto, la prenotazione è stata un successo");
            }
        }
    ?>
</body>
</html>