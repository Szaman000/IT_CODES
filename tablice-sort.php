<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <form method="get" action="tablice-sort.php">
        <input type="number" name="1">
        <input type="number" name="2">
        <input type="number" name="3">
        <input type="number" name="4">
        <input type="number" name="5">
        <button type="submit">Sortuj</button>
    </form>
    <pre>
    <?php
    
        if(isset($_GET["1"])){
            $t1 = array(
                $_GET["1"],
                $_GET["2"],
                $_GET["3"],
                $_GET["4"],
                $_GET["5"]
            );
            echo 'Tablica ma ' . count($t1) . ' elementów<br>';
            print_r($t1);
            echo '<br><hr><br>';
            sort($t1);
            print_r($t1);
        }
    ?>

</body>
</html>