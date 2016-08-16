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

  // AQUI DECLARO A QUERY DE DADOS DOS CLUBES:
$AssociadosGeral = "SELECT COUNT(*) AS total FROM icbr_associado WHERE icbr_AssDistrito='$Distrito'";
$stmt_count = $PDO->prepare($AssociadosGeral);
$stmt_count->execute();
$VlrGeral = $stmt_count->fetchColumn();
//FINAL: CONTANDO A QUANTIDADE GERAL DE ASSOCIADOS
//INICIO: CONTANDO A QUANTIDADE DE ASSOCIADOS FEMININO
$AssociadosF = "SELECT COUNT(*) AS total FROM icbr_associado WHERE icbr_AssDistrito='$Distrito' AND icbr_AssGenero='F'";
$stmt_count2 = $PDO->prepare($AssociadosF);
$stmt_count2->execute();
$AssF = $stmt_count2->fetchColumn();
//FINAL: CONTANDO A QUANTIDADE DE ASSOCIADOS FEMININO
//INICIO: CONTANDO A QUANTIDADE DE ASSOCIADOS MASCULINO
$AssociadosM = "SELECT COUNT(*) AS total FROM icbr_associado WHERE icbr_AssDistrito='$Distrito' AND icbr_AssGenero='M'";
$stmt_count3 = $PDO->prepare($AssociadosM);
$stmt_count3->execute();
$AssM = $stmt_count3->fetchColumn();
//FINAL: CONTANDO A QUANTIDADE DE ASSOCIADOS MASCULINO
//INICIO: CONTAGEM DE INTERACTIANOS ENTRE 12 E 13:
$Idade12 = "SELECT COUNT(*) AS total FROM icbr_associado WHERE  icbr_AssIdade  BETWEEN '12' AND '13' AND  icbr_AssDistrito='$Distrito'";
$stmt_count4 = $PDO->prepare($Idade12);
$stmt_count4->execute();
$VIdade12 = $stmt_count4->fetchColumn();
//FINAL: CONTAGEM DE INTERACTIANOS ENTRE 12 E 13
//INICIO: CONTAGEM DE INTERACTIANOS ENTRE 14 E 15:
$Idade14 = "SELECT COUNT(*) AS total FROM icbr_associado WHERE  icbr_AssIdade  BETWEEN '14' AND '15' AND  icbr_AssDistrito='$Distrito'";
$stmt_count5 = $PDO->prepare($Idade14);
$stmt_count5->execute();
$VIdade14 = $stmt_count5->fetchColumn();
//FINAL: CONTAGEM DE INTERACTIANOS ENTRE 14 E 15
//INICIO: CONTAGEM DE INTERACTIANOS ENTRE 16 E 18:
$Idade16 = "SELECT COUNT(*) AS total FROM icbr_associado WHERE  icbr_AssIdade  BETWEEN '16' AND '18' AND  icbr_AssDistrito='$Distrito'";
$stmt_count6 = $PDO->prepare($Idade16);
$stmt_count6->execute();
$VIdade16 = $stmt_count6->fetchColumn();
//FINAL: CONTAGEM DE INTERACTIANOS ENTRE 16 E 18
$IdadeGeral = $VIdade12+$VIdade14+$VIdade16;

// AQUI DECLARO A QUERY DE DADOS DOS CLUBES:
$QueryClubes = "SELECT icbr_uid, icbr_AssClube, icbr_AssNome, icbr_AssCargo, icbr_AssDtNascimento FROM icbr_associado WHERE icbr_AssDistrito='$Distrito' AND icbr_AssStatus='A' ORDER BY icbr_AssNome ASC";
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();

//CHAMANDO OS ASSOCIADOS INATIVOS
$QueryClubes2 = "SELECT icbr_uid, icbr_AssClube, icbr_AssNome, icbr_AssCargo, icbr_AssDtNascimento FROM icbr_associado WHERE icbr_AssDistrito='$Distrito' AND icbr_AssStatus='I' ORDER BY icbr_AssNome ASC";
$stmt2 = $PDO->prepare($QueryClubes2);
$stmt2->execute();

