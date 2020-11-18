<?php class Conexion {
	
public function mysql() {
	
		$mysqld = array (
			'host'  =>  '51.178.49.43',
			'user'  =>  'Rayden',
			'pass'  =>  'C0caC0la',
			'db'    =>  'hiddocmsv2'
			);

		($GLOBALS["___mysqli_ston"] = mysqli_connect($mysqld['host'],  $mysqld['user'],  $mysqld['pass'])) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		mysqli_select_db($GLOBALS["___mysqli_ston"], $mysqld['db']) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	}
}

Conexion::mysql();

$Holo = array(
	'ip'           =>     '51.178.49.43',
	'url'          =>     'http://hiddo.es',
	'client_url'   =>     'http://hiddo.es/hotel',
	'panel'        =>     'housekeeping',
	'name'         =>     'Hiddo',
    'mision'       =>     'Soy nuevo en Hiddo!',
    'monedas'      =>     '1000',
	'minrank'      =>     '6',
	'maxrank'      =>     '10',
	'minhkr'       =>     '7',
	'gender'       =>     'M',
	'look'         =>     'hr-115-42.hd-195-19.ch-3030-82.lg-275-1408.fa-1201.ca-1804-64',
	'contactemail' =>     '',
	'facebook'     =>     '',
	'twitter'      =>     '',
	'discordinvl'  =>     '', #URL do Convite para o Grupo do Discord
	'discordwid'   =>     '', #ID do Widget do Discord
	'cameraurl'    =>     'http://hiddo.es/camera/',
	'thumbsurl'    =>     'http://hiddo.es/camera/thumbnails/',
	'avatar'       =>     'https://habbo.com.br/habbo-imaging/avatarimage?figure=',
	'url_badges'   =>     'http://images.hiddo.es/c_images/album1584/',
	'recaptcha'    =>     '6LcT2uMZAAAAAK1vV9THeVLohjYBwHXjPFtCUj_s');
	
?>