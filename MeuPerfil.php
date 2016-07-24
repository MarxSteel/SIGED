<?php
/* AreaRestrita.php */
require("restritos.php"); 
require_once 'init.php';
include 'config.php';
include_once("config/conexao.php");

$PDO = db_connect();

 $query = $PDO->prepare("SELECT * FROM login WHERE login='$login'");
      $query->execute();

          $par = $query->fetch();
            $Distrito = $par['Distrito'];
            $LoginNome = $par['Nome'];
            $LoginCargoDistrito = $par['CargoDistrito'];
            $LoginClube = $par['Clube'];
            $LoginCargoClube = $par['CargoClube'];
            $LoginCargoIC = $par['CargoIC'];
            $IDUSer = $par['codLogin'];
            $Foto = $par['Foto'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIGED - Sistema Integrado de Gestão Distrital | MDIO Interact Brasil</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<script>
function limpa() {
if(document.getElementById('foto').value!="") {
document.getElementById('foto').value="";
}
}
</script>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
<div class="wrapper">
 <header class="main-header">
  <a href="#" class="logo">
   <span class="logo-mini"><img src="dist/img/logo/ICLogoMin.png" width="45"></span>
   <span class="logo-lg"><img src="dist/img/logo/ICLogo.png" width="200"></span>
  </a>
  <nav class="navbar navbar-static-top">
   <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Minimizar Navegação</span>
   </a>
   <?php include_once 'SideMenu.php'; ?>
   </nav>
  </header>
  <aside class="main-sidebar">
   <section class="sidebar">
    <?php include_once 'InfoBar.php'; ?>
     <ul class="sidebar-menu">
      <li class="header"></li>
      <li><a href="dashboard.php"><i class="fa fa-home"></i>Início</a></li>
      <li class="active"><a href="#"><i class="fa fa-user"></i>Meu Perfil</a></li>

      <li class="treeview">
        <a href="#">
         <i class="fa fa-building"></i> <span>Distrito <?php echo $Distrito; ?></span>
         <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="Distrito/Clubes.php"><i class="fa fa-industry"></i> Clubes</a></li>
            <li><a href="Distrito/Associados.php"><i class="fa fa-users"></i> Associados</a></li>
            <li><a href="Distrito/Secretaria.php"><i class="fa fa-book"></i> Secretaria</a></li>
            <li><a href="Distrito/Tesouraria.php"><i class="fa fa-dollar"></i> Tesouraria</a></li>
          </ul>
        </li>
        <li><a href="Distrito/Projetos.php"><i class="fa fa-archive"></i>Arquivo de Projetos</a></li>
        <li><a href="ImagemPublica.php"><i class="fa fa-download"></i> Material de Apoio</a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
   <section class="content-header">
    <h1>Perfil de Usuários</h1>
     <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-home"></i> Início</a></li>
      <li><a href="#">Meu Perfil</a></li>
     </ol>
   </section>
   <section class="content">
    <div class="row">
     <div class="col-md-4">
      <div class="box box-primary">
       <div class="box-body box-profile">
        <img class="profile-user-img img-responsive" src="uploads/<?php echo $Foto; ?>" width="200" alt="Perfil">
        <h3 class="profile-username text-center"><?php echo $LoginNome; ?></h3>
        <p class="text-muted text-center"><?php echo $LoginCargoDistrito; ?></p>
        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#trocaFoto">
        Trocar Imagem de Perfil
        </button>
  <div class="modal fade" id="trocaFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <code><span aria-hidden="true">&times;</span></code>
        </button></code>
        <h4 class="modal-title" id="myModalLabel">Trocando Imagem de Perfil</h4>
      </div>
      <div class="modal-body">
       <div class="col-xs-12">
        <form name="trocarFoto" id="name" method="post" action="" enctype="multipart/form-data">
         <div>
          <input name="foto" type="file" class="form" id="foto" onfocus="this.value='';"/>      
         </div><br /><br /><br /><br /><br /><br /><br />
         <div>
          <input name="enviar" type="submit" class="btn btn-primary" id="enviar" value="Atualizar Foto" />
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

     $executa = $PDO->query("UPDATE login SET Foto='$foto', Thumb='$thumb' WHERE codLogin='$IDUSer'");
   if($executa){
echo '
    <script type="text/JavaScript">
  alert("Foto Vinculada ao Perfil");
  location.href="MeuPerfil.php"
    </script>
    ';
   }
   else{
      echo '<script type="text/javascript">alert("Erro! <?php print_r($PDO->errorInfo()); ?>");</script>';

   }
  
}
?>
       </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="col-md-8">
 <div class="box box-primary">
  <div class="box-header with-border">
   <h3 class="box-title">Sobre Mim</h3>
  </div>
  <div class="box-body">
   <p class="text-muted">
    <h3>Interact Club de <?php echo $LoginClube; ?><br />
    <?php echo $LoginCargoClube; ?>
    </h3>
   </p>
   <hr>
    <h3>Distrito <?php echo $Distrito . " - " . $LoginCargoClube; ?></h3>
   <hr>
    <h3> Interact Brasil<br />
     <?php echo $LoginCargoIC; ?>
    </h3>
  </div>
 </div>
</div>
    </section>
  </div>
<?php include_once 'footer.php'; ?>

</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
