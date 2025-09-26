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
        <input type="text" id="username" name="username">
        <label for="username">Username</label><br>
        <input type="text" id="email" name="email">
        <label for="email">Email</label><br>
        <input type="password" id="password" name="password">
        <label for="password">Password</label><br>
        <input type="radio" name="sesso" value="F" id="F">
        <label for="F">F</label>
        <input type="radio" name="sesso" value="M" id="M">
        <label for="M">M</label>
        <input type="submit" value="registrati">
    </form>
<?php
if(isset($_POST["registrati"])){
    $query = "INSERT into utenti(username, email, password, sesso)
    values('{$_POST["username"]}', '{$_POST["email"]}', '{$_POST["password"]}', '{$_POST["sesso"]}'";
    if (mysqli_query($conn, $query)) {
        echo "Registrazione completata";
    }else{
        die("Errore: " . mysqli_connect_err());
    }
}
?>
</body>
</html>