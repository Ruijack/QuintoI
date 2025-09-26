<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert atleti</title>
</head>
    <?php
$serverName = "10.1.0.52";
$username = "hu";
$passw = "hu";
$database = "hu_olimpiadi";

$conn = mysqli_connect($serverName, $username, $passw, $database);
        if (!$conn) {
            die("Errore connessione: " .mysqli_connect_err());
        }
    ?>
<body>
    <form action="" method="POST">
        <input type="text" id="descrizione" name="descrizione">
        <label for="descrizione">Nome della gara</label><br>
        <select name="genere" id="genere">
            <option value="M">Maschile</option>
            <option value="F">Femminile</option>
        </select>
        <label for="genere">genere</label><br>

        <!-- <input type="text" id="specialita" name="specialita"> -->
        <select name="specialita" id="specialita">
        <?php
            $sql = "select * from specialita";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($riga = mysqli_fetch_assoc($result)){
                    echo "<option value='{$riga["ID_specialita"]}'>{$riga["descrizione"]}</option>";
                }
            }
        ?>
        </select>
        <label for="specialita">Specialità</label><br>

        <input type="submit" name="inserisci" value="Inserisci">
    </form>
    <?php
    

    if (isset($_POST["inserisci"])) {
        
        $sql = "INSERT into gare(descrizione, genere, FK_specialita)
        Values('{$_POST["descrizione"]}', '{$_POST["genere"]}', '{$_POST["specialita"]}')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
    ?>
</body>
</html>