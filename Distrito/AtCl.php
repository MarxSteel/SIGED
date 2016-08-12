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

$CodClub = $_GET['ID']; 

//CHAMANDO DADOS DE INFORMAÇÃO DO CLUBE

$ChamaClub = $PDO->prepare("SELECT * FROM icbr_clube WHERE icbr_id='$CodClub'");
 $ChamaClub->execute();
  $Clube= $ChamaClub->fetch();
  $ClubeNome = $Clube['icbr_Clube'];
  $RotaryPadrinho = $Clube['icbr_RotaryPadrinho'];
  $DataFundacao = $Clube['icbr_DataFundado'];
  $StatusClub = $Clube['icbr_Status'];
  $SecretarioClub = $Clube['icbr_Secretario'];
  $PresidenteClub = $Clube['icbr_Presidente'];
  $TesoureiroClub = $Clube['icbr_Tesoureiro'];
$teste='teste';

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
    <?php
       if ($VarClub === '22'){
        ?>
    <section class="content">
     <div class="box box-default">
     <div class="box-header with-border">
      <h2 class="box-title">#<?php echo $CodClub; ?> - <strong> Interact Club de <?php echo $ClubeNome; ?></strong></h2>
     </div>
     <div class="box-body">
      <div class="col-xs-9">
       <li class="list-group-item">
        <b>Rotary Club Patrocinador:</b>
        <a class="pull-right"><?php echo $RotaryPadrinho; ?></i></a>
       </li>
       <li class="list-group-item">
        <b>Data de Fundação:</b> 
        <a class="pull-right"><strong><code><?php echo $DataFundacao; ?></code></strong></i></a>
       </li>
       <li class="list-group-item">
        <b>Status:</b>
        <a class="pull-right">
         <?php 
          if($StatusClub === 'A')
          {
            echo '<span class="btn btn-success btn-xs btn-block">ATIVO</span>';  
          }
          elseif($StatusClub === 'D')
          {
            echo '<span class="btn bg-orange btn-xs btn-block">INATIVO</span>';  
          }
          else{
              
          }
         ?>    
        </a>
       </li>
      </div>
      <div class="col-xs-3">
       <li class="list-group-item">
             <img src="<?php echo qrcode("http://interactbrasil.org/clubes/VerClube.php?ID=<?php echo $CodClub; ?>","100"); ?>" />

       </li>
       </div>
      <div class="col-xs-12">
        <h4>CONSELHO DIRETOR</h4>
      </div>
      <div class="col-xs-4">
       <li class="list-group-item">
        <b>PRESIDENTE</b> 
       </li>
       <li class="list-group-item">
        <?php echo $PresidenteClub; ?>
       </li>
      </div>
      <div class="col-xs-4">
       <li class="list-group-item">
        <b>SECRETÁRIO</b> 
       </li>
       <li class="list-group-item">
        <?php echo $SecretarioClub; ?>
       </li>
      </div>
      <div class="col-xs-4">
       <li class="list-group-item">
        <b>TESOUREIRO</b> 
       </li>
       <li class="list-group-item">
        <?php echo $TesoureiroClub; ?>
       </li>
      </div>
     <div class="col-xs-12"> 
      <h4>LISTA DE ASSOCIADOS</h4>
     </div>
      <div class="col-xs-12">
       <form name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
        <table width="400" border="0" align="center">
         <tr>
          <div class="col-xs-12"><br />
            <input name="enviar" type="submit" class="btn btn-success btn-lg btn-block" id="enviar" value="REATIVAR CLUB"  />
          </div>
         </tr>
        </table>
       </form>
       <?php 
        if(@$_POST["enviar"]){
          $executa = $PDO->query("UPDATE icbr_clube SET icbr_Status='A' WHERE icbr_id='$CodClub' ");
             if($executa)
               {
          echo '<script type="text/javascript">alert("Clube reativado com sucesso!");</script>';
          echo '<script type="text/javascript">window.close();</script>'; 
          }
          else{
          echo '<script type="text/javascript">alert("Erro ao reativar club, entre em contato com a Interact Brasil");</script>';
          }
      }
      ?>
           
      </div>
      </div>
     </div>


    </section>
    <?php
       }
       else{
      echo '<section class="content">';
      echo '<div class="box box-default">';
      echo '<div class="box-header with-border">';
      echo '<h2 class="box-title">ATIVAR CLUB</h2>';
      echo '</div>';
      echo '<div class="box-body">';
      echo '<div class="alert alert-danger alert-dismissible">';
      echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
      echo '<h4><i class="icon fa fa-ban"></i> Erro!</h4>';
      echo '<h3>Você não tem privilégios para acessar esta página </h3><br />';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</section>';
       }
       ?>
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
