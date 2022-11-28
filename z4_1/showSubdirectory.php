<!DOCTYPE html>
<html>
<body>

<?php
session_start();  
$subDirectory = $_GET['link'];
$target_dir = $_SESSION['user'];

$_SESSION['link'] = $subDirectory;

echo "<div style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><h2>Pliki</h2><a href='showDirectory.php'><img src='./levelup.png' style='width: 30px; height: 30px; object-fit:contain; margin-left: 10px;' /></a><a href='uploadFile.php'><img src='./upload.png' style='width: 30px; height: 30px; object-fit:contain; margin-left: 10px;' /></a></div>";

if ($handle = opendir("./{$target_dir}/{$subDirectory}")) {

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if(strpos($entry, ".png") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./imagee.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            } else if(strpos($entry, ".jpg") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./imagee.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            } else if(strpos($entry, ".gif") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./gif.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            } else if(strpos($entry, ".mp3") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./mp3.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            } else if(strpos($entry, ".mp4") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./mp4.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            } else{
                echo "<div style='display: flex; align-items: center;'><a href='showSubdirectory.php?link=$entry' style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./foldericon.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></a><a href='deleteFile.php?link=$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            }
        }
    }

    closedir($handle);
}

?>

</body>
</html>