$QueryClubes3 = "SELECT * FROM icbr_clube WHERE icbr_Status='A' AND icbr_Distrito='$Distrito'";
// seleciona os registros
$stmt3 = $PDO->prepare($QueryClubes3);
$stmt3->execute();

  $DataCadastro = date("d/m/Y - h:i:s");

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
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  </head>
  <body class="hold-transition skin-blue-light fixed sidebar-mini">
  <div class="wrapper">
   <header class="main-header">
    <a href="#" class="logo">
     <span class="logo-mini"><img src="../dist/img/logo/ICLogoMin.png" width="45"></span>
     <span class="logo-lg"><img src="../dist/img/logo/ICLogo.png" width="200"></span>
    </a>
    <nav class="navbar navbar-static-top">
     <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Minimizar Navegação</span>
     </a>
     <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         <img src="../uploads/<?php echo $Foto; ?>" class="user-image" alt="User Image">
         <span class="hidden-xs"><?php echo $LoginNome; ?></span>
        </a>
        <ul class="dropdown-menu">
         <li class="user-header">
          <img src="../uploads/<?php echo $Foto; ?>" class="img-circle" alt="User">
          <p>
           <?php echo $LoginNome . " - " . $LoginCargoDistrito; ?>
           <small>Interact Club de <?php echo $LoginClube . "<br /> Distrito " . $Distrito; ?></small>
          </p>
         </li>
         <li class="user-body">
          <div class="row">
           <div class="col-xs-12 text-left">
            Interact Club de <?php echo $LoginClube; ?><br />
            <strong><?php echo $LoginCargoClube; ?></strong><br />
           </div>
          </div>
         </li>
         <li class="user-footer">
          <div class="pull-left">
           <a href="../MeuPerfil.php" class="btn btn-success btn-flat">Editar perfil</a>
          </div>
          <div class="pull-right">
           <a href="../logout.php" class="btn btn-danger btn-flat">Sair</a>
          </div>
         </li>
        </ul>
       </li>
      </ul>
     </div>   
    </nav>
   </header>
   <aside class="main-sidebar">
    <section class="sidebar">
     <?php include_once 'InfoBar.php'; ?>
    </section>
   </aside>
   <div class="content-wrapper">
   <section class="content-header">
    <h1>
     Cadastro de Associados
     <small>Distrito <?php echo $Distrito; ?></small>
    </h1>
    <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-home"></i> Início</a></li>
     <li>Distrito <?php echo $Distrito; ?></li>
     <li class="active">Clubs do Distrito</li>
    </ol>
   </section>
   <section class="content"> 
    <div class="row">
     <?php
      if($VarAssociado === '22'){
     ?> 
     <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
         <a data-toggle="modal" data-target="#NovoSocio">
          <span class="info-box-icon btn-primary">
           <i class="fa fa-plus"></i>
          </span>
         </a>
         <div class="info-box-content"><br /><h4>Adicionar Associado</h4>
        </div>
       </div>
      </div>
       <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
         <a data-toggle="modal" data-target="#Stats">
          <span class="info-box-icon btn-primary">
           <i class="fa fa-desktop"></i>
          </span>
         </a>
         <div class="info-box-content"><br /><h4>Estatísticas</h4>
        </div>
       </div>
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
       <div class="info-box"><br />
        <img class="img-responsive pull-center" src="../dist/img/logo/ICLogo_Azul_GrafEsp.png" width="300">
       </div>
      </div>
    <div class="col-md-12 col-sm-6 col-xs-12">
     <div class="info-box"><br />
      <div class="nav-tabs-custom">
       <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#Ativos" data-toggle="tab">Associados ativos</a></li>
        <li><a href="#Inativos" data-toggle="tab">Associados Desligados</a></li>
        <li class="pull-left header">LISTA DE ASSOCIADOS</li>
       </ul>
       <div class="tab-content">
        <div class="tab-pane active" id="Ativos">
        <table id="AssAtivo" class="table table-bordered table-striped table-responsive">
         <thead>
          <tr>
           <th>ID</th>
           <th>Interact Clube de</th>
           <th>Nome</th>
           <th>Data de Nascimento</th>
           <th>Cargo</th>
           <th></th>
          </tr>
         </thead>
         <tbody>
          <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
           <td>
            <?php
             echo $user['icbr_uid'];
             $LinkUser = $user['icbr_uid'];
            ?>
           </td>
           <td><?php echo $user['icbr_AssClube'] ?></td>
           <td><?php echo $user['icbr_AssNome'] ?></td>
           <td><?php echo $user['icbr_AssDtNascimento'] ?></td>
           <td><?php echo $user['icbr_AssCargo'] ?></td>
           <td>
            <a class="btn btn-info btn-sm" href="javascript:abrir('VerSocio.php?ID=<?php echo $LinkUser; ?>');">
             <i class="fa fa-search"></i>Ver Perfil
            </a>                          
            <a class="btn btn-danger btn-sm" href="javascript:abrir('DesativaAssociado.php?ID=<?php echo $LinkUser; ?>');">
             <i class="fa fa-remove"></i>
            </a>
            <a class="btn btn-default btn-sm" href="javascript:abrir('PrintUser.php?ID=<?php echo $LinkUser; ?>');">
             <i class="fa fa-print"> Crachá</i>
            </a>
            <a class="btn bg-orange btn-sm" href="javascript:abrir('PrintUser.php?ID=<?php echo $LinkUser; ?>');">
             <i class="fa fa-print"> Credencial (Padrão RI)</i>
            </a>

           </td>
          </tr>
          <?php endwhile; ?>
         </tbody>
        </table>
        </div>
        <div class="tab-pane" id="Inativos">
        <table id="AssInativo" class="table table-bordered table-striped table-responsive">
         <thead>
          <tr>
           <th>ID</th>
           <th>Interact Clube de</th>
           <th>Nome</th>
           <th>Data de Nascimento</th>
           <th>Cargo</th>
           <th></th>
          </tr>
         </thead>
         <tbody>
          <?php while ($user2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
          <tr>
           <td>
           <?php
             echo $user2['icbr_uid'];
             $LinkUser2 = $user2['icbr_uid'];
            ?>
           </td>
           <td><?php echo $user2['icbr_AssClube'] ?></td>
           <td><?php echo $user2['icbr_AssNome'] ?></td>
           <td><?php echo $user2['icbr_AssDtNascimento'] ?></td>
           <td><?php echo $user2['icbr_AssCargo'] ?></td>
           <td>
            <a class="btn btn-info btn-sm" href="javascript:abrir('VerSocio.php?ID=<?php echo $LinkUser2; ?>');">
             <i class="fa fa-search"></i> Ver Perfil
            </a>
            <a class="btn btn-success btn-sm" href="javascript:abrir('ReativaAssociado.php?ID=<?php echo $LinkUser2; ?>');">
             <i class="fa fa-thumbs-up"></i> Reativar Associado
            </a>
           </td>
          </tr>
          <?php endwhile; ?>
         </tbody>
        </table>
        </div>
        <div class="modal fade" id="NovoSocio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">Adicionando Novo Sócio</h4>
           </div>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Atenção!</h4>
                Obrigatoriamente, é necessário digitar o CPF com Pontos e traços, ou seja: 012.345.678-90.
              </div>
           <div class="modal-body">
            <div class="col-xs-12">
             <form onsubmit="return valida_form();" name="NovoSocio" id="name" method="post" action="" enctype="multipart/form-data">
              <div class="col-xs-8">Nome Completo
               <input type="text" id="nome" name="nome" class="form-control" required="required">
              </div>
              <div class="col-xs-4">CPF
               <input type="text" id="cpf" name="cpf"  minlength="14" maxlength="14" class="form-control" required="required" placeholder="999.999.999-99">

              </div>
              <div class="col-xs-6">Interact Club de:
               <select class="form-control" name="clube" id="clube" required="required">
                <option value="" selected="selected">SELECIONE</option>
                <?php while ($user3 = $stmt3->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $user3['icbr_id'] ?>"><?php echo $user3['icbr_Clube'] ?></option>
                <?php endwhile; ?>
               </select>
              </div>
              <div class="col-xs-6">Cargo
               <select class="form-control" name="cargo" id="cargo" required="required">
                <option value="" selected="selected">SELECIONE</option>
                <option value="Presidente">Presidente</option>
                <option value="Secretario">Secretário</option>
                <option value="2º Secretário">2º Secretário</option>
                <option value="Tesoureiro">Tesoureiro</option>
                <option value="2º Tesoureiro">2º Tesoureiro</option>
                <option value="Diretor de Finanças">Diretor de Finanças</option>
                <option value="Diretor de Internos">Diretor de Internos</option>
                <option value="Diretor de Comunidades">Diretor de Comunidades</option>
                <option value="Diretor de Imagem Publica">Diretor de IP</option>
                <option value="Diretor">Diretor</option>
                <option value="Associado">Associado</option>
                <option value="Ex Associado">Ex Associado</option>
                <option value="Honorário">Honorário</option>
               </select>
              </div>
              <div class="col-xs-4">Data de Posse
               <div class="input-group">
                <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="posse" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
               </div>
              </div>
              <div class="col-xs-4">Data de Nascimento
               <div class="input-group">
                <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="nasc" class="form-control" minlength="10" maxlength="10" OnKeyPress="formatar('##/##/####', this)" required="required">
               </div>
              </div>
              <div class="col-xs-4">Gênero
               <select class="form-control" name="genero" required="required">
                <option value="" selected="selected">SELECIONE</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
               </select>
              </div>
              <br /><h4>Dados de Endereço</h4>
              <div class="col-xs-9">Rua
                <input type="text" id="rua" name="rua" class="form-control" required="required" >
              </div>
              <div class="col-xs-3">Nº
               <input type="text" id="numero" name="numero" class="form-control" required="required"  >
              </div>
              <div class="col-xs-6">Bairro/Setor
               <input type="text" id="bairro" name="bairro" class="form-control" required="required"  >
              </div>
              <div class="col-xs-6">Cidade
               <input type="text" id="cidade" name="cidade" class="form-control" required="required"  >
              </div>
              <div class="col-xs-4">CEP
               <input type="text" id="cep" name="cep" minlength="10" maxlength="10"  class="form-control" required="required"  >
              </div>
              <div class="col-xs-4">Estado
               <select class="form-control" name="uf" id="uf" required="required">
                <option value="" selected="selected">SELECIONE</option>
                <option value="Acre">Acre</option>
                <option value="Alagoas">Alagoas</option>
                <option value="Amapá">Amapá</option>
                <option value="Amazonas">Amazonas</option>
                <option value="Bahia">Bahia</option>
                <option value="Ceará">Ceará</option>
                <option value="Distrito Federal">Distrito Federal</option>
                <option value="Espirito Santo">Espírito Santo</option>
                <option value="Goiás">Goiás</option>
                <option value="Maranhão">Maranhão</option>
                <option value="Mato Grosso">Mato Grosso</option>
                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                <option value="Minas Gerais">Minas Gerais</option>
                <option value="Pará">Pará</option>
                <option value="Paraíba">Paraíba</option>
                <option value="Paraná">Paraná</option>
                <option value="Pernambuco">Pernambuco</option>
                <option value="Piauí">Piauí</option>
                <option value="Rio de Janeiro">Rio de Janeiro</option>
                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                <option value="Rondônia">Rondônia</option>
                <option value="Roraima">Roraima</option>
                <option value="Santa Catarina">Santa Catarina</option>
                <option value="São Paulo">São Paulo</option>
                <option value="Sergipe">Sergipe</option>
                <option value="Tocantins">Tocantins</option>
               </select>
              </div>
              <div class="col-xs-4"><br /></div><br />
               <div><br /><br />
                <input name="btvalidar" type="submit" class="btn btn-primary" id="btvalidar" value="Cadastrar" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               </div>
             </form>
             <?
             if(isset($_POST['btvalidar']))
              {
                $cpf_enviado = validaCPF($_POST['cpf']);
                if($cpf_enviado == true){
            // só continua com as queries se o CPF for validado
              $Nome = $_POST['nome'];
              $Clube = $_POST['clube'];
              $Cargo = $_POST['cargo'];
              $Posse = $_POST['posse'];
              $DtNasc = $_POST['nasc'];
              $Rua = $_POST['rua'];
              $Num = $_POST['numero'];
              $Bairro = $_POST['bairro'];
              $Cidade = $_POST['cidade'];
              $UF = $_POST['uf'];
              $CEP = $_POST['cep'];
              $G = $_POST['genero'];
              $CPF = $_POST['cpf'];

               //AQUI CHAMANDO INFORMAÇÕES DO CLUBE
               $chamaclube = $PDO->prepare("SELECT * FROM icbr_clube WHERE icbr_id='$Clube'");
                $chamaclube->execute();
                $iid = $chamaclube->fetch();
                $NomeClube = $iid['icbr_Clube'];

                $executa = $PDO->query("INSERT INTO icbr_associado (icbr_AssNome, icbr_DtPosse, icbr_AssCargo, icbr_AssClube, icbr_AssClubeID, icbr_AssDistrito, icbr_AssDtNascimento, icbr_AssEndereco, icbr_AssNum, icbr_AssBairro, icbr_AssCidade, icbr_AssUF, icbr_AssCEP, icbr_AssGenero, icbr_AssFoto, icbr_CPF) VALUES ('$Nome', '$Posse', '$Cargo', '$NomeClube', '$Clube', '$Distrito', '$DtNasc', '$Rua', '$Num', '$Bairro', '$Cidade', '$UF', '$CEP', '$G', 'SemFoto.jpg', '$CPF')");
                 if($executa){
                  echo '
                 <script type="text/JavaScript">
                  alert("Associado cadastrado com sucesso!");
                  location.href="Associados.php"
                 </script>';
                }
                else{
                echo '<script type="text/javascript">alert("Erro!' . $PDO->errorInfo() . '");</script>';
                }
  


            




             }
                         elseif($cpf_enviado == false){
            echo '<script type="text/javascript">alert("CPF INVÁLIDO");</script>';
            }
            }
            ?>

          
            </div>
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>
        <div class="modal fade" id="Stats" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">Meu Distrito em Números</h4>
           </div>
           <div class="modal-body">
            <div class="col-xs-6">
             <div class="box box-primary">
              <div class="box-header with-border">
               <h3 class="box-title">Faixa Etária</h3>
              </div>
              <div class="box-body">
               <li class="list-group-item">
                12-13 Anos
                <a class="pull-right">
                 <?php echo $VIdade12; ?>
                 <code>
                   (<?php echo (($VIdade12 / $IdadeGeral)*100); ?>%)
                 </code>
                </a>
               </li>
               <li class="list-group-item">
                 14-15 Anos
                 <a class="pull-right">
                  <?php echo $VIdade14; ?>
                  <code>
                    (<?php echo (($VIdade14 / $IdadeGeral)*100); ?>%)
                  </code>
                 </a>
               </li>
               <li class="list-group-item">
                 16-18 Anos
                 <a class="pull-right">
                  <?php echo $VIdade16; ?>
                  <code>
                    (<?php echo (($VIdade16 / $IdadeGeral)*100); ?>%)
                  </code>
                 </a>
               </li>
              </div>
             </div>
           </div>
            <div class="col-xs-6">
             <div class="box box-primary">
              <div class="box-header with-border">
               <h3 class="box-title">Gênero</h3>
              </div>
              <div class="box-body">
               <li class="list-group-item">
                Masculino
                <a class="pull-right">
                 <?php echo $AssF; ?>
                  <code>
                   (<?php echo (($AssF / $VlrGeral)*100); ?>%)
                 </code>
                </a>
               </li>
               <li class="list-group-item">
               .
               </li>
               <li class="list-group-item">
                 16-18 Anos
                 <a class="pull-right">
                 <?php echo $AssM; ?>
                  <code>
                   (<?php echo (($AssM / $VlrGeral)*100); ?>%)
                 </code>
                 </a>
               </li>
              </div>
             </div>
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>
       </div>
<!-- AQUI COMEÇA A DIV DE LINKS PARA BAIXAR -->
        <div class="modal fade" id="Impressoes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <code><span aria-hidden="true">&times;</span></code>
            </button>
            <h4 class="modal-title" id="myModalLabel">Selecione o tipo de Impressão</h4>
           </div>
           <div class="modal-body">
            <div class="col-xs-6">
            <a class="btn btn-default btn-lg" href="javascript:abrir('PrintUser.php?ID=<?php echo $LinkUser; ?>');">
             <i class="fa fa-print"> Crachá de associado</i>
            </a>

             </div>
           </div>
           <div class="modal-footer"></div>
          </div>
         </div>
        </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>

            <!-- /.tab-content -->
          </div>



     </div>
    </div>
    

   </div>
      <?php
      }
      else {
       echo '<div class="col-xs-12">';
       echo '<div class="info-box">';
       echo '<div class="alert alert-danger alert-dismissible">';
       echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
       echo '<h4><i class="icon fa fa-ban"></i>Erro!</h4>';
       echo '<h3> Você não tem privilégios suficientes para abrir esta página</h3>';
       echo '</div>';
       echo '</div>';
       echo '</div>';
      }
      ?>
      </div>
     </section>
    </div>
  <?php include_once '../footer.php'; ?>
  </div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/fastclick/fastclick.min.js"></script>
<script type="text/javascript" src="formatar_moeda.js"></script>

<script>
      $(function () {
        $('#AssAtivo').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
        $('#AssInativo').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
      });

      <script language="JavaScript">
  function abrir(URL) {
   
    var width = 800;
    var height = 650;
   
    var left = 99;
    var top = 99;
   
    window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
   
  }
  </script>


<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>


      <script language="JavaScript">
function abrir(URL) {
 
  var width = 800;
  var height = 650;
 
  var left = 99;
  var top = 99;
 
  window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');
 
}
</script>
  <?php
function validaCPF($cpf)
{ // Verifiva se o número digitado contém todos os digitos
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
  
  // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
  {
  return false;
    }
  else
  {   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
 
            $d = ((10 * $d) % 11) % 10;
 
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}
  ?>

      
      
      
      
  </body>
  </html>
