<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <form method="get" action="Plik.php">
        Lp. <input type="number" name="lp"> <br>
        Imię <input type="text" name="imie"> <br>
        Nazwisko <input type="text" name="nazwisko"> <br>
        Data urodzenia <input type="date" name="ur"> <br>
        <button type="submit">Dodaj</button>
    </form>
    <?php
        if(isset($_GET['imie'])){
        $plik = fopen('plik.txt', 'a+');
        $zawartosc = $_GET["lp"] . "|" . $_GET["imie"] . "|" . $_GET["nazwisko"] . "|" . $_GET["ur"] . "\n";
        fwrite($plik, $zawartosc);
        fclose($plik);
    }
        $tablica = file('plik.txt');
        $dlugosc = count($tablica);
        echo "
            <table border = 1> 
                <tr>
                <td>Lp.</td>
                <td>Imię</td>
                <td>Nazwisko</td>
                <td>Data urodzenia</td>
                <td>Usuń</td>
                </tr>";
        for($i = 0;$i < $dlugosc;$i++){
        $wartosci = explode("|",$tablica[$i]);
        echo "  <tr>
                <td>".$wartosci[0]."</td>
                <td>".$wartosci[1]."</td>
                <td>".$wartosci[2]."</td>
                <td>".$wartosci[3]."</td>
                <td><a href='plik.php?usun=$i'>usuń</a></td>
                </tr>";
        }
        echo "</table>";
        if(isset($_GET["usun"])){
            unset($tablica[$_GET["usun"].value]);
            
        }
    ?>
</body>
</html>