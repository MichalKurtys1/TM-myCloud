<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>

<a href="index4.php">Powrót</a>

<?php
session_start();

if (!isset($_SESSION['loggedin']))
{
    header('Location: index3.php');
    exit();
}

//łączenie z bazą danych
$link = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie4_database");
$ipaddress = $_SERVER["REMOTE_ADDR"];

if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }

//pobieranie danych z bazy danych
mysqli_query($link, "SET NAMES 'utf8'");
$result = mysqli_query($link, "SELECT * FROM goscieportalu where ipaddress='$ipaddress'");
    
// tworzenie tabeli zawierającej dane z bazy danych
echo "
 <table>
 <tr>
    <th>IP address</th>
    <th>Przeglądarka</th>
    <th>Monitor</th>
    <th>Ekran</th>
    <th>Kolory</th>
    <th>Język</th>
    <th>Ciasteczka</th>
    <th>Java</th>
    <th>Data</th>
</tr>";

while($rows = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>$rows[1]</td>";
    echo "<td>$rows[2]</td>";
    echo "<td>$rows[3]</td>";
    echo "<td>$rows[4]</td>";
    echo "<td>$rows[5]</td>";
    echo "<td>$rows[6]</td>";
    echo "<td>$rows[7]</td>";
    echo "<td>$rows[8]</td>";
    echo "<td>$rows[9]</td>";
    echo "<td>$rows[10]</td>";
    echo "</tr>";
}
echo "</table>";


?>
</BODY>
</HTML>