<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scelta dei prodotti</title>
</head>
<body>
    <form action="carrello.php" method="post">
        <select name="prodotto">
            <option value="Samsung">Samsung</option>
            <option value="Alphabet">Alphabet</option>
            <option value="Apple">Apple</option>
            <option value="Microsoft">Microsoft</option>
            <option value="Nintendo">Nintendo</option>
            <option value="TSMC">TSMC</option>
        </select>
        <input type="submit" value="aggiungi" name="aggiungi">
    </form>
</body>
</html>