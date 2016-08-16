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
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
   <span class="logo-lg"><img src="../dist/img/logo/ICLogo.png" width="200"></span>
     </div>
     <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Olá, <?php echo $LoginNome; ?></span></a>
       </li>
      </ul>
     </div>
    </div>
   </nav>
  </header>
  <div class="content-wrapper">
   <div class="container">
    <section class="content">
     <div class="box box-default">
     <div class="box-header with-border">
      <h2 class="box-title">#<?php echo $IDClube; ?> - <strong> <?php echo $NomeCompleto; ?></strong></h2>
     </div>
     <div class="alert alert-danger alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
     <h4><i class="icon fa fa-ban"></i> ATENÇÃO!</h4>
      VOCÊ ESTÁ PRESTES A <strong>REATIVAR</strong> ESTE ASSOCIADO. TEM CERTEZA?
     </div>
     <div class="box-body">
      <div class="col-xs-8">
       <li class="list-group-item">
        <b>#<?php echo $IDClubeSocio; ?></b> Interact Club de <?php echo $ClubeSocio; ?>
        <a class="pull-right"></i></a>
       </li>
       <li class="list-group-item">
        <b>Data de Posse:</b> 
        <a class="pull-right">
         <code><?php echo $DataPosseSocio; ?></code>
         </a>
       </li>
       <li class="list-group-item">
        <b>Data de Nascimento:</b> 
        <a class="pull-right">
         <code>
          <?php 
          echo $DataNascimentoSocio; 
            // Separa em dia, mês e ano 
           list($dia, $mes, $ano) = explode('/', $DataNascimentoSocio);  
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y')); 
            $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);  
            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
          echo "</code><strong> Idade: </strong>" . $idade;
          ?>
         </a>
       </li>
       <li class="list-group-item">
        <b>Cargo Atual:</b> 
        <a class="pull-right">
         <code><?php echo $CargoSocio; ?></code>
         </a>
       </li>
      </div>
      <div class="col-xs-4">
       <li class="list-group-item">
        <img src="../uploads/<?php echo $FotoSocio; ?>" width="140" alt="Foto">
       </li>
      </div>

     <div class="col-xs-12"> 
       <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
        <table width="400" border="0" align="center">
         <tr>
          <div class="col-xs-12"><br />
            <input name="enviar" type="submit" class="btn btn-success btn-lg btn-block" id="enviar" value="REATIVAR ASSOCIADO"  />
          </div>
         </tr>
        </table>
       </form>
       <?php 
        if(@$_POST["enviar"]){
          $executa = $PDO->query("UPDATE icbr_associado SET icbr_AssStatus='A' WHERE icbr_uid='$IDClube' ");
             if($executa)
               {
          echo '<script type="text/javascript">alert("Associado Reativado Com Sucesso!");</script>';
          echo '<script type="text/javascript">window.close();</script>'; 
          }
          else{
          echo '<script type="text/javascript">alert("Erro ao desativar associado, entre em contato com a Interact Brasil");</script>';
          }
      }
      ?>
     </div>
      </div>
     </div>


    </section>
  </div>
 </div>
<?php 
include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../dist/js/app.min.js"></script>
</body>
</html>
