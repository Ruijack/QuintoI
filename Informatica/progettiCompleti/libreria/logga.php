<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="user">Username</label>
        <input type="text" id="user" name="user">
        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass">
        <input type="submit" name="logga" value="Logga">
    </form>
    <button><a href="selectLibri.php">Visualizza libri</a></button>
    <?php
    session_start();
        include "connessione.php";

        $conn = mysqli_connect($indirizzoDB, $userDB, $passDB, $nomeDB);
        if (!$conn) {
            die("Errore di connessione: " . mysqli_connect_err());
        }
    
        if(isset($_POST["logga"])){
            if(empty($_POST["user"]) || empty($_POST["pass"])){
                echo("<p>Inserire sia username che password</p>");
            }else{
                $sql = "SELECT * from Utenti 
                where nome='{$_POST["user"]}' and password='{$_POST["pass"]}'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    $_SESSION["loggato"] = true;
                    header("location: menu.php");
                }else {
                    echo("Nome utente o password errati");
                }
            }
        }

    ?>
</body>
</html>