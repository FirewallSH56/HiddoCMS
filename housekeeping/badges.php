<?php
require_once("../inc/core.god.php");
require_once("../inc/hk_session.php");

if(Loged == false) { 
    header("Location: " . $Holo['url'] ."");
	exit;
}
if(UserH == false) {
    header("Location: " . $Holo['url'] ."/".$Holo['panel']."");
	exit;
}
if($myrow['rank'] < $Holo['minhkr']) {
    header("Location: " . $Holo['url'] ."");
	exit;
}
if(mysqli_num_rows($chb) > 0) {
    header("Location: " . $Holo['url'] . "/banned");
	exit;
}
?>
<!DOCTYPE html>
<html lang="pt" >
<head>
    <meta charset="utf-8"/>

    <title>Panel <?php echo $Holo['name']; ?></title>
	<link rel="icon" type="image/png" href="/hen/admin/images/favicon.ico" />
    <meta name="description" content="Painel de Controle do <?php echo $Holo['name']; ?> Hotel">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <style>
     html {overflow-y: scroll;}
     .toast {
       opacity: 1 !important;
     }

     #toast-container > div {
       opacity: 1 !important;
     }

     .modal-open{
       margin-right:0px !important;
     }
   </style>

   <link href="/hen/admin/vendors/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/select2.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/toastr.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/line-awesome.css?v=8" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/flaticon.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/flaticon2.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/fontawesome.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/style.bundle.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/css/wizard.css" rel="stylesheet" type="text/css" />
   <link href="/hen/admin/vendors/css/jstree.bundle.css" rel="stylesheet" type="text/css" />
   
    <script src="/hen/admin/js/web/user_settings.js" type="text/javascript"></script>
    <script src="/hen/admin/ckeditor/ckeditor.js"></script>
  
   <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
</head>
<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed">

   <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
      <div class="kt-header-mobile__toolbar">
         <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
         <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
      </div>
   </div>

   <div class="kt-grid kt-grid--hor kt-grid--root">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
         <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed "  data-ktheader-minimize="on" >
               <div class="kt-container  kt-container--fluid ">
                  <div class="kt-header__brand " id="kt_header_brand">Panel de control</div>
                  <div class="kt-header__topbar">
                     <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                           <span class="kt-header__topbar-welcome kt-visible-desktop">Hola,</span>
                           <span class="kt-header__topbar-username kt-visible-desktop"><?php echo $myrow['username']; ?></span>
                           <span class="kt-header__topbar-icon kt-bg-brand kt-hidden"><b>{{player.username|slice(0,1)|upper}}</b></span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                           <div class="kt-notification">
                              <div class="kt-notification__custom kt-space-between">
                                 <a href="/hotel" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold">Entrar al hotel</a>
                                 <a href="/logout" class="btn btn-label btn-label-brand btn-sm btn-bold">Desconectar</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
			
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
               <div class="kt-container  kt-grid kt-grid--ver">
                  <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                  <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
				    <?php require_once("../housekeeping/MWW/navbar.php"); ?>
                  </div>
                  <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                     <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="margin-top:30px">
                        

<div class="row">
    <div class="col-xl-12" id="editNews">
        <div class="kt-portlet">
		
                <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-open-box"></i>
                    </span>

                    <h3 class="kt-portlet__head-title">Subir placa</h3>
                </div>
                </div>

                <div class="kt-portlet__body">
				
                    <form id="cuadro" method="post">
                    <div class="form-group">
                        <label>Código:</label>
                        <input type="text" class="form-control" name="codigo" required>
                    </div>

                    <div class="form-group">
                        <label>Título:</label>
                        <input type="text" class="form-control" name="titulo" required>
                    </div>
					<div class="form-group">
                        <label>Descripcion:</label>
                        <input type="text" class="form-control" name="descripcion" required>
                    </div>
					
                <div class="kt-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-lg-6 m--valign-middle">
                            Acción:
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <input type="hidden" name="newsId">
                            <button type="submit" name="submit1" class="btn btn-brand addNews">Subir placa</button>
                        </div>
                    </div>
                </div>
                    </form>

<?php

if(isset($_POST['submit1']))
{
$codigo = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['codigo']);
$titulo = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['titulo']);
$descripcion = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['descripcion']);

