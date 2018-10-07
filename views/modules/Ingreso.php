<h1 id="font">Acceder</h1>

<form method="POST">
	<label>Usuario:</label><br>
	<input type="text" name="usuarioLog" required placeholder="Username">
	<br>
	<label>Password:</label><br>
	<input type="password" name="passwordLog" required placeholder="Contraseña">
	<br>
	<center><input type="submit" name="AccederUsuario" value="Ingresar"></center>
</form>

<?php 
	$registro = new MvcController();

	//se invoca la función nuevoGrupoController de la clase MvcController:
	$registro -> ingresoUsuarioController();

	if(isset($_GET["action"])){
	  if($_GET["action"] == "Fallo"){
	    echo "<center><font size='6' color='red'>Fallo al ingresar</font></center>";
	  }
	}

?>