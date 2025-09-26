<?php
$fornitori = "CREATE TABLE fornitori(
    F_id char(11) PRIMARY KEY,
    ragione_sociale varchar(40),
    indirizzo varchar(35),
    cap char(5),
    citta varchar(30))";

$articoli = "CREATE TABLE articoli(
    A_id char(15) PRIMARY KEY,
    descrizione varchar(35),
    quantita int,
    prezzo real,
    FK_fornitore char(11),
    foreign key (FK_fornitore) references fornitori(F_id)
    on UPDATE CASCADE
    on DELETE CASCADE)";
?>