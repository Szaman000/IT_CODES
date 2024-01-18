<?php
$conn = mysqli_connect("localhost", "root", "", "bazaaa");
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
    $sql = "SELECT * FROM tabela1 WHERE lp = '".$_GET['lp']."'";
    $result = mysqli_query($conn, $sql);
    $jest = mysqli_num_rows($result);
    if(empty($jest)){
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
            WHERE id= '".$_GET["akcja"]."'LIMIT 1";
            mysqli_query($conn, $update);
        }
    }
    else{
       echo $_GET['lp']." już jest użyty";
    }
        
    

}
if(isset($_GET['edytuj'])){
    $res = mysqli_query($conn, 'SELECT * FROM tabela1 WHERE id = '.$_GET["edytuj"]);
    $rek = mysqli_fetch_assoc($res);
    $lp = $rek['lp'];
    $imie = $rek['imie'];
    $nazwisko = $rek['nazwisko'];
    $data_ur = $rek['data_ur'];
    $akcja = $rek['id'];
}
else {
    $lp = "";
    $imie = "";
    $nazwisko = "";
    $data_ur = "";
    $akcja = 0;
}
if(isset($_GET['usun'])){
    $delete = "DELETE FROM tabela1 WHERE id = '".$_GET['usun']."' LIMIT 1";
    mysqli_query($conn, $delete);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>title</title>
</head>
<body>
    <form method="get" action="szymanski_sql.php">
            <input type="hidden" name="akcja" value="<?php echo $akcja;?>">
            <input type="number" name="lp"  value="<?php echo $lp;?>">
            <input type="text" name="nazwisko"  value="<?php echo $nazwisko;?>">
            <input type="text" name="imie"  value="<?php echo $imie;?>">
            <input type="date" name="ur"  value="<?php echo $data_ur;?>">
            <button type="submit">Prześlij</button>
        </form>
    <table border="solid">
    <tr>
            <td><a href='szymanski_sql.php?sortlp'>Lp</a></td>
            <td><a href='szymanski_sql.php?sortimie'>Imię</a></td>
            <td><a href='szymanski_sql.php?sortnazwisko'>Nazwisko</a></td>
            <td><a href='szymanski_sql.php?sorturodziny'>Data urodzenia</a></td>
    </tr>
<?php
if(isset($_GET['strona'])){
    if($_GET['strona']==0){
        $_SESSION['pierwszy_rek_na_stronie'] = 0;
    }
    else{
        $_SESSION['pierwszy_rek_na_stronie'] = 5*$_GET['strona'];
    }
}
else{
    $_SESSION['pierwszy_rek_na_stronie'] = 0;
}
if(isset($_SESSION['sortowanie'])){
    $sql = "SELECT * FROM tabela1 ORDER BY ".$_SESSION['sortowanie']." LIMIT ".$_SESSION['pierwszy_rek_na_stronie'].",5";
}
else{
    $sql = "SELECT * FROM tabela1 ORDER BY lp LIMIT 5";
}
 $result = mysqli_query($conn, $sql);
 while($r = mysqli_fetch_assoc($result)){
    echo '<tr>
        <td>'.$r["lp"].'</td>
        <td>'.$r["imie"].'</td>
        <td>'.$r["nazwisko"].'</td>
        <td>'.$r["data_ur"].'</td>
        <td><a href="szymanski_sql.php?edytuj='.$r["id"].'">edytuj</a></td>
        <td><a href="szymanski_sql.php?usun='.$r["id"].'">usuń</a></td>
        </tr>';
 }
?>
</table>
<form method="get" action="szymanski_sql.php">
<?php
    $sql = "SELECT * FROM tabela1 ORDER BY lp";
    $result = mysqli_query($conn, $sql);
    $ile_rek = mysqli_num_rows ($result);
    $ile_stron = ceil($ile_rek / 5);
    for($i=0;$i<$ile_stron;$i++){
        echo "<button type='submit' name='strona'". $i ." value='". $i ."'>". ($i+1) ."</button>";
    }
mysqli_close($conn);
?>
</form>
</body>
</html>