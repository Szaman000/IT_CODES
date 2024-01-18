<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
 
<form action="zadanieRandomNumGame.php" method="get">
  <input type="submit" value="Run me now!">
  <input type="number" name="numer">
</form>
 
 
 
    ?>
<pre>
<?php
echo '<b>Zmienna $_SERVER:</b><br>';
print_r($_SERVER);
echo '<b><p>Zmienna $_GET:</b><br>';
print_r($_GET);
echo '<b><p>Zmienna $_POST:</b><br>';
print_r($_POST);
echo '<b><p>Zmienna $_FILES:</b><br>';
print_r($_FILES);
echo '<b><p>Zmienna $_SESSION:</b><br>';
session_start();
//session_destroy();
if($_SESSION['liczba'] == 10)
$_SESSION['liczba'] = 1;
if(isset($_SESSION['liczba']))
$_SESSION['liczba']++;
else
$_SESSION['liczba'] = 1;
print_r($_SESSION);
echo '<b><p>Zmienna $_COOKIE:</b><br>';
setcookie("zm1", "jego wartość", time()+3600);
setcookie("zm2", time(), time()+3600);
setcookie("zm3", date('Y-m-d H:i:s'), time()+3600);
print_r($_COOKIE);
?>
 
<?php
 
echo "Hello world!"; // Your code here
print_r($_GET);
if (isset($_GET['numer'])){
$_SESSION['licznik']++;
if ($_GET['numer'] == $_SESSION['number']){
    echo 'wygrales' ;
   echo 'ilosc prob' ;
   echo $_SESSION['licznik'] ;
   echo "<br>" ;
   echo '<form action="zadanieRandomNumGame.php" method="get">
   <input type="submit" value="Zagraj Ponownie">
   
 </form>' ;
}
else {
   
    if ($_GET['numer'] > $_SESSION['number']) {
        echo "twoj numer jest wiekszy od wymyslonego numeru <br> " ;
    }
    else {
        echo "twoj numer jest mniejszy od wymyslonego numeru <br>" ;
    }
}
}
else{
    $_SESSION['number'] = rand(1,1000) ;
    $_SESSION['licznik'] = 0 ;
}
 
 
 
?>
</body>
</html>