<?php

$conn = mysqli_connect("localhost", "root", "", "bazaaa");
if (mysqli_connect_errno()){
    echo "Błąd połączenia nr: " . mysqli_connect_errno();
    echo "Opis błędu: " . mysqli_connect_error();
    exit();
}
mysqli_query($conn, 'SET NAMES utf8');
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
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
    $update = "UPDATE tabela1 set 
    lp = '".$_GET["lp"]."',
    imie = '". $_GET["imie"]."',
    nazwisko = '".$_GET["nazwisko"]."',
    data_ur = '".$_GET["ur"]."'
    where id=".$_GET["akcja"];
    mysqli_query($conn, $update);
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
    $delete = "DELETE FROM tabela1 WHERE id = '".$_GET['usun']."' limit 1";
    mysqli_query($conn, $delete);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>title</title>
</head>
<body>
    <form method="get" action="sql1.php">
            <input type="hidden" name="akcja" value="<?php echo $akcja;?>">
            <input type="number" name="lp"  value="<?php echo $lp;?>">
            <input type="text" name="nazwisko"  value="<?php echo $nazwisko;?>">
            <input type="text" name="imie"  value="<?php echo $imie;?>">
            <input type="date" name="ur"  value="<?php echo $data_ur;?>">
            <button type="submit">Prześlij</button>
        </form>
    <table border="solid">
        <tr>
            <td>Lp</td>
            <td>Imię</td>
            <td>Nazwsiko</td>
            <td>Data urodzenia</td>
</tr>
<?php
 $sql = "SELECT * FROM tabela1 ORDER BY lp";
 $result = mysqli_query($conn, $sql);
 while($r = mysqli_fetch_assoc($result)){
    echo '<tr>
        <td>'.$r["lp"].'</td>
        <td>'.$r["imie"].'</td>
        <td>'.$r["nazwisko"].'</td>
        <td>'.$r["data_ur"].'</td>
        <td><a href="sql1.php?edytuj='.$r["id"].'">edytuj</a></td>
        <td><a href="sql1.php?usun='.$r["id"].'">usuń</a></td>
        </tr>';
 }
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
</html>