<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login prenotazione eventi</title>
</head>
<body>
    <?php
    include "connEventi.php";
    session_start();
    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    if (!$conn) {
        die("Errore :" .  mysqli_connect_err());    
    }
    ?>
    <form action="" method="post">
        <input type="text" placeholder="Inserire username" name="nome">
        <input type="text" placeholder="Inserire email" name="mail">
        <input type="password" name="passUtente" placeholder="Inserire password">
        <button name="logga">Login</button> 
    </form>

    <?php
        if (isset($_POST["logga"])) {
            //controllo sia lo username che la email dell'utente
            $query = "SELECT utenti.* from utenti 
            where utenti.email = '{$_POST["mail"]}'
            and utenti.username = '{$_POST["nome"]}'
            and utenti.password = '{$_POST["passUtente"]}'";

            $result = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION["loggato"] = true;
                $utente = mysqli_fetch_assoc($result);
                $_SESSION["idUtente"] = $utente["U_id"];
                $_SESSION["ruolo"] = $utente["ruolo"];
                header("location:menu.php");
            }else {
                echo("Email, Nome utente o password errati");
            }
        }
    ?>
</body>
</html>