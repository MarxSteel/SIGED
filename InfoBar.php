<div class="user-panel">
 <div class="pull-left image">
  <img src="uploads/<?php echo $Foto; ?>" class="img-circle" alt="User Image">
 </div>
 <div class="pull-left info">
  <p><?php echo $LoginNome; ?></p>
 </div>
</div>
<form action="#" method="get" class="sidebar-form">
 <div class="input-group">
  Distrito <?php echo $Distrito; ?><br /><?php echo $LoginCargoDistrito; ?>
 </div>
</form>
<ul class="sidebar-menu">
 <li class="header"></li>
 <li class="active"><a href="#"><i class="fa fa-home"></i>Início</a></li>
 <li><a href="MeuPerfil.php"><i class="fa fa-user"></i>Meu Perfil</a></li>
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