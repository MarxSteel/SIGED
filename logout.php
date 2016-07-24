<?php
/* logout.php */
session_start();
unset($_SESSION['MeuLogin']);
header("location: index.php");
?>