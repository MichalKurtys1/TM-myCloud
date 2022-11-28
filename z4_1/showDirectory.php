<!DOCTYPE html>
<html>
<body>
<a href="index4.php">Powrót</a>
<?php
session_start();
$target_dir = $_SESSION['user'];
unset($_SESSION['link']);

if($_SESSION['notEmpty']) {
    echo "<h2 style='color: red;'>Folder nie jest pusty!!!</h2>";
    $_SESSION['notEmpty'] = false;
}

echo "<div style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><h2>Pliki</h2><a href='addDirectory.php'><img src='./folderplus.png' style='width: 30px; height: 30px; object-fit:contain; margin-left: 10px;' /></a><a href='uploadFile.php'><img src='./upload.png' style='width: 30px; height: 30px; object-fit:contain; margin-left: 10px;' /></a></div>";

if ($handle = opendir("./{$target_dir}")) {

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if(strpos($entry, ".png") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./imagee.png' style='width: 30px; height: 30px; object-fit:contain;' /><a href='./{$target_dir}/{$entry}' download>$entry</a></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
                echo "<img style='width: 40vh; height: 40vh; object-fit: contain; border: 2px solid black;' src='./{$target_dir}/{$entry}' /></br></br>";
            } else if(strpos($entry, ".jpg") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./imagee.png' style='width: 30px; height: 30px; object-fit:contain;' /><a href='./{$target_dir}/{$entry}' download>$entry</a></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
                echo "<img style='width: 40vh; height: 40vh; object-fit: contain; border: 2px solid black;' src='./{$target_dir}/{$entry}' /></br></br>";
            } else if(strpos($entry, ".gif") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./gif.png' style='width: 30px; height: 30px; object-fit:contain;' /><a href='./{$target_dir}/{$entry}' download>$entry</a></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
                echo "<img style='width: 40vh; height: 40vh; object-fit: contain; border: 2px solid black;' src='./{$target_dir}/{$entry}' /></br></br>";
            } else if(strpos($entry, ".mp3") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./mp3.png' style='width: 30px; height: 30px; object-fit:contain;' /><a href='./{$target_dir}/{$entry}' download>$entry</a></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
                echo "<audio controls src='./{$target_dir}/{$entry}'></audio></br></br>";
            } else if(strpos($entry, ".mp4") !== false){
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./mp4.png' style='width: 30px; height: 30px; object-fit:contain;' /><a href='./{$target_dir}/{$entry}' download>$entry</a></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
                echo "<video controls muted><source src='./{$target_dir}/{$entry}' type='video/mp4'></video></br></br>";
            } else if(is_dir("./{$target_dir}/{$entry}")){
                echo "<div style='display: flex; align-items: center;'><a href='showSubdirectory.php?link=$entry' style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./foldericon.png' style='width: 30px; height: 30px; object-fit:contain;' /><p>$entry</p></a><a href='deleteFile.php?link=$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            } else {
                echo "<div style='display: flex; align-items: center;'><p style='color: black; text-decoration: none; font-weight: bold; display: flex; align-items: center;'><img src='./unkown.png' style='width: 30px; height: 30px; object-fit:contain;' /><a href='./{$target_dir}/{$entry}' download>$entry</a></p><a href='deleteFile.php?link=$subDirectory/$entry'><img src='./delete.png' style='width: 20px; height: 20px; object-fit:contain; margin-left: 10px;' /></a></div>";
            }
        }
    }

    closedir($handle);
}

?>

</body>
</html>