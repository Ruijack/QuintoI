<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Esegui insert dai dati del file</h1>
    <form action="" method="post">
        <input type="file" name="file">
        <button name="esegui">Esegui</button>
    </form>
</body>
</html>
<?php
    $data = date('Y-m-d H:i:s');
    include ("connMagazzino.php");
    $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
    $fileLog = fopen("log.txt", "w");

    if (!$conn) {
        fwrite($fileLog, "Errore di connessione: " . mysqli_connect_err());
        die();
    }
    if (isset($_POST["esegui"])) {
        $fileMaga = fopen($_POST["file"], "r");
        if (!isset($fileMaga)) {
            fwrite($fileLog, "File maga inapribile" . " " . $data);
        }

        for ($c = fgets($fileMaga); !empty($c); $c = fgets($fileMaga)) { 
            $riga = explode(",", $c);
            if ($riga[0] === "F") {
                //Controllo duplicati
                $sql = "SELECT F_id from fornitori";
                $result = mysqli_query($conn, $sql);
                $idFornitori = mysqli_fetch_all($result, MYSQLI_NUM);
                $ExFornitore = false;
                foreach($idFornitori as $id){
                    if($riga[1] == $id[0]){
                        $ExFornitore = true;
                    }
                }
                if($ExFornitore){
                    fwrite($fileLog, "Fornitore duplicato : " . $data);
                }else{
                    $sql = "INSERT INTO fornitori(F_id, ragione_sociale, indirizzo, cap, citta)
                    VALUES('{$riga[1]}', '{$riga[2]}', '{$riga[3]}', '{$riga[4]}', '{$riga[5]}')";
                
                    if (!mysqli_query($conn, $sql)) {
                        fwrite($fileLog, "Errore di inserimento: " . $data);
                        die();
                    }
                }

                
            }
            if ($riga[0] === "A") {
                //Controllo duplicati
                $sql = "SELECT A_id from articoli";
                $result = mysqli_query($conn, $sql);
                $idArticoli = mysqli_fetch_all($result, MYSQLI_NUM);
                $ExArticolo = false;
                foreach($idArticoli as $id){
                    if($riga[1] == $id[0]){
                        $ExArticolo = true;
                    }
                }

                //controllo FK
                $sql = "SELECT F_id from fornitori";
                $result = mysqli_query($conn, $sql);
                $idFornitori = mysqli_fetch_all($result, MYSQLI_NUM);
                $ExFornitore = false;
                foreach($idFornitori as $id){
                    if($riga[count($riga) - 1] == $id[0]){
                        $ExFornitore = true;
                    }
                }

                //Inserimento dati
                if ($ExArticolo) {
                    fwrite($fileLog, "Articolo duplicato : " . $data);
                }else{
                    if ($ExFornitore) {
                        if($riga[3] > 0){
                            $sql = "INSERT into articoli(A_id, descrizione, quantita, prezzo, FK_fornitore)
                            VALUES('{$riga[1]}', '{$riga[2]}', {$riga[3]}, {$riga[4]}, '{$riga[5]}')";
                            if (!mysqli_query($conn, $sql)) {
                                fwrite($fileLog, "Errore di inserimento: " . $data);
                            }
                        }else{
                            fwrite($fileLog, "Errore nella quantità degli articoli : " . $data);
                        }
                        
                    }else{
                        fwrite($fileLog, "Errore di chiave esterna : " . $data);
                    }
                }
            }
        }
    }
?>