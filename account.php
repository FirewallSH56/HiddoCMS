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

if(MANTENIMIENTO == '1' && $myrow['rank'] < $Holo['minrank']) 
{
    header("Location: mantenimiento");
	exit;
}

if(isset($_POST['email_a']) && isset($_POST['email_n']) && isset($_POST['email_nr']))
{
    $EA = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email_a']);
    $EN = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email_n']);
    $ENR = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['email_nr']);

    $Checkmail = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE mail = '". $EN ."'");

    if(empty($EA) || empty($EN) || empty($ENR))
    {
        $aerror = 'No dejes campos vacíos.';
    }
    elseif(mysqli_num_rows($Checkmail) > 0) 
    {
        $aerror = 'El correo electrónico que ingresaste ya existe, pon otro.';
    }
    elseif($EN != $ENR)
    {
        $aerror = 'Los correos electrónicos no son los mismos, inténtelo de nuevo.';
    }
    elseif($EA != $myrow['mail'])
    {
        $aerror = 'El correo electrónico anterior no es correcto.';
    }
    else
    {
        mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET mail = '". $EN ."' WHERE id = '". $myrow['id'] ."'");
        $aok = 'Has cambiado tu correo electrónico correctamente!<META http-equiv="refresh" content="2;URL=/account/correo">';
    }
}

if(isset($_POST['theme']))
{
    $THM = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['theme']);

    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET theme = '". $THM ."' WHERE id = '". $myrow['id'] ."'");
    $aok = 'Has cambiado tu tema correctamente!<META http-equiv="refresh" content="2;URL=/account/site">';
}

if(isset($_POST['homecolor']))
{
    $THM = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['homecolor']);

    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET home_color = '". $THM ."' WHERE id = '". $myrow['id'] ."'");
    $aok = 'Has cambiado tu color de home correctamente!.<META http-equiv="refresh" content="2;URL=/account/site">';
}

if(isset($_POST['blockvisible']))
{
    $BVS = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['blockvisible']);

    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET visible = '". $BVS ."' WHERE id = '". $myrow['id'] ."'");
    $aok = 'Has cambiado tus preferencias correctamente!<META http-equiv="refresh" content="2;URL=/account/prefer">';
}


if(isset($_POST['blockfriendship']))
{
    $BFR = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['blockfriendship']);

    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users_settings SET block_friendrequests = '". $BFR ."' WHERE user_id = '". $myrow['id'] ."'");
    $aok = 'Has cambiado tus preferencias correctamente!<META http-equiv="refresh" content="2;URL=/account/prefer">';
}

if(isset($_POST['blockfollow']))
{
    $RIN = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['blockfollow']);

    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users_settings SET block_roominvites = '". $RIN ."' WHERE user_id = '". $myrow['id'] ."'");
    $aok = 'Has cambiado tus preferencias correctamente!<META http-equiv="refresh" content="2;URL=/account/prefer">';
}

if(isset($_POST['blockalerts']))
{
    $BAL = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['blockalerts']);

    mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users_settings SET block_alerts = '". $BAL ."' WHERE user_id = '". $myrow['id'] ."'");
    $aok = 'Has cambiado tus preferencias correctamente!<META http-equiv="refresh" content="2;URL=/account/prefer">';
}

