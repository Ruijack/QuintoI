<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //pre specificare quale file in quale directory modificare o creare, se è la prima volta
        //$file = $_SERVER["DOCUMENT_ROOT"]. "/51/prova.csv";
        include("datiNegozio.php");
    ?>
    <h1>Converte dati del DB a un file csv</h1>
    <form action="" method="GET">
        <label for="tabella">Seleziona una tabella</label>
        <select name="tabella" id="tabella">
            <option value="clienti">clienti</option>
            <option value="prodotti">prodotti</option>
            <option value="acquisti">acquisti</option>
        </select>
        <button name="esporta">Esporta</button>
    </form>

    <?php
        if (isset($_GET["esporta"])) {
            $conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
            if (!$conn) {
                die("Errore connessione: " .mysqli_connect_err());
            }

            if ($_GET['tabella'] === "acquisti") {
                $sql = "SELECT clienti.nome as nomeCliente, clienti.cognome as cognomeCliente,
                prodotti.descrizione as nomeProdotto, prodotti.prezzo as prezzo,
                acquisti.quantita as quantita, acquisti.data_acquisto as data
                FROM acquisti, clienti, prodotti
                WHERE clienti.id_cliente = acquisti.FK_id_cliente
                and acquisti.FK_id_prodotto = prodotti.id_prodotto";
            }else{
                $sql = "SELECT * FROM {$_GET['tabella']}";
            }

            $result = mysqli_query($conn, $sql);

            $dati = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $file = fopen($_GET['tabella'] .".csv", "w") or die("File inapribile!!!");
            $testo = "";
            foreach($dati as $record){
                //altro modo invece del fwrite
                //fput($file, $record, "@");
                foreach($record as $dato){
                    $testo .= $dato . " ,";
                }
                $testo .= ";\n";
            }
            fwrite($file, $testo);
            
            fclose($file);
        }
    ?>
</body>
</html>