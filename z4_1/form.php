<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Michał Kurtys</title>
</head>
<BODY>
<a href="logout.php">Logout</a></br>

<p>Wysyłanie plików</p>
<form action="uploadMessage.php" method="post" enctype="multipart/form-data">
Wiadomość:<input type="text" name="post" maxlength="90" size="90"><br>
Select file to upload:
<input type="file" name="fileToUpload" id="fileToUpload"></br>
Adresat:
<select name="recipient">
    <option value=''>-----SELECT-----</option>
    <?php
        $conn = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie3_database");
        $result = mysqli_query($conn, 'SELECT username FROM users');
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='$row[username]'>$row[username]</option>";
        }
    ?>
</select>
<input type="submit" value="Send" name="submit">
</form>


<?php
session_start();
$username = $_SESSION['user'];

$connection = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie3_database");
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}
echo "</br><h2>Wiadomości:</h2>";

if($username == "admin") {
$result = mysqli_query($connection, "Select * from messages Order by idk Desc;") or die ("DB error");
} else {
$result = mysqli_query($connection, "Select * from messages where user='$username' OR recipient='$username' Order by datetime Desc;") or die ("DB error");
}


$images = array();
$audio = array();
$video = array();

while ($row = mysqli_fetch_array ($result))
{
$date= $row[1];
$message= $row[2];
$user= $row[3];
$recipent= $row[4];
$attachment= $row[5];

if(strpos($attachment, ".png") !== false){
    
  echo "<h3>$user - $date:</h3>";
  echo "<p>$message</p>";
  echo "<img style='width: 40vh; height: 40vh; object-fit: contain; border: 2px solid black;' src='./$attachment' /></br></br>";
  echo "</br>";

} else if(strpos($attachment, ".jpg") !== false){
    
  echo "<h3>$user - $date:</h3>";
    echo "<p>$message</p>";
  echo "<img style='width: 40vh; height: 40vh; object-fit: contain; border: 2px solid black;' src='./$attachment' /></br></br>";
  echo "</br>";

}else if(strpos($attachment, ".gif") !== false){
    
  echo "<h3>$user - $date:</h3>";
    echo "<p>$message</p>";
  echo "<img style='width: 40vh; height: 40vh; object-fit: contain; border: 2px solid black;' src='./$attachment' /></br></br>";
  echo "</br>";

}else if(strpos($attachment, ".mp3") !== false){
    
  echo "<h3>$user - $date:</h3>";
    echo "<p>$message</p>";
  echo "<audio controls src='./$attachment'></audio></br></br>";
  echo "</br>";

}else if(strpos($attachment, ".mp4") !== false){
    
  echo "<h3>$user - $date:</h3>";
    echo "<p>$message</p>";
  echo "<video controls muted autoplay><source src='./$attachment' type='video/mp4'></video></br></br>";
  echo "</br>";

} else {

    echo "<h3>$user - $date:</h3>";
    echo "<p>$message</p>";
}

}

mysqli_close($connection);

?>


</BODY>
</HTML>