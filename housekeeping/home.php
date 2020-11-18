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

    <title>Painel <?php echo $Holo['name']; ?></title>
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
                        <div class="kt-portlet">
                           <div class="kt-portlet__body  kt-portlet__body--fit">
                              <div class="row row-no-padding row-col-separator-xl">
                                 <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="kt-widget24">
                                       <div class="kt-widget24__details">
                                          <div class="kt-widget24__info">
                                             <h4 class="kt-widget24__title">Usuarios Onlines</h4>
                                             <span class="kt-widget24__desc">Onlines ahora en el Hotel</span>
                                          </div>
                                          <span class="kt-widget24__stats"><font color="#0B87D3"><?php echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE online = '1' AND rank < 4")) ?></font></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="kt-widget24">
                                       <div class="kt-widget24__details">
                                          <div class="kt-widget24__info">
                                             <h4 class="kt-widget24__title">Staffs Onlines</h4>
                                             <span class="kt-widget24__desc">Staffs ahora en el Hotel</span>
                                          </div>
                                          <span class="kt-widget24__stats"><font color="#540BD3"><?php echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE online = '1' AND rank > 5")) ?></font></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="kt-widget24">
                                       <div class="kt-widget24__details">
                                          <div class="kt-widget24__info">
                                             <h4 class="kt-widget24__title">Usuarios Baneados</h4>
                                             <span class="kt-widget24__desc">Cantidad de Baneados en el hotel</span>
                                          </div>
                                          <span class="kt-widget24__stats"><font color="#D30B1D"><?php echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bans")) ?></font></span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="kt-widget24">
                                       <div class="kt-widget24__details">
                                          <div class="kt-widget24__info">
                                             <h4 class="kt-widget24__title">Quejas en el Hotel</h4>
                                             <span class="kt-widget24__desc">Reclamaciones realizadas dentro del Hotel</span>
                                          </div>
                                          <span class="kt-widget24__stats"><font color="#D3940B"><?php echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM support_tickets")) ?></font></span>
                                       </div>
                                    </div>
                                 </div>
								 <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="kt-widget24">
                                       <div class="kt-widget24__details">
                                          <div class="kt-widget24__info">
                                             <h4 class="kt-widget24__title">Tickets de ayuda</h4>
                                             <span class="kt-widget24__desc">Solicitudes de ayuda enviadas a través del sitio</span>
                                          </div>
                                          <span class="kt-widget24__stats"><font color="#84D30B"><?php echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cms_tickets")) ?></font></span>
                                       </div>
                                    </div>
                                 </div>
								 <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="kt-widget24">
                                       <div class="kt-widget24__details">
                                          <div class="kt-widget24__info">
                                             <h4 class="kt-widget24__title">Salas creadas</h4>
                                             <span class="kt-widget24__desc">Número de habitaciones creadas en el hotel</span>
                                          </div>
                                          <span class="kt-widget24__stats"><font color="#29E0B9"><?php echo mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rooms")) ?></font></span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

 <div class="row">
 
    <div class="col-xl-12">
        <div class="alert alert-danger" role="alert"><strong>Psss...</strong> Nuestro Panel aún está en desarrollo, ¡agradecemos su comprensión!</div>
    </div>
	
    <div class="col-xl-4">
<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
	<div class="kt-portlet__head">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">Información de las salas</h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">Más populares ahora</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab2_content" role="tab">Últimas conversaciones</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="kt-portlet__body">
		<div class="tab-content">
			<div class="tab-pane active" id="kt_widget4_tab1_content">
				<div class="kt-widget4">
<?php $rooms = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rooms ORDER BY users DESC LIMIT 10");
while($room = mysqli_fetch_array($rooms)){
$user = mysqli_fetch_assoc($user = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$room['owner_id']."'"));
?>
					<div class="kt-widget4__item">
						<div class="kt-widget4__pic kt-widget4__pic--pic">
							<img src="<?php echo $Holo['url']; ?>/camera/thumbnails/<?php echo $room['id']; ?>.png" alt="">   
						</div>
						<div class="kt-widget4__info">
							<?php echo mysqli_real_escape_string($GLOBALS["___mysqli_ston"], mb_strimwidth($room['name'], 0, 43, "...")); ?>
							<p class="kt-widget4__text">Sala de <b><?php echo $user['username']; ?></b> con <b><?php echo $room['users']; ?></b> personas en la habitación.</p>							 		 
						</div>						 
					</div>  
<?php } ?>
				</div>             
			</div>

			<div class="tab-pane" id="kt_widget4_tab2_content">
				<div class="kt-widget4">
<?php $chats = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM chatlogs_room ORDER BY id DESC LIMIT 10");
while($chat = mysqli_fetch_array($chats)){
$user = mysqli_fetch_assoc($user = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$chat['user_from_id']."'"));
$room = mysqli_fetch_assoc($room = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM rooms WHERE id = '".$chat['room_id']."'"));
?>
					<div class="kt-widget4__item">
						<div class="kt-widget4__pic kt-widget4__pic--pic">
							<img src="<?php echo $Holo['avatar'] . $user['look']; ?>&headonly=1&direction=2&head_direction=2&action=&gesture=sml" alt="">    
						</div>
						<div class="kt-widget4__info">
							<b><?php echo $user['username']; ?></b> envio un mensaje en la sala <b><?php echo mysqli_real_escape_string($GLOBALS["___mysqli_ston"], mb_strimwidth($room['name'], 0, 43, "...")); ?></b>
							<p class="kt-widget4__text"><?php echo mysqli_real_escape_string($GLOBALS["___mysqli_ston"], mb_strimwidth($chat['message'], 0, 78, "...")); ?></p>							 		 
						</div>	
					</div>
<?php } ?>
				</div>			 
			</div>
		</div>
	</div>
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