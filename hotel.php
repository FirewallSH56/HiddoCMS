<?php require_once("inc/core.god.php");

if(Loged == FALSE)
{
	header("Location: /");
	exit;
}

if(mysqli_num_rows($chb) > 0) 
{
    header("Location: banned");
	exit;
}

if($_GET['action'] == 'logout') {
    session_destroy();
    header("Location: logout");
	exit;
}

if(MANTENIMIENTO == '1' && $myrow['rank'] < $Holo['minrank']) 
{
    header("Location: mantenimiento");
	exit;
}

$_config['client'] = array(
	'host' 				 				=> '51.178.49.43',
	'port' 				 				=> '30000',
	'client_starting' 		 		 	=> 'Por favor espera! '.$Holo['name'].' esta cargando...',
	'client_starting_revolving' 		=> 'Por favor espera! '.$Holo['name'].' esta cargando...',
	'external_variables' 			 	=> 'http://images.hiddo.es/gamedata/external_variables.txt',
	'external_variables_override' 		=> 'http://images.hiddo.es/gamedata/override/external_override_variables.txt',
	'external_flash_texts'  			=> 'http://images.hiddo.es/gamedata/external_flash_texts.txt',
	'external_flash_texts_override' 	=> 'http://images.hiddo.es/gamedata/override/external_flash_override_texts.txt',
	'productdata' 			 			=> 'http://images.hiddo.es/gamedata/productdata.txt',
	'furnidata' 			 			=> 'http://images.hiddo.es/gamedata/furnidata.xml',	
	'external_figurepartlist' 			=> 'http://images.hiddo.es/gamedata/figuredata.xml',	
	'avatareditor_promohabbos' 			=> 'http://images.hiddo.es/gamedata/hotlooks.xml',	
	'flash_client_url' 	 				=> 'http://images.hiddo.es/gordon/PRODUCTION-202006192205-424220153/',
	'habbo_swf' 		 				=> 'Habbo.swf'
);

$ticket = time().sha1(rand(10000,99999));

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET auth_ticket = '".$myrow['username']."-".$ticket."', ip_current = '".$ip."' WHERE id = '".$myrow['id']."'") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	
$ticketsql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT auth_ticket FROM users WHERE id = '".$myrow['id']."'") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
$ticketrow = mysqli_fetch_assoc($ticketsql);
?>
<html lang="pt-BR" data-theme="<?php echo $myrow['theme']; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $Holo['name']; ?>: Hotel</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript">var andSoItBegins = (new Date()).getTime();</script>
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/Mawu/css/client.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/Mawu/css/client_icons.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/Mawu/css/buttons.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/Mawu/css/client_wulles.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $Holo['url']; ?>/Mawu/css/client_news.css" type="text/css">
    <script type="text/javascript" src="<?php echo $Holo['url']; ?>/Mawu/js/swfobject.js"></script>
    <script type="text/javascript" src="<?php echo $Holo['url']; ?>/Mawu/js/fullscreen.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link rel="icon" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-32x32.png" sizes="32x32" />
	<link rel="icon" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-180x180.png" />
	<meta name="msapplication-TileImage" content="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-270x270.png" />
	   
	<script>
	function goBack() {
	  window.history.back();
	}
	</script>
	   
        <script type="text/javascript">
            var BaseUrl = "<?php echo $_config['client']['flash_client_url']; ?>";
            var flashvars =
            {
                "client.starting" : "<?php echo $_config['client']['client_starting']; ?>", 
				"client.starting.revolving":"<?php echo $_config['client']['client_starting_revolving']; ?>",
                "client.allow.cross.domain" : "1", 
                "client.notify.cross.domain" : "1", 
                "connection.info.host" : "<?php echo $_config['client']['host']; ?>", 
                "connection.info.port" : "<?php echo $_config['client']['port']; ?>", 
                "site.url" : "<?php echo $Holo['url']; ?>", 
                "url.prefix" : "<?php echo $Holo['url']; ?>", 
                "client.reload.url" : "<?php echo $Holo['url']; ?>/hotel", 
                "client.fatal.error.url" : "<?php echo $Holo['url']; ?>/disconnected", 
                "client.connection.failed.url" : "<?php echo $Holo['url']; ?>/disconnected", 
				"logout.url" : "<?php echo $Holo['url']; ?>/hotel?action=logout", 
				"logout.disconnect.url" : "<?php echo $Holo['url']; ?>/hotel?action=logout", 
                "external.variables.txt" : "<?php echo $_config['client']['external_variables']; ?>", 
                "external.texts.txt" : "<?php echo $_config['client']['external_flash_texts']; ?>", 
				"external.override.texts.txt" : "<?php echo $_config['client']['external_flash_texts_override']; ?>", 
				"external.override.variables.txt" : "<?php echo $_config['client']['external_variables_override']; ?>", 
                "productdata.load.url" : "<?php echo $_config['client']['productdata']; ?>", 
                "furnidata.load.url" : "<?php echo $_config['client']['furnidata']; ?>", 
				"external.figurepartlist.txt" : "<?php echo $_config['client']['external_figurepartlist']; ?>", 
				"use.sso.ticket" : "1", 
                "sso.ticket" : "<?php echo $ticketrow['auth_ticket']; ?>", 
                "processlog.enabled" : "0", 
                "flash.client.url" : BaseUrl, 
                "flash.client.origin" : "popup" 
            };
            var params =
            {
                "base" : "<?php echo $_config['client']['flash_client_url']; ?>",
                "allowScriptAccess" : "always",
                "menu" : "false"                
            };
            swfobject.embedSWF(BaseUrl + "<?php echo $_config['client']['habbo_swf']; ?>", "client", "100%", "100%", "11.0.0", "<?php echo $Holo['url']; ?>/web-gallery/swf/expressInstall.swf", flashvars, params, null, null);
		</script>
		
    </head>

    <body class="home page-template-default" onselectstart='return false' ondragstart='return false'>
		
		<div onclick="goBack()" id="habbo-web"></div>
		<div onclick="HotelFullScreen()" id="habbo-fullscreen"></div>
		<a href="/gallery" target="_blank"><div id="habbo-camera"></div></a>
		<a href="/support" target="_blank"><div id="habbo-support"></div></a>
		<?php $isadmin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$myrow['id']."' AND rank > 5");
        while($isadm = mysqli_fetch_assoc($isadmin)){ ?><a href="<?php echo $Holo['url'] . '/' . $Holo['panel']; ?>" target="_blank"><div id="habbo-panel"></div></a><?php } ?>
		
		<script type="text/javascript">
			$(document).ready(function(e) {
				$.ajaxSetup({
					cache:true
				});
				setInterval(function() {
					$('#alerts').load('/Mawu/includes/clientalerts.php');
				}, 1000);
				$( "#alerts").click(function() {
					$('#alerts').load('/Mawu/includes/clientalerts.php');
				});
			});
		</script>
		<div id="alerts"></div>
		
		<script>
		$(document).ready(function() {
		$("#latestnews").hide();
		$("#latestnews").delay(60000).fadeIn(500);
		});
		</script>
		
		<script>
		function closediv(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
        else
            document.getElementById(el).style.display = 'none';
    }
		</script>
		
