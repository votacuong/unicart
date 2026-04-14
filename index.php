<?php 
$url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($url, 'www') === false){
    //header("Location: https://www.abbora.com");
}
require_once(dirname(__FILE__).'/public/index.php');
?>