<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <?php 
    if(count($_GET)==0){
    ?>
    <form method="get" action="Zad2.php">
        <input type="text" name='login_r' minlength="5" placeholder="Login">
        <input type='password' name="haslo1_r" minlength="5" placeholder="Hasło">
        <input type="password" name="haslo2_r" minlength="5" placeholder="Powtórz Hasło">
        <button type="submit" name="zarejestruj">ZAREJESTRUJ</button>
    </form>
    <?php
    }
        if(isset($_GET["haslo1_r"])){
        if($_GET["haslo1_r"] === $_GET['haslo2_r']){
            setcookie("LOGIN", $_GET['login_r'], time()+300);
            setcookie("HASLO", $_GET['haslo1_r'], time()+300);
            echo "<form method='get' action='Zad2.php'>
                <input type='text' name='login_l' minlength='5' placeholder='Login'>
                <input type='password' name='haslo_l' minlength='5' placeholder='Hasło'>
                <button type='submit' name='zaloguj'>ZALOGUJ</button>
            </form>";
        }
        else{
            header("Location: zad2.php");
            exit;
        }
        }
            if(isset($_GET["login_l"]) && isset($_GET["haslo_l"])){
                if($_GET["login_l"] === $_COOKIE["LOGIN"] && $_GET["haslo_l"] === $_COOKIE["HASLO"]){
                    echo "POPRAWNE<br>" . "Login: " . $_COOKIE["LOGIN"]. "<br>Hasło: " . $_COOKIE["HASLO"] . "<br><a href='zad2.php'>Wyloguj</a>";
                }
                else{
                    echo "<script>history.back()</script>";
                }
            }
    ?>
</body>
</html>