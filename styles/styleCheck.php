<?php
$styleFile = "";
    if (isset($_COOKIE["siteStyle"])){
        switch ($_COOKIE["siteStyle"]) {
            case 'pink':
                $styleFile = "pink.css";
                break;
            case 'yellow':
                $styleFile = "yellow.css";
                break;
            case 'green':
                $styleFile = "green.css";
                break;
            case 'blue':
                $styleFile = "blue.css";
                break;
        }
    }
?>