<?php 
ob_start();

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: index.php?action=Ingreso");
	exit();
}

$editar = new MvcController();

$editar -> editarUsuarioController();

$editar -> actualizarUsuarioController();

if(isset($_GET["Cambio"])){
	if($_GET["Cambio"]){
	   echo "<center><font size='6' color='green'>Usuario Actualizado Correctamente</font></center>";
	}
}
 ?>