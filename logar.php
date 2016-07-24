<?php
/* logar.php */
include("config.php");
session_start();

// pegando dados do formulario
$login = str_replace("'","",$_POST["login"]);
$senha = $_POST["senha"];
$senha = md5($senha);

// verificado login no banco de dados
dbcon();

$query = mysql_query("select * from login where login = '$login' and senha = '$senha'");
if (!$query) {
    die("Erro ao select da tabela login. Técnico:" . mysql_error());
}

// verificando se encontrou registros do login e senha no banco de dados.
if (mysql_num_rows($query) > 0) { 
    $dados = mysql_fetch_array($query); // pegando dados do banco.
    $login = $dados["login"];
    $chave = "1a2cf8gk68gj67gf784kh69fo6"; // chave secreca
    $ip = $_SERVER["REMOTE_ADR"]; // ip do usuario
    $hora = time(); // pegado horario atual.
    $chave = md5($login . $chave . $ip . $hora);
    // registrando a session com um array com o codLogin, login e a chave.
    $_SESSION['MeuLogin'] = array("id" => $codLogin,"login" => $login,"chave" => $chave,"hora" => $hora); 
    // redirecionando para a pagina registrada.
    header("location: dashboard.php");
} else { 
    // redirecionando para o formulario de login com o erro.
    header("location: index.php?erro=Usuário ou senha Inválida"); 
}
?>