<?php 

session_start();

if (!isset($_SESSION['user'])) {
	header("Location: index.php?action=Ingreso");
	exit();
}

 ?>
<h1 id="font">Usuarios</h1>
<br>

<?php 

$vista_usuarios = new MvcController();

$vista_usuarios -> vistaUsuariosController();

 ?>