if(isset($_POST['Pass']) && isset($_POST['NPass']) && isset($_POST['RNPass']))
{
    $Pass = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['Pass']);
    $NPass = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['NPass']);
    $RNPass = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['RNPass']);

    $Checkpass = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '". $myrow['id'] ."'");
    $passss = mysqli_fetch_assoc($Checkpass);

    if(empty($Pass) || empty($NPass) || empty($RNPass))
    {
        $aerror = 'No dejes campos vacíos.';
    }
    elseif($NPass != $RNPass)
    {
        $aerror = 'Las nuevas contraseñas no coinciden.';
    }
    elseif(md5($Pass) != $passss['password'])
    {
        $aerror = 'La contraseña anterior no es correcta.';
    }
    else
    {
        mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET password = '". md5($NPass) ."' WHERE id = '". $myrow['id'] ."'");
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE users SET old = '0' WHERE id = '". $myrow['id'] ."'");
		echo '<META http-equiv="refresh" content="1;URL=/logout">';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="<?php echo $myrow['theme']; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $Holo['name']; ?>: Configuracion</title>

<link rel='dns-prefetch' href='//code.jquery.com' />
<link rel='dns-prefetch' href='//cdn.jsdelivr.net' />
<link rel='dns-prefetch' href='//use.fontawesome.com' />
<link rel='dns-prefetch' href='//s.w.org' />

<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>

<link rel='stylesheet' id='wp-block-library-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/style.min.css?ver=5.3.2' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/bootstrap.min.css?ver=4.4.1' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href='https://use.fontawesome.com/releases/v5.12.1/css/all.css?ver=5.12.1' type='text/css' media='all' />
<link rel='stylesheet' id='swiper-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/swiper.min.css?ver=5.3.1' type='text/css' media='all' />
<link rel='stylesheet' id='selectize-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/selectize.css?ver=0.12.6' type='text/css' media='all' />
<link rel='stylesheet' id='style-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/style.css?ver=1.1' type='text/css' media='all' />
<link rel='stylesheet' id='theme-styles-css'  href='<?php echo $Holo['url']; ?>/Mawu/css/style.css?ver=5.3.2' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery.js?ver=1.12.4-wp'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/simple-likes-public.js?ver=0.5'></script>

<link rel="icon" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-32x32.png" sizes="32x32" />
<link rel="icon" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-180x180.png" />
<meta name="msapplication-TileImage" content="<?php echo $Holo['url']; ?>/Mawu/image/favicon/cropped-favicon-1-270x270.png" />

</head>

<body class="home page-template-default" onselectstart='return false' ondragstart='return false'>

	<nav class="navbar fixed-top navbar-expand-lg navbar-light">
	<a class="navbar-brand"><?php echo $Holo['name']; ?> Hotel<span class="tag">Beta</span></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul id="menu-principal" class="navbar-nav mr-auto">
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/me" class="nav-link">Home</a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/articles" class="nav-link">Noticias</a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/gallery" class="nav-link">Galeria</a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/famous" class="nav-link">Salon de la fama</a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/team" class="nav-link">Equipo</a>
			</li>
			<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/support" class="nav-link">Soporte</a>
			</li>
			<!--<li class="menu-item menu-item-type-post_type_archive nav-item">
				<a href="/shop" class="nav-link"><font color="dark orange">Shop</font></a>
			</li>-->
		</ul>
		
		<div class="d-flex justify-content-center align-items-center ml-auto mt-3 mt-lg-0">
		
		<?php $isadmin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$myrow['id']."' AND rank > 5");
        while($isadm = mysqli_fetch_assoc($isadmin)){ ?><a href="<?php echo $Holo['url'] . '/' . $Holo['panel']; ?>" target="_blank" class="btn btn-warning"><font color="white">Panel</font></a>    <?php } ?>
		<a href="<?php echo $Holo['client_url']; ?>" class="btn btn-success">Entrar al hotel</a>    
		
			<div class="dropdown" style="cursor:cell">
			
				<div id="dropUser" class="d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="avatar pixel">
						<img src="<?php echo $Holo['avatar'] . $myrow['look']; ?> &amp;action=std&amp;direction=3&amp;head_direction=3&amp;img_format=png&amp;gesture=std&amp;headonly=0&amp;size=s" alt="<?php echo $myrow['username']; ?>">
						</div>
				</div>
					
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropUser">
						<a class="dropdown-item" href="/home/<?php echo $myrow['username']; ?>"><i class="fas fa-user text-muted mr-2"></i>Mi perfil</a>
						<a class="dropdown-item active" href="/account/prefer"><i class="fas fa-cog text-muted mr-2"></i> Configuracion</a>
						<a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt text-muted mr-2"></i> Cerrar sesion</a>
					</div>
			</div>
		</div>
	</div>
	</nav>
	
	<main>
<div class="jumbotron jumbotron-fluid yellow">
	<div class="container">
