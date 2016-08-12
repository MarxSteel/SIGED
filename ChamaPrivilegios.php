<?php
$PDO = db_connect();

 $QryPrivilegio = $PDO->prepare("SELECT * FROM icbr_privilegios WHERE IDUser='$login'");
 $QryPrivilegio->execute();
  $Valores = $QryPrivilegio->fetch();
  $VarClub = $Valores['EditaClube']; // VALIDA SE PODE OU NÃO EDITAR DISTRITO
  $VarAssociado = $Valores['EditaAssociados']; // VALIDA SE PODE OU NÃO EDITAR DISTRITO
  $VarSecretaria = "disabled"; // VALIDA SE PODE OU NÃO ALTERAR INFORMAÇÕES NA SECRETARIA
  $VarTesouraria = $Valores['Tesouraria'];
?>
