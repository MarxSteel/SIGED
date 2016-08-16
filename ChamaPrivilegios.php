<?php
$PDO = db_connect();

 $QryPrivilegio = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
 $QryPrivilegio->execute();
  $Valores = $QryPrivilegio->fetch();
  $VarClub = $Valores['PClube']; // VALIDA SE PODE OU NÃO EDITAR DISTRITO
  $VarAssociado = $Valores['PSocio']; // VALIDA SE PODE OU NÃO EDITAR DISTRITO
  $VarTesouraria = $Valores['PTes'];
  $VarSecretaria = "disabled";
?>