<?php if($_GET['item'] == "correo"){ ?>
		<h1>Configuración <a href="/account/prefer" class="btn btn-warning ml-4"><font color="white">Preferencias</font></a> <a href="/account/site" class="btn btn-warning ml-4"><font color="white">Web</font></a> <a href="/account/correo" class="btn btn-warning ml-4 active"><font color="white">E-mail</font></a> <a href="/account/contra" class="btn btn-warning ml-4"><font color="white">Contraseña</font></a></h1>
<?php }elseif($_GET['item'] == "contra"){ ?>
		<h1>Configuración <a href="/account/prefer" class="btn btn-warning ml-4"><font color="white">Preferencias</font></a> <a href="/account/site" class="btn btn-warning ml-4"><font color="white">Web</font></a> <a href="/account/correo" class="btn btn-warning ml-4"><font color="white">E-mail</font></a> <a href="/account/contra" class="btn btn-warning ml-4 active"><font color="white">Contraseña</font></a></h1>
<?php }elseif($_GET['item'] == "site"){ ?>
		<h1>Configuración <a href="/account/prefer" class="btn btn-warning ml-4"><font color="white">Preferencias</font></a> <a href="/account/site" class="btn btn-warning ml-4 active"><font color="white">Web</font></a> <a href="/account/correo" class="btn btn-warning ml-4"><font color="white">E-mail</font></a> <a href="/account/contra" class="btn btn-warning ml-4"><font color="white">Contraseña</font></a></h1>
<?php }elseif($_GET['item'] == "prefer"){ ?>
		<h1>Configuración <a href="/account/prefer" class="btn btn-warning ml-4 active"><font color="white">Preferencias</font></a> <a href="/account/site" class="btn btn-warning ml-4"><font color="white">Web</font></a> <a href="/account/correo" class="btn btn-warning ml-4"><font color="white">E-mail</font></a> <a href="/account/contra" class="btn btn-warning ml-4"><font color="white">Contraseña</font></a></h1>
<?php } ?>
	</div>
</div>

<section>
	<div class="container">
		
			<div class="row">
			
			    <div class="col-md-3"></div>
<?php if($_GET['item'] == "correo"){ ?>
				<div class="col-md-6">
				    <h3 class="mb-3 mt-4">Actualizar correo electrónico</h3>
		
        <?php 
            if($aerror !== NULL)
            {
             echo  '<div class="alert alert-danger" role="alert">'.$aerror.'</div>';   
            }
			if($aok !== NULL)
			{
				echo  '<div class="alert alert-success" role="alert">'.$aok.'</div>'; 
			}
        ?>
					
					<form action="" id="adduser" method="post">
						<div class="form-group form-username">
							<label for="inputEmail">Tu correo electrónico actual</label>
							<input class="form-control" type="email" name="email_a" id="inputEmail" value="<?php echo $myrow['mail']; ?>" required >
						</div>
						
						<hr>
						
						<div class="form-group form-username">
							<label for="inputEmail">Ahora tu nuevo correo electrónico</label>
							<input class="form-control" type="email" name="email_n" id="inputEmail" required >
						</div>
						
						<div class="form-group form-username">
							<label for="inputEmail">Repite tu nuevo correo electrónico</label>
							<input class="form-control" type="email" name="email_nr" id="inputEmail" required >
						</div>

						<p class="form-submit">
							<input type="submit" name="account" class="btn btn-primary" value="Actualizar e-mail">
						</p>
					</form>
					
				</div>
<?php }elseif($_GET['item'] == "contra"){ ?>
				<div class="col-md-6">
				    <h3 class="mb-3 mt-4">Cambia tu contraseña</h3>
					
        <?php 
            if($aerror !== NULL)
            {
             echo  '<div class="alert alert-danger" role="alert">'.$aerror.'</div>';   
            }
			if($aok !== NULL)
			{
				echo  '<div class="alert alert-success" role="alert">'.$aok.'</div>'; 
			}
        ?>
					
					<form action="" id="adduser" method="post">
						<div class="form-group form-password">
							<label for="pass1">Tu contraseña actual</label>
							<input class="form-control" type="password" name="Pass" id="inputPassword" required >
						</div>
						
						<hr>
						
						<div class="form-group form-password">
							<label for="pass2">Ahora crea una nueva contraseña</label>
							<input class="form-control" type="password" name="NPass" id="inputPassword" required >
						</div>
						
						<div class="form-group form-password">
							<label for="pass2">Repite tu nueva contraseña</label>
							<input class="form-control" type="password" name="RNPass" id="inputPassword" required >
							<small class="form-text text-muted">Asegúrate de no perderte ninguna letra y de que no la olvidarás.</small>
						</div>

						<p class="form-submit">
							<input type="submit" name="account" class="btn btn-primary" value="Actualizar contraseña">
						</p>
					</form>
					
				</div>
<?php }elseif($_GET['item'] == "site"){ ?>
				<div class="col-md-6">
				    <h3 class="mb-3 mt-4">Cambia tu forma de ver nuestro hotel</h3>
					
        <?php 
            if($aerror !== NULL)
            {
             echo  '<div class="alert alert-danger" role="alert">'.$aerror.'</div>';   
            }
			if($aok !== NULL)
			{
				echo  '<div class="alert alert-success" role="alert">'.$aok.'</div>'; 
			}
        ?>
					
					<form action="" id="adduser" method="post">
						<div class="form-group form-display_name">
							<label for="display_name">Elija el tema que desee</label>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$myrow['id']."' AND theme = 'light'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="theme" id="theme">
								<option value="light" selected="selected">Tema Claro</option>
								<option value="dark">Tema Oscuro</option>
							</select>
<?php } ?>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE id = '".$myrow['id']."' AND theme = 'dark'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="theme" id="theme">
								<option value="dark" selected="selected">Tema Oscuro</option>
								<option value="light">Tema Claro</option>
							</select>
