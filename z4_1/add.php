<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php


$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8");
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");
$passSec = htmlentities ($_POST['passRepeat'], ENT_QUOTES, "UTF-8");
$dirname = "./".$user;
if($pass != $passSec) {
    echo "Hasło błędnie powtórzone";
    echo '</br><a href="/z4/z4_1/rejestruj.php"> Zarejestruj </a>';
    return;
}

$link = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie4_database");

if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
mysqli_query($link, "SET NAMES 'utf8'");
$random = rand();

$sql = "INSERT INTO users (ID, username, password) VALUES ('$random','$user', '$pass')";
if(mysqli_query($link, $sql)){
    echo "Konto stworzone poprawnie";
    echo '</br><a href="/z4/z4_1/index3.php"> Zaloguj </a>';
    mkdir($dirname, 0777, true);
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
?>
</BODY>
</HTML>