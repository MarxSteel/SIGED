<?php
/* AreaRestrita.php */
require("../restritos.php"); 
require_once '../init.php';
$PDO = db_connect();
$DtApr = date('d/m/Y H:i:s');



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




$DataCadastro = date("d/m/Y - h:i:s");
$idProjeto = $_GET['ID'];

$QueryClubes = "SELECT icbr_hpid, p_DtCadastro, p_DtResposta, p_UsrCadastro, p_Pergunta, p_Resposta FROM icbr_historicoprojeto WHERE p_id='$idProjeto'";
// seleciona os registros
$stmt = $PDO->prepare($QueryClubes);
$stmt->execute();


$QueryClubes2 = "SELECT pdf_id, pdf_anp, pdf_nome FROM icbr_pdfold WHERE pdf_anp='$idProjeto'";
// seleciona os registros
$stmt2 = $PDO->prepare($QueryClubes2);
$stmt2->execute();


 $associado = $PDO->prepare("SELECT * FROM icbr_projetos WHERE pro_id='$idProjeto'");
 $associado->execute();
 $campo = $associado->fetch();
      $NomeProjeto = $campo['pro_Nome'];
      $Avenida = $campo['pro_Avenida'];
      $CodProjeto = $campo['pro_id'];
      $CodClube = $campo['pro_ClubID'];
      $NomeClube = $campo['pro_ClubNome'];
      $DataCadastro = $campo['pro_DtCadastro'];
      $ChamaStatus = $campo['pro_Status'];
      $File = $campo['pro_FileNome'];
      $PDF = "../Distrito/arquivo/" . $File;

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIGED - Sistema Integrado de Gestão Distrital | MDIO Interact Brasil</title>
  <meta http-equiv="Content-Language" content="pt-br">
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
            <img src="../uploads/<?php echo $Foto; ?>" class="user-image" alt="<?php echo $LoginNome; ?>">
             <span class="hidden-xs"><?php echo $LoginNome; ?></span>
           </a>
           <ul class="dropdown-menu">
            <li class="user-header">
             <img src="../uploads/<?php echo $Foto; ?>" class="img-circle" alt="User Image">
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
      </div>
    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content-header">
        <h1>
          Página de Revisão de Projeto
          <small>Interact Brasil</small>
        </h1>
      </section>
      <section class="content">
       <div class="box box-warning">
        <div class="box-header with-border">
         <h3 class="box-title"><?php echo "[" . $Avenida . "] - " . $NomeProjeto; ?>
         </h3>
        <a class="pull-right">Distrito <?php echo $Distrito; ?></a>
        </div>
        <div class="box-body">
       <div class="col-xs-5">
         <li class="list-group-item">
          <b>Código ANP:</b> 
          <a class="pull-right"><strong><code><?php echo $CodProjeto; ?></code></strong></i></a>
         </li>
         <li class="list-group-item">Interact Club de  <?php echo $NomeClube; ?></li>
         <li class="list-group-item">
          <b>Código do Club:</b>
          <a class="pull-right"><strong><code><?php echo $CodClube; ?> </code></strong></a>
         </li>
         <li class="list-group-item"><b>Cadastro:</b> <a class="pull-right"><?php echo $DataCadastro; ?> </i></a></li>
       </div>

       <div class="col-xs-4">
       <?php
        if ($ChamaStatus == "P") 
        {
        ?>
        <li class="list-group-item">
         <a class="btn btn-flat btn-block btn-warning btn-xs">PENDENTE</a>
        </li>
        <li class="list-group-item">--</li>    
        <li class="list-group-item"><b>Abrir PDF</b>
         <a class="pull-right">
          <span class="btn bg-navy btn-xs" onclick="window.open('<?php echo $PDF; ?>');">Visualizar</span>
         </a>
        </li>   
        <li class="list-group-item">--</li>   


        <?php
        }
        elseif ($ChamaStatus == "A") 
        {
          echo '<li class="list-group-item">';
          echo '<a class="btn btn-flat btn-block btn-success btn-xs">Aprovado</a>';
          echo '</li>';
          echo '<li class="list-group-item">--</li>';
          echo '<li class="list-group-item">--</li>';
          echo '<li class="list-group-item"><b>Abrir PDF</b>';

          ?>
           <a class="pull-right">
            <span class="btn bg-navy btn-xs" onclick="window.open('<?php echo $PDF; ?>');">Visualizar</span>
           </a>
          </li>  
          <?php
        }
        elseif ($ChamaStatus == "E") 
        {
        ?>
        <li class="list-group-item">
         <a class="btn btn-flat btn-block btn-primary btn-xs">AGUARDANDO REVISÃO</a>
        </li>
        <li class="list-group-item"><b>Abrir PDF</b>
         <a class="pull-right">
          <span class="btn bg-navy btn-xs" onclick="window.open('<?php echo $PDF; ?>');">Visualizar</span>
         </a>
        </li> 
        <li class="list-group-item">
        <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#AprovaProjeto">
             APROVAR
          </button>   
        <button type="button" class="btn bg-orange btn-block" data-toggle="modal" data-target="#ReprovaProjeto">
             REVISAR 
          </button>   
        </li>  
        <!-- AQUI COMEÇA O MODAL DE LIBERAÇÃO DO PROJETO -->
        <div id="AprovaProjeto" class="modal fade" role="dialog">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><code>&times;</code></button>
            <h4 class="modal-title">APROVAR PROJETO</h4>
           </div>
           <div class="modal-body">
            <div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> ATENÇÃO!</h4>
              Ao Confirmar, você está aprovando o projeto, e consequentemente, Informando então que o projeto atende todos os requisitos da Interact Brasil e está elegível ao Concurso Nacional de Projetos.
            </div>
            <h4>
            <strong>Projeto: #</strong><?php echo $CodProjeto . ' - ' .  $NomeProjeto; ?><br/>
            <strong>Avenida: </strong><?php echo $Avenida; ?><br/>
            Interact Club de <?php echo $NomeClube . ' - Distrito ' . $Distrito; ?>
            </h4>
            <h3>DESEJA REALMENTE APROVAR ESTE PROJETO?</h3>
            <form name="trocarFoto" id="name" method="post" action="" enctype="multipart/form-data">
             <div class="modal-footer">
              <br /><br />
              <input name="enviar" type="submit" class="btn btn-success btn-lg" id="enviar" value="Aprovar Projeto" />
              <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
             </div>
            </form>
            <?php
            if(@$_POST["enviar"])
            {
             $aprova = $PDO->query("UPDATE icbr_projetos SET pro_DtFinal='$DtApr', pro_Status='A' WHERE pro_id='$CodProjeto'");
             if ($aprova) {
              $SalvaLog = $PDO->query("INSERT INTO ic_log (log_tipo, log_user) VALUES ('15', '$codLogin')");
              if ($SalvaLog) {
              }  
              else{
                   echo '<script type="text/javascript">alert("Atenção!, não foi possível gravar LOG");</script>';
              }
              echo '<script type="text/javascript">alert("deu certo");</script>';


  

             }
             else{
              echo '<script type="text/javascript">alert("Erro ao Aprovar o projeto");</script>';

             }


              }
             ?>





           </div>
          </div>
         </div>
        </div> 
        <!-- AQUI TERMINA O MODAL DE LIBERAÇÃO DO PROEJTO -->
        <!-- AQUI COMEÇA O MODAL DE REPROVAÇÃO DO PROJETO -->
        <div id="ReprovaProjeto" class="modal fade" role="dialog">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><code>&times;</code></button>
            <h4 class="modal-title">REVISAR PROJETO</h4>
           </div>
           <div class="modal-body">
<!-- AQUI COMEÇA O FORM PARA REPROVAR O PROJETO -->
<form onsubmit="return valida_form();" name="cadastrar_anuncio" id="name" method="post" action="" enctype="
     multipart/form-data">
      <div class="col-xs-4">Status
       <select class="form-control" name="revisao" id="revisao" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="P">CRIAR PENDÊNCIA</option>
        <option value="R">REPROVAR</option>
       </select>
      </div>
      <div class="col-xs-4">Data Revisão
       <input type="text" class="form-control" disabled placeholder="<?php echo $DtApr; ?>">
      </div>
      <div class="col-xs-4">Responsável
       <input type="text" class="form-control" disabled placeholder="<?php echo $LoginNome; ?>">
      </div>
      <br /><h4><div class="pull-center"> Registro de Pendências</div></h4>
      <div class="col-xs-6">Corrigir Ortografia:
       <select class="form-control" name="Ortografia" id="Ortografia" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="S">SIM</option>
        <option value="N">NÃO</option>
       </select>
      </div>
      <div class="col-xs-6">Corrigir Valores:
       <select class="form-control" name="valores" id="valores" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="S">SIM</option>
        <option value="N">NÃO</option>
       </select>
      </div>
      <div class="col-xs-6">Atualizar Andamento
       <select class="form-control" name="andamento" id="andamento" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="S">SIM</option>
        <option value="N">NÃO</option>
       </select>
      </div>
      <div class="col-xs-6">Fotos Insuficientes
       <select class="form-control" name="fotos" id="fotos" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="S">SIM</option>
        <option value="N">NÃO</option>
       </select>
      </div>
      <div class="col-xs-6">Atualizar PDF
       <select class="form-control" name="pdf" id="pdf" required="required">
        <option value="" selected="selected">SELECIONE</option>
        <option value="S">SIM</option>
        <option value="N">NÃO</option>
       </select>
      </div>
      <div class="col-xs-12">Observações
       <textarea  name="descricao" cols="45" rows="5" class="form-control" id="descricao"></textarea>
      </div>
      <div class="modal-footer">
      <br /></div><br />
      <div>
       <br /><br />
        <input name="reprovar" type="submit" class="btn btn-primary" id="reprovar" value="Atualizar Pendências" />
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
     </form>
        <?php
        if(@$_POST["reprovar"])
         {
          $descricao = str_replace("\r\n", "<br/>", strip_tags($_POST["descricao"]));
          $NovoStatus = $_POST['revisao'];
          $Ortografia = $_POST['Ortografia'];
            if ($Ortografia == 'S') {
              $R1 = 'Ortografia; <br />';
            }
            else{
              $R1 = '';
            }
          $valores = $_POST['valores'];
            if ($valores == 'S') {
              $R2 = 'Valores (R$) <br ;>';
            }
            else{
              $R2 = '';
            }
          $andamento = $_POST['andamento'];
            if ($andamento == 'S') {
              $R3 = 'Andamento do projeto; <br />';
            }
            else{
              $R3 = '';
            }
          $fotos = $_POST['fotos'];
            if ($fotos == 'S') {
              $R4 = 'Atualizar fotos; <br />';
            }
            else{
              $R4 = '';
            }
          $pdf = $_POST['pdf'];
            if ($pdf == 'S') {
              $R5 = 'Atualizar PDF; <br />';
            }
            else{
              $R5 = '';
            }
            $Pendencias = "Pendências a Corrigir: " . $R1 . $R2 . $R3 . $R4 . $R5 . "<br />" . $descricao;
          $NovaPendencia = $PDO->query("INSERT INTO icbr_historicoprojeto (p_DtCadastro, p_UsrCadastro, p_Pergunta, p_id) VALUES ('$DtApr', '$LoginNome', '$Pendencias', '$CodProjeto')");
          if ($NovaPendencia) {
          echo '<script type="text/javascript">alert("Pendência Cadastrada com Sucesso");</script>';
           
          $Reprovar = $PDO->query("UPDATE icbr_projetos SET pro_Status='$NovoStatus' WHERE pro_id='$CodProjeto'");
            if ($Reprovar) {
            echo '<script type="text/javascript">alert("PROJETO REPROVADO COM SUCESSO");</script>';
            echo '<script type="text/javascript">window.close();</script>';
            }
            else{
            echo '<script type="text/javascript">alert("Não foi Possível reprovar o Projeto");</script>';

            }




          }
          else{
                  echo '<script type="text/javascript">alert("Erro! <?php print_r($PDO->errorInfo()); ?>");</script>';

          }

         }
         ?>



<!-- AQUI TERMINA O FORM PARA REPROVAR O PROJETO -->

           </div>

          </div>
         </div>
        </div> 
        <!-- AQUI TERMINA O MODAL DE REPROVAÇÃO DO PROEJTO -->




        <?php
        }
    ?>
       </div>
       <div class="col-xs-3">
       <?php  
        $qrcode = 'http://chart.apis.google.com/chart?cht=qr&chl="http://interactbrasil.org/projetos/verprojeto.php?ID=' . $idProjeto . '"&chs=150x150';
        echo "<img src='$qrcode'/>";
       ?>
       <br />
       </div>
      </div><!-- /.box -->
      <div class="box box-primary">
       <div class="box-body box-profile">
        <h2 class="profile-username text-center">Histórico do Projeto</h2>
       </div><!-- /.box -->
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr>
          <th>ID</th>
          <th>Data da Ocorrencia</th>
          <th>Usuario Cadastrado</th>
          <th>Observação</th>
          <th>Resposta</th>
         </tr>
        </thead>
        <tbody>
        <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
         <tr>

          <td><?php echo $user['icbr_hpid'] ?></td>
          <td><?php echo $user['p_DtCadastro'] ?></td>
          <td><?php echo $user['p_UsrCadastro'] ?></td>
          <td><?php echo $user['p_Pergunta'] ?></td>
          <?php
          $DataResposta = $user['p_DtResposta'];
          if (is_null($DataResposta)) 
          {
            $idPergunta = $user['icbr_hpid'];
          ?>
          <td>
          <span class="btn btn-primary btn-block btn-xs" onclick="window.open('RespondeProjeto.php?ID=<?php echo $idPergunta; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=800, HEIGHT=650');">Responder Pendencia</span>
          </td>
          <?php
          }
          else
          {
            echo "<td>" . $user['p_Resposta'] . "</td>";
          }
          ?>
         </tr>
                         <?php endwhile; ?>

        </tbody>
        </table>
      </div><!-- /.box-body -->



        </div>
        </div>
      </section>
    </div>
  </div>
<?php
include_once '../footer.php';
?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/fastclick/fastclick.min.js"></script>
</body>
</html>
