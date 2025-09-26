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
        if (empty($_SESSION["loggato"])||!$_SESSION["loggato"]) {
            echo "<button><a href='logga.php'>Torna al login</a></button>";
        }else{
            echo "<button><a href='menu.php'>Torna al menu</a></button>";
        }

        include "connessione.php";

        $conn = mysqli_connect($indirizzoDB, $userDB, $passDB, $nomeDB);
    if (!$conn) {
        die("Errore di connessione: " . mysqli_connect_err());
    }

    $sql = "Select Libri.nome as nome, Libri.dataPubblicazione as dataPubblicazione, Categorie.nome as categoria, Autore.nome as autore
    from Libri, Autore, Categorie where A_id = FK_Autore and FK_Categoria = C_id ";
    $result = mysqli_query($conn, $sql);
    $righe = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo("<table border='1'><tr><th>nome</th><th>Data pubblicazione</th><th>Categoria</th><th>Autore</th></tr>");
    foreach($righe as $riga){
         echo "<tr>
            <td>{$riga['nome']}</td><td>{$riga['dataPubblicazione']}</td>
            <td>{$riga['categoria']}</td><td>{$riga['autore']}</td>
            </tr>";
    }
    echo("</table>");
    ?>
    <button type="button"><a href="logout.php">Logout</a></button>
</body>
</html>