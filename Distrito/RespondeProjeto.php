<?php
/* AreaRestrita.php */
require("../restritos.php"); 
require_once '../init.php';
$PDO = db_connect();

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


  $DataHoje = date("d/m/Y - h:i:s");
  $idPergunta = $_GET['ID'];
  //CHAMANDO OS DADOS DA PERGUNTA
  $DadosPergunta = $PDO->prepare("SELECT * FROM icbr_historicoprojeto WHERE icbr_hpid='$idPergunta'");
   $DadosPergunta->execute();
    $Res=$DadosPergunta->fetch();
     $idProjeto = $Res['p_id']; // AQUI CHAMO O ID DO PROJETO
     $DataPergunta = $Res['p_DtCadastro']; //AQUI CHAMO A DATA DO CADASTRO DO PERGUNTA
     $UserPergunta = $Res['p_UsrCadastro']; //AQUI CHAMO O USUÁRIO QUE CADASTROU A PERGUNTA
     $Pergunta = $Res['p_Pergunta']; //AQUI CHAMO A PEGUNTA VINCULADA.

  //CHAMANDO DADOS DO PROJETO
  $ChamarProj = $PDO->prepare("SELECT * FROM icbr_projetos WHERE pro_id='$idProjeto'");
   $ChamarProj->execute();
    $ResP=$ChamarProj->fetch();
     $idProjetos = $ResP['pro_id']; // AQUI CHAMO O ID DO PROJETO
     $NomePDF = $ResP['pro_FileNome'];
    
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
 <div class="wrapper">
  <header class="main-header">
   <nav class="navbar navbar-static-top">
    <div class="container">
     <div class="navbar-header">
      <span class="logo-lg">
       <img src="../dist/img/logo/ICLogo.png" width="200">
      </span>
     </div>

