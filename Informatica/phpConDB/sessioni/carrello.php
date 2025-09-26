<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Prodotti selezionati</h1>
    <?php
        session_start();
        if(isset($_POST["svuota"])){
            session_unset();
            session_destroy();
            echo "<p>carrello vuoto</p>";
            echo ("<a href='prodotti.php>Indietro</a>'");
        }else{
            $spesa = $_SESSION["prodotti"];
            $spesa[] = $_POST["prodotto"];
            //$_POST["prodotto"] viene aggiunto all'ultima posizione del vettore
            $_SESSION["prodotti"] = $spesa;
            echo "<ul>";
            foreach($_SESSION["prodotti"] as $p){
                echo "<li>$p</li>";
            }
            echo "</ul>";
            echo ("<a href='prodotti.php>Indietro</a>'");
        }
        
        

    ?>

    <!-- il form ha come method standard post -->
    <form action="">
        <!-- il button ha type predefinito submit -->
        <button name="svuota">Svuota</button>
    </form>

</body>
</html>