<?php
require("../restritos.php"); 
require_once '../init.php';
$PDO = db_connect();
include_once '../ChamaPrivilegios.php';

 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
 $query->execute();
  $par = $query->fetch();
    $Distrito = $par['Distrito'];
    $LoginNome = $par['Nome'];
    $LoginCargoDistrito = $par['CargoDistrito'];
    $LoginClube = $par['Clube'];
    $LoginCargoClube = $par['CargoClube'];
    $IDUSer = $par['codLogin'];
    $Foto = $par['Foto'];

$IDClube = $_GET['ID'];


 $dadosclube = $PDO->prepare("SELECT * FROM icbr_associado WHERE icbr_uid='$IDClube'");
      $dadosclube->execute();

          $campo = $dadosclube->fetch();
      $NomeCompleto = $campo['icbr_AssNome'];
      $DistritoSocio = $campo['icbr_AssDistrito'];
      $ClubeSocio = $campo['icbr_AssClube'];
      $IDClubeSocio = $campo['icbr_AssClubeID'];
      $CargoSocio = $campo['icbr_AssCargo'];
      $DataPosseSocio = $campo['icbr_DtPosse'];
      $DataNascimentoSocio = $campo['icbr_AssDtNascimento'];
      $StatusSocio = $campo['icbr_AssStatus'];
      $FotoSocio = $campo['icbr_AssFoto'];

      //CHAMANDO ENDEREÇO DO ASSOCIADO
      $RuaSocio = $campo['icbr_AssEndereco']; 
      $NumSocio = $campo['icbr_AssNum']; 
      $BairroSocio = $campo['icbr_AssBairro']; 
      $CidadeSocio = $campo['icbr_AssCidade']; 
      $UFSocio = $campo['icbr_AssUF']; 
      $CEPSocio = $campo['icbr_AssCEP']; 
      $RelID = "ID " . $IDClubeSocio . "." . $IDClube . "." . $DistritoSocio;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIGED - Sistema Integrado de Gestão Distrital | MDIO Interact Brasil</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/css/AdminLTE.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
</head>
<body>
<div class="wrapper">
 <section class="invoice">
  <div class="row">
   <div class="col-xs-12">
    <h2 class="page-header">
     <img class="img-responsive pull-center" src="../dist/img/logo/ICLogo_Azul_GrafEsp.png" width="200">
    </h2>
   </div>
  </div>
  <div class="row invoice-info">
   <div class="col-sm-4 invoice-col">
    <h4><?php echo $NomeCompleto; ?></h4>
    <address>
     <strong><?php echo $ClubeSocio; ?></strong><br>
     Distrito <?php echo $DistritoSocio; ?><br>
     <?php echo $CargoSocio; ?><br>
     Data de Posse: <?php echo $DataPosseSocio; ?>
     Data de Nascimento: <?php echo $DataNascimentoSocio; ?>
    </address>
   </div>
   <div class="col-sm-4 invoice-col">
    <address><br><br>
     <strong><?php echo $RuaSocio . ", " . $NumSocio;?></strong><br>
      <?php echo $BairroSocio; ?><br>
      <?php echo $CidadeSocio . " - " . $UFSocio;?> <br>
      CEP <?php echo $CEPSocio; ?><br>
     </address>
   </div>
   <div class="col-sm-4 invoice-col">
    <img src="../uploads/<?php echo $FotoSocio; ?>" width="140" alt="Foto">
   </div>
  </div>
  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  x CORTE AQUI
  <div class="row">
   <div class="col-xs-6">
    <button class="btn btn-block btn-default btn-xs"> FRENTE </button><br />
    <li class="list-group-item">
     <div class="box box-widget widget-user">
      <div class="widget-user-header bg-black" style="background: url('../dist/img/background.png')"><br /><br /><br /><br />
      </div>
      <div class="widget-user-image">
       <img class="profile-user-img img-responsive img-circle" src="../uploads/<?php echo $FotoSocio; ?>" >
      </div>
      <div class="box-footer">
      <br /><br />
       <h4 style="text-align: center;" class="widget-user-username"><a><?php echo $NomeCompleto; ?></a></h4>
       <h5 style="text-align: center;" class="widget-user-desc"><?php echo $CargoSocio; ?> 
       </h5>
       <div class="row"><br /><br />
        <h4 style="text-align: center;" class="widget-user-username">
         <a> Distrito <?php echo $DistritoSocio; ?></a>
        </h4><br />
        <div class="widget-user-header2 bg-light-blue">
         <h3 style="text-align: center;" class="widget-user-username">
         <strong><?php echo $RelID; ?></strong></h3>
        </div>
       </div>
      </div>
    </li>
   </div>
   <div class="col-xs-6">
    <button class="btn btn-block btn-default btn-xs"> VERSO </button><br />
    <li class="list-group-item">
     <div class="box box-widget widget-user">
      <div class="widget-user-header bg-black" style="background: url('../dist/img/fundo_cracha.png')"><br /><br /><br /><br />
      </div>
      <div class="widget-user-image">
       <img src="<?php echo qrcode2("http://interactbrasil.org/perfil/VerPerfil.php?ID=<?php echo $IDClube; ?>","200"); ?>" />
      </div>
      <div class="box-footer">
      <br />
       <h5 style="text-align: center;">
        <a>Interact Club de <?php echo $ClubeSocio; ?></a><br />
        Data de Posse: <?php echo $DataPosseSocio; ?><br />
        Cargo: <?php echo $CargoSocio; ?><br /><br />
        <img src="../dist/img/assinatura.png" width="100" ><br />
        Mariane Abacherly<br />
        Presidente MDIO Interact Brasil 2016-17
       </h5>
       <div class="row"><br /><br />
        <div class="widget-user-header3 bg-light-blue">
         <h3 style="text-align: center;" class="widget-user-username">
        </div>
       </div>
      </div>
     </div>
    </li>
   </div>
  </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
