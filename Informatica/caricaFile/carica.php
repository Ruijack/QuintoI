<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
print_r($_FILES);
$conn=mysqli_connect("localhost","root","","5i1");
if(!$conn){
    die("errore connessione");
}
if($_FILES["nomefile"]["error"]==0){
    $contenuto=file($_FILES["nomefile"]["tmp_name"]);
    foreach($contenuto as $riga){
        $r=explode(',',$riga);
        //echo($riga);
        $sql="insert into persona values (null,'$r[0]','$r[1]',$r[2]) ";
        mysqli_query($conn,$sql);
        echo $sql;
    }
mysqli_close($conn);

}else{
    echo ("errore caricamento");
    die();
}

?>
</body>
</html>