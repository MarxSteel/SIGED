<?php
  
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost:8889');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'interact');
$GVigente = "1617";
  
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
date_default_timezone_set('America/Sao_Paulo');
  
// inclui o arquivo de funçõees
require_once 'functions.php';


    function qrcode($url, $size){
        if($url && $size = "105"){
        return "http://chart.apis.google.com/chart?cht=qr&chl=".$url."&chs=".$size."x".$size."";
        }
        }

    function qrcode2($url, $size){
        if($url && $size = "150"){
        return "http://chart.apis.google.com/chart?cht=qr&chl=".$url."&chs=".$size."x".$size."";
        }
        }
?> 
