<?php
 
$conn = mysqli_connect("localhost", "root", "", "tworek");
 
if (mysqli_connect_errno()){
    echo "Błąd połączenia nr: " . mysqli_connect_errno();
    echo "Opis błędu: " . mysqli_connect_error();
    exit();
}
 
session_start();
 
mysqli_query($conn, 'SET NAMES utf8');
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
 
if(isset($_GET['sortlp'])){
    $_SESSION['sortowanie'] = 'lp';
}
if(isset($_GET['sortimie'])){
    $_SESSION['sortowanie'] = 'imie';
}
if(isset($_GET['sortnazwisko'])){
    $_SESSION['sortowanie'] = 'nazwisko';
}
if(isset($_GET['sorturodziny'])){
    $_SESSION['sortowanie'] = 'data_ur';
}
 
 
 
if(isset($_GET["lp"])){
 
if($_GET["akcja"]==0){
 
        $sql = "INSERT INTO tabela1 SET
        lp = '".$_GET["lp"]."',
        imie = '". $_GET["imie"]."',
        nazwisko = '".$_GET["nazwisko"]."',
        data_ur = '".$_GET["ur"]."'";
 
        mysqli_query($conn, $sql);
}
 
else{
 
    $update = "UPDATE tabela1 SET
    lp = '".$_GET["lp"]."',
    imie = '". $_GET["imie"]."',
    nazwisko = '".$_GET["nazwisko"]."',
    data_ur = '".$_GET["ur"]."'
    WHERE id=".$_GET["akcja"];
        mysqli_query($conn, $update);
}
}
 
if(isset($_GET['edytuj'])){
 
    $szukanie_rekordu = mysqli_query($conn, 'SELECT * FROM tabela1 WHERE id = '.$_GET["edytuj"]);
 
    $wyszukane_dane = mysqli_fetch_assoc($szukanie_rekordu);
 
    $lp = $wyszukane_dane['lp'];
    $imie = $wyszukane_dane['imie'];
    $nazwisko = $wyszukane_dane['nazwisko'];
    $data_ur = $wyszukane_dane['data_ur'];
    $akcja = $wyszukane_dane['id'];
}
 
if(isset($_GET['usun'])){
    $delete = "DELETE FROM tabela1 WHERE id = ".$_GET['usun'];
    mysqli_query($conn, $delete);
    $lp = "";
    $imie = "";
    $nazwisko = "";
    $data_ur = "";
    $akcja = 0;
}
 
else {
    $lp = "";
    $imie = "";
    $nazwisko = "";
    $data_ur = "";
    $akcja = 0;
}
 
?>
<!DOCTYPE html>
<html>
<head>
    <title>title</title>
</head>
<body>
    <form method="get" action="sql1+ 2.php">
            <input type="hidden" name="akcja" value="<?php echo $akcja;?>">
            Liczba porządkowa
            <input type="number" name="lp" style='display:block;' value="<?php echo $lp;?>">
            Nazwisko
            <input type="text" name="nazwisko" style='display:block;' value="<?php echo $nazwisko;?>">
            Imię
            <input type="text" name="imie" style='display:block;' value="<?php echo $imie;?>">
            Data urodzenia
            <input type="date" name="ur" style='display:block;' value="<?php echo $data_ur;?>">
            <button type="submit">Prześlij</button>
        </form>
    <table border="solid">
        <tr>
            <td><a href='sql1+ 2.php?sortlp'>Lp</a></td>
            <td><a href='sql1+ 2.php?sortimie'>Imię</a></td>
            <td><a href='sql1+ 2.php?sortnazwisko'>Nazwsiko</a></td>
            <td><a href='sql1+ 2.php?sorturodziny'>Data urodzenia</a></td>
</tr>
   
<?php
if(isset($_GET['strona'])){
    if($_GET['strona'] == 0){
        $_SESSION['nrstrony']= 0;
    }
    else{
        $_SESSION['nrstrony']= 5 * $_GET['strona'];
    }
   
}
else{
    $_SESSION['nrstrony']=0;
}
 
if(isset($_SESSION['sortowanie'])){
    $sql = "SELECT * FROM tabela1 ORDER BY ". $_SESSION['sortowanie'] ." LIMIT ". $_SESSION['nrstrony'] .",5";
}
 
else{
    $sql = "SELECT * FROM tabela1 ORDER BY lp LIMIT 5";
}
echo $sql;
 $result = mysqli_query($conn, $sql);
 
 while($wyszukane_dane = mysqli_fetch_assoc($result)){
 
    echo '<tr>
        <td>'.$wyszukane_dane["lp"].'</td>
        <td>'.$wyszukane_dane["imie"].'</td>
        <td>'.$wyszukane_dane["nazwisko"].'</td>
        <td>'.$wyszukane_dane["data_ur"].'</td>
        <td><a href="sql1+ 2.php?edytuj='.$wyszukane_dane["id"].'">edytuj</a></td>
        <td><a href="sql1+ 2.php?usun='.$wyszukane_dane["id"].'">usuń</a></td>
        </tr>';
 }
?>
</table>
 
        <?php
        $zapytanie_ilosc_rekordow = mysqli_query($conn, "SELECT COUNT(*)  FROM tabela1 AS ilosc_rekordow");
        $ilosc_rekordow = mysqli_fetch_assoc($zapytanie_ilosc_rekordow)['COUNT(*)'];
        $ilosc_przyciskow = ceil($ilosc_rekordow / 5);
        $od_ktorego = 0;
        for($i = 0; $i < $ilosc_przyciskow; $i++){
            echo "
           <form method='get' action='sql1+ 2.php' style='display:inline;'>
                <button type='submit' name='strona'". $i ." value='". $i ."'>". ($i+1) ."</button>
            </form>";
        }
        ?>
       
<?php
print_r($_SESSION);
 
mysqli_close($conn);
?>
</body>
</html>