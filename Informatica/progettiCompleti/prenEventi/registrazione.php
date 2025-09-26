<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<?php
    include "connEventi.php";
    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    if(!$conn){
        die("Errore connessione: " . mysqli_connect_err());
    }
?>
<body>
    <h1>Registrazione</h1>
    <form action="" method="post">
        <input type="text" id="nomeUtente" name="nomeUtente">
        <label for="nomeUtente">Username</label><br>
        <input type="text" id="email" name="email">
        <label for="email">Email</label><br>
        <input type="password" id="passUtente" name="passUtente">
        <label for="passUtente">Password</label><br>
        <input type="radio" name="sesso" value="F" id="F">
        <label for="F">F</label>
        <input type="radio" name="sesso" value="M" id="M">
        <label for="M">M</label>
        <input type="submit" name="registrati" value="Registrati">
    </form>
    <button><a href="login.php">Vai il login</a></button>
<?php
if(isset($_POST["registrati"])){
    $username = strtolower(trim($_POST["nomeUtente"]));
    $emailUtente = strtolower(trim($_POST["email"]));
    $query = "INSERT into utenti(username, email, password, sesso)
    values('$username', '$emailUtente', '{$_POST["passUtente"]}', '{$_POST["sesso"]}')";
    if (mysqli_query($conn, $query)) {
        echo "Registrazione completata";
    }else{
        die("Errore: " . mysqli_connect_err());
    }
}
?>
</body>
</html>