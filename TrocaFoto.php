<?php

require("restritos.php"); 
require_once 'init.php';
include 'config.php';
include_once("config/conexao.php");

// abre a conexão
$PDO = db_connect();
// seleciona os registros
$IDClube = $_GET['ID'];
 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
      $query->execute();

          $par = $query->fetch();
            $Distrito = $par['Distrito'];
            $LoginNome = $par['Nome'];
            $LoginCargoDistrito = $par['CargoDistrito'];
            $LoginClube = $par['Clube'];
            $LoginCargoClube = $par['CargoClube'];
            $IDUSer = $par['codLogin'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Interact Brasil - SIGED <<Sistema de Gestão Distrital>></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  </head>
  <body class="hold-transition skin-yellow layout-top-nav">
   <div class="wrapper">
<header class="main-header">
 <nav class="navbar navbar-static-top">
  <div class="container">
   <div class="navbar-header">
   <img src="dist/img/ICLogo.png" width="220">
   </div>
   <div class="collapse navbar-collapse pull-left" id="navbar-collapse"></div><!-- /.navbar-collapse -->
   <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
     <li class="dropdown user user-menu">
      <a><span class="hidden-xs">Olá, <?php echo $LoginNome; ?></span></a>
     </li>
    </ul>
   </div>
  </div>
 </nav>
</header>
<!-- QUERY DE DADOS DOS CLUBES -->
<?php
 $associado = $PDO->prepare("SELECT * FROM login WHERE codLogin='$login'");
 $associado->execute();
 $campo = $associado->fetch();
      $Foto = $campo['Foto'];

      ?>
<div class="content-wrapper">
 <div class="container">
  <section class="content-header">
   <div class="box box-default">
    <div class="box-body">
     <div class="box box-primary">
      <div class="box-body box-profile">
       <div class="col-xs-6">
        <h2 class="profile-username text-center"><?php echo $LoginNome; ?></h2><br /> Foto Atual:
       <img class="img-responsive pull-center" src="uploads/<?php echo $Foto; ?>" width="200"><br />
       </div>
       <div class="col-xs-6"><br /><br /><br />Nova Foto:
        <form onsubmit="return valida_form();" name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
        <div>
         <input name="foto" type="file" class="form" id="foto" />      
        </div><br /><br /><br /><br /><br /><br /><br />
        <div>
         <input name="enviar" type="submit" class="btn btn-primary btn-flat btn-block" id="enviar" value="Atualizar Foto" />
        </div>
        </form>
        <?php 
if(@$_POST["enviar"]){
  
  if(pega_ext($_FILES["foto"]["name"]) != "jpg" and pega_ext($_FILES["foto"]["name"]) != "png" and pega_ext($_FILES["foto"]["name"]) != "gif"){
    echo '<script type="text/javascript">alert("Sua foto deve ser no formato JPG, PNG ou GIF.");</script>';
    echo '<script type="text/javascript">location.href="javascript: history.back(0);";</script>';
    exit;
  }
  
  if(@$_FILES["foto"]["name"] == true){
    $foto_form = $_FILES["foto"];
    include_once ("config/upload.php");
      $foto_old = upload_xy ($foto_form, $foto_form, 360, 280);
      $thumb_old = upload_xy ($foto_form, $foto_form, 140, 90);
      $nome_foto = md5(uniqid(time()));
      manipulacao_img($nome_foto, $thumb_old, $foto_old);
      $foto = $nome_foto . '.jpg';
      $thumb = $nome_foto . '_thumb.jpg';
  }

  
  echo '<script type="text/javascript">alert("Foto atualizada no Sistema");</script>';

     $executa = $PDO->query("UPDATE login SET Foto='$foto', Thumb='$thumb' WHERE codLogin='$IDClube'");
   if($executa){
          echo '<script type="text/javascript">alert("Foto Vinculada ao perfil =)");</script>';
          echo '<script type="text/javascript">window.close();</script>';
   }
   else{
      echo '<script type="text/javascript">alert("Erro! <?php print_r($PDO->errorInfo()); ?>");</script>';

   }
  
}
?>
       </div>
      </div><!-- /.box -->
    </div> 
   </div>
  </section>
  <section class="content-header">
   <div clss="main-box-body clearfix">
    <div class="modal fade" id="NovoHexa" tabindex"-1" role="dialog" aria-abeledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true"><code>&times;</code></span>
        </button>
         <h4 class="modal-title">Alterar Foto</h4>
       </div>
      </div><!-- /.box-body -->
     </div>
    </div>
   </div>
  </section>
<?php

include_once 'footer.php';
//FECHANDO QUERY DE DADOS DO CLUB -->
?>
  </div><!-- ./wrapper -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/js/app.min.js"></script>
 </body>
</html>
