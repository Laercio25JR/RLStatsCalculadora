<?php

if (isset($_GET['lang'])) {
    chdir (@$_GET['lang']);
    $lang = @$_GET['lang'];
    include_once "".@$_GET['lang']."/index.php";
} 
else {
    chdir ("en-us");
    $lang = "en-us";
    include_once "en-us/index.php";
}

?>