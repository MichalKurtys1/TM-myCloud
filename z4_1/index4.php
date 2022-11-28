<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php 
session_start();

if (!isset($_SESSION['loggedin']))
{
    header('Location: index3.php');
    exit();
}

if($_SESSION["brute_force_warning"] == true) {

    $link = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie4_database");
    $ipadres = $_SERVER["REMOTE_ADDR"];

    if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }

    mysqli_query($link, "SET NAMES 'utf8'");
    $result = mysqli_query($link, "SELECT * FROM break_ins WHERE ipaddress='$ipadres' ORDER BY date DESC");
    $rekord = mysqli_fetch_array($result);

    echo "<h3 style='color: red;'>Nastąpiły wielokrtone próby dostania się do tego konta!!!</h3>";
    echo "<h3 style='color: red;'>Data: $rekord[1]</h3>";
    echo "<h3 style='color: red;'>IP address: $rekord[2]</h3>";

    unset($_SESSION["brute_force_warning"]);
    mysqli_close($link);
}

echo "Jesteś zalogowany</br>";
echo '<a href="logout.php">Logout</a>';
?>

<?php

        // połączenie z bazą danych
        $link = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie4_database");

        //pobranie d=adresu IP i danych geolokalizacyjnych
        $ipaddress = $_SERVER["REMOTE_ADDR"];
        function ip_details($ip) {
        $json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
        $details = json_decode ($json);
        return $details;
        }

        if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
        mysqli_query($link, "SET NAMES 'utf8'");
        $random = rand();


        // funkcja sprawdzająca jaką przeglądarke używamy 
        function get_browser_name($user_agent)
        {
            if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
            elseif (strpos($user_agent, 'Edge')) return 'Edge';
            elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
            elseif (strpos($user_agent, 'Safari')) return 'Safari';
            elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
            elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        
            return 'Other';
        }
        $browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);


        // kod javascript pobierający inforamcję o wymiarach monitora i ekranu, kolorach, ciasteczkach, alpetach javy, języku
        //i zapisujący je z cookies 
        echo '<script type="text/JavaScript"> 
                a = window.innerWidth + "x" + window.innerHeight;
                document.cookie="a="+a;
                b = window.screen.width + "x" + window.screen.height;
                document.cookie="b="+b;
                c = screen.colorDepth;
                document.cookie="c="+c;
                d = navigator.language;
                document.cookie="d="+d;
                e = navigator.javaEnabled();
                document.cookie="e="+e;
                f = navigator.cookieEnabled;
                document.cookie="f="+f;
            </script>'
        ;

                // odbieranie danych zapisanych w cookies
                $size = $_COOKIE["a"];
                $_COOKIE["a"] = "";
                $innerSize = $_COOKIE["b"];
                $_COOKIE["b"] = "";
                $colorDepth = $_COOKIE["c"];
                $_COOKIE["b"] = "";
                $language = $_COOKIE["d"];
                $_COOKIE["b"] = "";
                $javaEnabled= $_COOKIE["e"];
                $_COOKIE["b"] = "";
                $cookieEnabled = $_COOKIE["f"];
                $_COOKIE["b"] = "";

                    // wyświetlanie wszystkich potrzebnych linków jeśli wszystko się powiodło
                    echo '</br></br></br><a href="tabela.php">Historia Logowania</a></br>';
                    echo '</br></br><a href="showDirectory.php">Zobacz swój katalog</a></br>';

                if($_SESSION['saved'] == false) {
                // tworzenie zapytania sql tworzącego nowy rekord
                $sql = "INSERT INTO goscieportalu (id, ipaddress, browser, screenSize, screenInnerSize, colorDepth, language, javaEnabled, cookieEnabled) VALUES ('$random','$ipaddress','$browser', '$size',        '$innerSize','$colorDepth','$language','$javaEnabled','$cookieEnabled')";

                if(mysqli_query($link, $sql)){
                    $_SESSION['saved'] = true;
                } else{
                    echo "ERROR: Nie zapisono danych" . mysqli_error($link);
                }
            }

        
        mysqli_close($link);

?>
</BODY>
</HTML>