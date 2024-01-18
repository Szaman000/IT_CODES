<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <?php session_start();?>
    <form method="get" action="Zad1.php">
        <input type="number" name="sprawdzana">
        <br>
        <button type="submit">SPRAWDŹ</button>
    </form>
    <pre>
    <?php


        if(!isset($_SESSION['strzaly'])){
            $_SESSION['strzaly'] = 0;
            $_SESSION['szukana'] = rand(1, 1000);
        }
        if(isset($_GET['sprawdzana'])){
            if($_GET['sprawdzana'] < $_SESSION['szukana']){
                echo "Podana liczba jest za mała!";
                $_SESSION['strzaly']++;
            }
            if($_GET['sprawdzana'] > $_SESSION['szukana']){
                echo "Podana liczba jest za duża!";
                $_SESSION['strzaly']++;
            }
            echo $_SESSION['szukana'];
            if($_GET['sprawdzana'] == $_SESSION['szukana']){
                $_SESSION['strzaly']++;
                echo "<button name='resetowanie' value='reset'>Zagraj ponownie</button><br>";
                echo "Trafiłeś dobrą liczbę w ";
                echo $_SESSION['strzaly'] . " strzałach";
                if($_GET['resetowanie'] == 1){
                    session_destroy();
                }
                
            }
        }
        
    ?>
</body>
</html>