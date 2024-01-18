<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
<pre>
    <form method="get" action="Tablice-zadanka.php">
        <input type="number" name="ilosc1">
        <input type="number" name="ilosc2">
        <input type="number" name="ilosc3">
        <input type="number" name="ilosc4">
        <input type="number" name="ilosc5">
        <input type="number" name="ilosc6">
        <input type="number" name="ilosc7">
        <input type="number" name="ilosc8">
        <input type="number" name="ilosc9">
        <input type="number" name="ilosc10">
        <button type="submit">Utwórz formularz</button>
    </form>
    
    <?php
        if(isset($_GET['ilosc1'])){
            $t1 = array();
            for($i=1; $i<=10; $i++){
                $t1[] = $_GET["ilosc".$i];
            }
            echo "Wyświetlanie tablicy bez przekształceń: ";
            print_r($t1);
            sort($t1);
            echo "Wyświetlanie tablicy po sortowaniu: ";
            print_r($t1);
            echo 'najmniejszy element ' . $t1[0] . '<br>';
            echo 'największy element ' . $t1[9] . '<br><hr>';
            $suma = 0;
            for($i=0; $i<=9; $i++){
                $suma = $suma + $t1[$i];
            }
            echo "Wyświetlanie średniej sumy wartości tablic: " . $suma/10 . '<br><hr>';
            $trojki = 0;
            for($i=0; $i<=9; $i++){
                if($t1[$i]==3){
                    $trojki++;
                }
            }
            echo "Wyświetlanie ilości liczb trzy: " . $trojki . '<br><hr>';
            sort($t1);
            echo 'Trzy najmniejsze element ' . $t1[0] . ', ' . $t1[1] . ', ' . $t1[2] . '<br>';
            echo 'Trzy największe element ' . $t1[7] . ', ' . $t1[8] . ', ' . $t1[9] . '<br><hr>';
            for($i=0; $i<=9; $i++){
                $t1[$i] = $t1[$i] * $t1[$i];
            }
            print_r($t1); 
            echo "<br><hr>";
            $parz = 0;
            $nparz = 0;
            for($i=0; $i<=9; $i++){
                if($t1[$i] % 2 == 1){
                    $nparz++;
                }
                else{
                    $parz++;
                }
            }
            echo "Ilość liczb parzystych: " . $parz . "<br>";
            echo "Ilość liczb nieparzystych: " . $nparz . "<br><hr>";
            $ptrzy = 0;
            for($i=0; $i<=9; $i++){
                if($t1[$i] % 3 == 0){
                    $ptrzy++;
                }
            }
            echo "Ilość liczb podzielne przez 3: " . $ptrzy . "<br>";
        }
    ?>
</body>
</html>