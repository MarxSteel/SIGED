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
 <li><a href="../dashboard.php"><i class="fa fa-home"></i>Início</a></li>
 <li><a href="../MeuPerfil.php"><i class="fa fa-user"></i>Meu Perfil</a></li>
 <li class="treeview active">
  <a href="#">
   <i class="fa fa-building"></i> <span>Distrito <?php echo $Distrito; ?></span>
    <span class="pull-right-container">
     <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
  <?php 
    if ($VarClub === "22") {
      echo '<li>';
      echo '<a href="Clubes.php">';
      echo '<i class="fa fa-industry"></i>';
      echo 'Clubes</a></li>';
    }
    else{
      //SE O PRIVILÉGIO NÃO FOR EXATAMENTE IGUAL AO VALOR, MOSTRE NADA
    }
    if ($VarAssociado === "22") {
      echo '<li>';
      echo '<a href="Associados.php">';
      echo '<i class="fa fa-users"></i>';
      echo 'Associados</a></li>';
    }
    else{

    }
    if ($VarTesouraria === "22") {
      echo '<li>';
      echo '<a href="Tesouraria.php">';
      echo '<i class="fa fa-dollar"></i>';
      echo 'Tesouraria</a></li>';    
    }
    else {
    }
    ?>
  </ul>
 </li>
 <!--
 <li><a href="Projetos.php"><i class="fa fa-archive"></i>Arquivo de Projetos</a></li>
 <li><a href="../Expediente.php"><i class="fa fa-download"></i> Material de Apoio</a></li>
 -->
</ul>