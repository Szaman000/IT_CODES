<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <?php
    if(count($_GET)==0)
    {
        ?>
        <form method="get" action="Tablice-nazwiska.php">
            <input type="number" name="ilosc">
            <button type="submit">Utwórz formularz</button>
        </form>
        <pre>
        <?php
    }
            if(isset($_GET["ilosc"])){
                echo "<form method='get' action='Tablice-nazwiska.php'>";
                echo "<input type='hidden' name='ile' value='" . $_GET["ilosc"] . "'>";
                for($i=1; $i <= $_GET["ilosc"]; $i++){
                    echo "<input type='text' name='nazwisko" . $i . "'>";
                }
                echo "<button type='submit'>Dodaj</button>";
            }

            if(isset($_GET["nazwisko1"])){
                $t1 = array();
                for($i=1; $i <= $_GET["ile"]; $i++){
                    $t1[] = $_GET["nazwisko".$i];
                }
                sort($t1);
                print_r($t1);
            }
        ?>
</body>
</html>