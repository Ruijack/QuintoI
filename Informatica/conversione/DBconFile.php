<?php
$serverDB = "10.1.0.52:8306";
$userDB = "hu";
$passDB = "hu";
$nomeDB = "hu_motori";

//https://post.bytes.com/forum/topic/mysql/663967-create-a-mysql-table-from-the-field-headings-line-of-a-csv-file
$conn = mysqli_connect($serverDB, $userDB, $passDB, $nomeDB);
if (!$conn) {
    die("Errore connessione: " . mysqli_connect_err());
}
$file = fopen("Z:\moto.csv", "r") or die("File inapribile!!!");
$nomeTabella = fgets($file);
$strutturaTabella = explode(",", fgets($file));
$testo = [];
foreach($strutturaTabella as $posizione => $dato){
    if ($dato == "char") {
        $testo[]= $strutturaTabella[$posizione - 2] . " char(". $strutturaTabella[$posizione - 1] .") ";
    }else{
        if ($dato == "varchar") {
            $testo[]= $strutturaTabella[$posizione - 2] . " varchar(". $strutturaTabella[$posizione - 1] .") ";
        }else{
            $testo[]= $strutturaTabella[$posizione - 1] ." ". $dato . " ";
        }
    }
}
//funzione se la prima colonna da creare è sempre la chiave primaria
$sql = "CREATE table {$nomeTabella}({$testo})";
// print_r($strutturaTabella);
// echo("\n");
print_r($testo);
?>