<?php } ?>
							<small class="form-text text-muted">
Si cambia esto, cambiaremos totalmente los colores de cómo ve el sitio web actual <?php echo $Holo['name']; ?> Hotel, nos adaptaremos tanto para el tema Oscuro como para el tema Claro (visto por defecto).</strong></small>
						</div>
						
						<div class="form-group form-display_name">
							<label for="display_name">Elige el <font color="<?php echo $myrow['home_color']; ?>"><b>color</b></font> superior de tu <a href="/home/<?php echo $myrow['username']; ?>"><?php echo $Holo['name']; ?> Home</a></label>
							<input class="form-control" type="color" value="<?php echo $myrow['home_color']; ?>" name="homecolor" id="homecolor">
							<small class="form-text text-muted">
Tu color favorito para mostrar en tu perfil dentro de <?php echo $Holo['name']; ?> Hotel.</strong></small>
						</div>

						<p class="form-submit">
							<input type="submit" name="account" id="updateuser" class="btn btn-primary" value="Actualizar preferencias">
						</p>
					</form>
					
				</div>
<?php }elseif($_GET['item'] == "prefer"){ ?>
				<div class="col-md-6">
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE online = '1' AND id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
        <div class="alert alert-danger" role="alert">Hey! <?php echo $myrow['username']; ?>, estas <b>Conectado</b> en <?php echo $Holo['name']; ?> Hotel, 
y no podremos realizar cambios en su cuenta, para acceder a los cambios necesita estar <b>Desconectado</b> de <?php echo $Holo['name']; ?> Hotel.</div>
<?php } ?>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE online = '0' AND id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
				    <h3 class="mb-3 mt-4">Tus preferencias</h3>
					
        <?php 
            if($aerror !== NULL)
            {
             echo  '<div class="alert alert-danger" role="alert">'.$aerror.'</div>';   
            }
			if($aok !== NULL)
			{
				echo  '<div class="alert alert-success" role="alert">'.$aok.'</div>'; 
			}
        ?>
					
					<form action="" id="adduser" method="post">
					
						<div class="form-group form-display_name">
							<label for="display_name">Visibilidad del perfil <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="" data-original-title="