if(!empty($codigo) && !empty($titulo)){

$conteudo = "\nbadge_name_$codigo=$titulo\nbadge_desc_$codigo=$descripcion";
$arquivo = "../images.hiddo.es/gamedata/override/external_flash_override_texts.txt";

if (!$abrir = fopen($arquivo, "a")) { 
echo "<div class='alert alert-success' role='alert'><div class='alert-text'>¡Ocurrió algo súper malo! Habla con uno de los programadores responsables.</div></div>"; 
exit; 
} 

if (!fwrite($abrir,utf8_encode($conteudo))) { 
print "<div class='alert alert-success' role='alert'><div class='alert-text'>¡Ocurrió algo súper malo! Habla con uno de los programadores responsables.</div></div>"; 
exit; 
} 

echo "<div class='alert alert-success' role='alert'><div class='alert-text'>¡Has subido con éxito una placa! Espere...</div></div><meta http-equiv='refresh' content='2; url=/housekeeping/badges.php'>";
mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO cms_hklogs SET type = 'Emblemas', note = 'Placa agregada: $titulo', author_name = '". $myrow['username'] ."', author_id = '". $myrow['id'] ."', author_rank = '". $myrow['rank'] ."', timestamp = '". time() ."'");
}


else
{
echo "<div class='alert alert-danger' role='alert'><div class='alert-text'>Hay campos sin información, revisa todo y vuelve a intentarlo.</div></div>";
}}
?>
<div class="kt-portlet__foot"></div>

<form method="post" enctype="multipart/form-data">

                <div class="form-group">
				<label>Subir imagen:</label><br>
                    <input type="file" name="arquivo[]" required />
                </div>

                <div class="kt-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-lg-6 m--valign-middle">
                            Acción:
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <input type="hidden" name="newsId">
                            <button type="submit" name="submit" class="btn btn-brand addNews">Enviar imagen</button>
                        </div>
                    </div>
                </div>
</form>

<?php
if(isset($_POST['submit']))
{
$numeroCampos = 5;
$tamanhoMaximo = 1000000;
$extensoes = array(".gif");
$caminho = "../images.hiddo.es/c_images/album1584/";
$substituir = false;
 
for ($i = 0; $i < $numeroCampos; $i++) {
 
	$nomeArquivo = $_FILES["arquivo"]["name"][$i];
	$tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
	$nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
 
	if (!empty($nomeArquivo)) {
 
		$erro = false;
 
		if ($tamanhoArquivo > $tamanhoMaximo) {
			$erro = "<div class='alert alert-danger' role='alert'><div class='alert-text'>Dios, el archivo no puede exceder el tamaño de " . $tamanhoMaximo. " bytes.</div></div>";
		} 
		
		elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
			$erro = "<div class='alert alert-danger' role='alert'><div class='alert-text'>¡El tipo de archivo / extensión no está permitido! Usar unicamente <b>.gif</b>.</div></div>";
		} 

		elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
			$erro = "<div class='alert alert-danger' role='alert'><div class='alert-text'>El archivo " . $nomeArquivo . " ya existe.</div></div>";
		}
 
		if (!$erro) {
			move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
			echo "<div class='alert alert-success' role='alert'><div class='alert-text'>Enviaste el archivo ".$nomeArquivo." con éxito! Espere.</div></div><meta http-equiv='refresh' content='2; url=/housekeeping/badges.php'>";
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO cms_hklogs SET type = 'Emblemas', note = 'Agregó la imagen a la placa: $nomeArquivo', author_name = '". $myrow['username'] ."', author_id = '". $myrow['id'] ."', author_rank = '". $myrow['rank'] ."', timestamp = '". time() ."'");
		} 

		else {
			echo $erro . "<br />";
		}
	}
}
}
?>
			
        </div>
    </div>
</div>

                     </div>
                  </div>
               </div>
            </div>
			
            <div class="kt-footer kt-grid__item" id="kt_footer" kt-hidden-height="65" style="">
               <div class="kt-container ">
                  <div class="kt-footer__wrapper">&copy; Hiddo Hotel - 2020<br />Powered by ArcturusEmulator, todos los derechos reservados.</div>
               </div>
            </div>
			
         </div>
      </div>
	  
	  
   </div>

   <div id="kt_scrolltop" class="kt-scrolltop"><font color="#FFFFFF">Subir</font></div>

   <script src="https://use.fortawesome.com/349cfdf6.js"></script>
   <script src="/hen/admin/js/vendors.bundle.js" type="text/javascript"></script>
   <script src="/hen/admin/js/scripts.bundle.js" type="text/javascript"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

   <script>if (window.module) module = window.module;</script>
   
</body>
</html>