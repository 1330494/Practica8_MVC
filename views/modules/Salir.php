<?php 
session_start();
if (isset($_SESSION['user'])) {
	$_SESSION['user'] = null;
	session_destroy();
	?>
	<center><h1 id="font">Ha salido de la aplicacion.</h1></center>
	<?php
}else{
	?>
	<center><h1 id="font">No ha ingresado a la aplicacion.</h1></center>
	<?php
}

 ?>