Si elige No tener un perfil, tampoco podrá ver el otros <?php echo $Holo['name']; ?> Home."></i></label>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE visible = '1' AND id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockvisible" id="blockvisible">
								<option value="1" selected="selected">Todos pueden ver mi perfil</option>
								<option value="0">No quiero un perfil</option>
							</select>
<?php } ?>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users WHERE visible = '0' AND id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockvisible" id="blockvisible">
								<option value="1">Todos pueden ver mi perfil</option>
								<option value="0" selected="selected">No quiero un perfil</option>
							</select>
<?php } ?>
						</div>
					
						<div class="form-group form-display_name">
							<label for="display_name">Configuraciones de "Sígueme"</label>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users_settings WHERE block_friendrequests = '0' AND user_id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockfollow" id="blockfollow">
								<option value="0" selected="selected">
Mis amigos pueden seguirme</option>
								<option value="1">No quiero que me sigan</option>
							</select>
<?php } ?>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users_settings WHERE block_friendrequests = '1' AND user_id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockfollow" id="blockfollow">
								<option value="0">Mis amigos pueden seguirme</option>
								<option value="1" selected="selected">No quiero que me sigan</option>
							</select>
<?php } ?>
						</div>

						<div class="form-group form-display_name">
							<label for="display_name">Solicitudes de amistad</label>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users_settings WHERE block_friendrequests = '0' AND user_id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockfriendship" id="blockfriendship">
								<option value="0" selected="selected">Otros usuarios 
puedes enviarme solicitudes de amistad</option>
								<option value="1">
No quiero recibir solicitudes de amistad</option>
							</select>
<?php } ?>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users_settings WHERE block_friendrequests = '1' AND user_id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockfriendship" id="blockfriendship">
								<option value="0">Otros usuarios 
puedes enviarme solicitudes de amistad</option>
								<option value="1" selected="selected">No quiero recibir solicitudes de amistad</option>
							</select>
<?php } ?>
						</div>
						
						<div class="form-group form-display_name">
							<label for="display_name">Alertas dentro del Hotel <i class="fas fa-question-circle text-muted" data-toggle="tooltip" title="" data-original-title="
Al deshabilitar las alertas dentro del hotel, no podrá ver las alertas de eventos ni las alertas normales, como las advertencias de los miembros de nuestro equipo."></i></label>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users_settings WHERE block_alerts = '0' AND user_id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockalerts" id="blockalerts">
								<option value="0" selected="selected">Quiero ver alertas dentro de <?php echo $Holo['name']; ?></option>
								<option value="1">
No quiero ver alertas</option>
							</select>
<?php } ?>
<?php $actuals = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM users_settings WHERE block_alerts = '1' AND user_id = '". $myrow['id'] ."'");
while($actual = mysqli_fetch_assoc($actuals)){ ?>
							<select class="custom-select" name="blockalerts" id="blockalerts">
								<option value="0">Quiero ver alertas dentro de <?php echo $Holo['name']; ?></option>
								<option value="1" selected="selected">No quiero ver alertas</option>
							</select>
<?php } ?>
						</div>
						
						<p class="form-submit">
							<input type="submit" name="account" id="updateuser" class="btn btn-primary" value="Actualizar preferencias">
						</p>
						
					</form>
<?php  } ?>
			</div>
<?php  } ?>
			</div>
		
	</div>
</section>

	</main>
	
	<?php require_once("Mawu/includes/footer.php"); ?>
	
<script type='text/javascript' src='https://code.jquery.com/jquery-3.4.1.min.js?ver=3.4.1'></script>
<script type='text/javascript' src='https://code.jquery.com/jquery-1.11.3.min.js?ver=3.4.1'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js?ver=1.16.0'></script>

<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery.cookie.js?ver=1.4.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/bootstrap.min.js?ver=4.4.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/swiper.min.js?ver=5.3.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/selectize.min.js?ver=0.12.6'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/moment.min.js?ver=2.22.2'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/jquery.page.js?ver=0.1'></script>
<script type='text/javascript' src='<?php echo $Holo['url']; ?>/Mawu/js/main.js?ver=1.0'></script>
		
</body>
</html>