<div class="navbar-custom-menu">
 <ul class="nav navbar-nav">
  <li class="dropdown user user-menu">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="../uploads/<?php echo $Foto; ?>" class="user-image" alt="User Image">
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
      Interact Club de <?php echo $idPergunta; ?><br />
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
    <section class="content">
    <div class="box box-default">
     <div class="box-header with-border">
      <h2 class="box-title"><?php echo "#" . $ResP['pro_id'] . " | " .  $ResP['pro_Nome'] . " -  [Avenida: " . $ResP['pro_Avenida'] . "]"; ?></h2>          
     </div>
     <div class="box-body">
      <div class="row invoice-info">
       <div class="col-sm-4 invoice-col">
        <address>
        <?php 
        echo '<strong>Interact Club de: </br></strong>';
        echo $ResP['pro_ClubNome'];
        echo '<br />';
        echo 'Distrito ' . $ResP["pro_Distrito"];
        echo '<br /><br />';
        ?>
         <strong>Andamento do projeto: </strong><br />
          <code><?php echo $ResP['pro_Andamento']; ?></code><br /><br />
        </address>
       </div>
       <div class="col-sm-5 invoice-col">
        <address>
         <strong>Pendências do projeto:</strong><br>
          <?php echo $Pergunta; ?><br />
        </address>
       </div>
       <div class="col-sm-3 invoice-col">
        <address>
         <?php
          function qrcode($url, $size){
          if($url != "" && $size != ""){
          return "http://chart.apis.google.com/chart?cht=qr&chl=".$url."&chs=150x150";
             }
            }
         ?>
         <img src="<?php echo qrcode("http://interactbrasil.org/clubes/VerClube.php?ID=<?php echo $Pergunta; ?>","200"); ?>" />
        </address>
       </div>
       <div class="col-sm-12 invoice-col">
        <form name="inativaClub" id="name" method="post" action="" enctype="multipart/form-data">
         <div class="col-xs-5">Andamento do Projeto
          <select class="form-control" name="andamento" id="andamento" required="required">
           <option value="" selected="selected">SELECIONE</option>
           <option value="planejamento">Em Planejamento</option>
           <option value="execucao">Em Execução</option>
           <option value="finalizado">Finalizado</option>
          </select>
         </div>
         <div class="col-xs-7">Selecionar Arquivo
          <input type="file"   name="Arquivo" id="Arquivo" required="required" />
         </div>
         <div class="col-xs-12">Resposta
          <textarea name="descricao" cols="45" rows="5" class="form-control" id="descricao"></textarea>
         </div>      
         <div class="col-xs-12"><br />
          <input name="enviar" type="submit" class="btn bg-navy" id="enviar" value="Atualizar" />
         </div>
        </form>
        <?php
        if(@$_POST["enviar"])
           {
            $descricao = str_replace("\r\n", "<br/>", strip_tags($_POST["descricao"]));
            $AndamentoProjeto = $_POST["andamento"];
            
                //AQUI ESTOU TRATANDO A RESPOSTA ADICIONANDO QUEBRA DE LINHA QUANDO NECESSÁRIO

                $nome_temporario=$_FILES["Arquivo"]["tmp_name"];
                $nome_real=$_FILES["Arquivo"]["name"];
                $novonome = md5(mt_rand(1,10000).$nome_real["name"]).'.pdf';
                $valor = "arquivo/" . $novonome;
                $upload = copy($nome_temporario,$valor);
                 if($upload){
                  echo '<script type="text/javascript">alert("PDF Atualizado com Sucesso!");</script>';
                  $Resposta1 = $PDO->query("UPDATE icbr_historicoprojeto SET p_DtResposta='$DataHoje', p_Resposta='$descricao', p_UserResposta='$LoginNome' WHERE icbr_hpid='$idPergunta'");
                    if ($Resposta1)
                    {
                    echo '<script type="text/javascript">alert("Resposta Adicionada");</script>';
                    $TrocaPDF = $PDO->query("INSERT INTO icbr_pdfold (pdf_anp, pdf_nome) VALUES ('$idProjetos', '$NomePDF')");
                     if ($TrocaPDF) {
                      echo '<script type="text/javascript">alert("PDF Arquivado");</script>';
                       $Resposta2 = $PDO->query("UPDATE icbr_projetos SET pro_Status='E', pro_FileNome='$novonome', pro_Andamento='$AndamentoProjeto' WHERE pro_id='$idProjetos'");
                        if ($Resposta2) {
                         echo '<script type="text/javascript">alert("Projedo Devolvido á Interact Brasil");</script>';   
                         echo '<script type="text/javascript">window.close();</script>';

                        }
                        else{
                         echo '<script type="text/javascript">alert("Não foi possível devolver o projeto à interact Brasil. entre em contato no email: sistema@interactbrasil.org");</script>';
                         echo '<script type="text/javascript">window.close();</script>';

                      }





                     }
                     else{
                    echo '<script type="text/javascript">alert("Não foi possível arquivar o PDF Antigo, entre em contato com a Interact Brasil no email: sistema@interactbrasil.org");</script>';
                    echo '<script type="text/javascript">window.close();</script>';
                    }


                    }
                    else{
                    echo '<script type="text/javascript">alert("Não foi possível responder a pergunta, entre em contato com a Interact Brasil no email: sistema@interactbrasil.org");</script>';
                    echo '<script type="text/javascript">window.close();</script>';
                    }

                 }
                 else{
                  echo '<script type="text/javascript">alert("Não foi Possível enviar PDF");</script>'; 
                 }
                //AQUI ESTOU TRATANDO O UPLOAD DO NOVO ARQUIVO PDF

                //ADICIONANDO RESPOSTA NA TABELA ICBR_HISTORICOPROJETO

              }

             ?>





       </div>
      </div>
     </div>
    </div>
   </section>
  </div>
 </div>
<?php include_once '../footer.php'; ?>
</div>
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../plugins/fastclick/fastclick.js"></script>
<script src="../dist/js/app.min.js"></script>
<script src="../dist/js/demo.js"></script>
</body>
</html>