<div id="latestnews" class="ne1" style="left: 0px;">

		<div onclick="goBack()" id="habbo-web"></div>
		<div onclick="HotelFullScreen()" id="habbo-fullscreen"></div>
		<a href="/gallery" target="_blank"><div id="habbo-camera"></div></a>
		<a href="/support" target="_blank"><div id="habbo-support"></div></a>
		<?php $isadmin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$myrow['id']."' AND rank > 5");
        while($isadm = mysqli_fetch_assoc($isadmin)){ ?><a href="<?php echo $Holo['url'] . '/' . $Holo['panel']; ?>" target="_blank"><div id="habbo-panel"></div></a><?php } ?>
		
<div class="ne2"></div>
<div id="close" onclick="closediv('latestnews')" class="ne6">
<div class="ne7"></div>
</div>
<div class="ne8">
<div class="ne9">Últimas notícias</div>

<?php $news = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cms_news ORDER BY id DESC LIMIT 6");
while($new = mysqli_fetch_array($news)){	
?>
<a target="_blank" style="color:black;" href="/news/<?php echo $new['id']; ?>">
<div class="ne25">
<div class="ne26"><img class="ne27" src="<?php echo $new['image']; ?>"></div>
<div class="ne28"><?php echo mysqli_real_escape_string($GLOBALS["___mysqli_ston"], mb_strimwidth($new['title'], 0, 33, "...")); ?></div>
</div>
</a>
<?php } ?>

</div>
</div>
	
        <div id="client">
        <habbo-client-error>
        <div class="client-error__background-frank">
        <span class="client-error__text-contents">
        <h1 class="client-error__title" translate="CLIENT_ERROR_TITLE">¡YA CASI HAS LLEGADO!</h1>
        <p translate="CLIENT_ERROR_FLASH"><b>Espera <?php echo $myrow['username']; ?>!</b><br><br>Debe activar Flash Player manualmente en la configuración de su navegador antes de ingresar a <?php echo $Holo['name']; ?> Hotel! Una vez activado Flash, haga clic en el botón Hotel y haga clic en "Permitir".</p>
        </span>
        <div class="client-error__hotel-button-div">
        <a target="_blank" rel="noopener noreferrer" class="hotel-button" href="https://www.adobe.com/go/getflashplayer"><span class="hotel-button__text" translate="NAVIGATION_HOTEL">Hotel</span></a>
        </div>
		</div>
		</habbo-client-error>
		</div>
	</body>
</html>