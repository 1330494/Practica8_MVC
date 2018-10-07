<h1 id="font">Registrar Usuario</h1>

<form method="POST">
	<label>Username:</label><br>
	<input type="text" placeholder="Nombre de usuario" name="usuarioReg" required>
	<br>
	<label>Password:</label><br>
	<input type="password" name="passwordReg" placeholder="Contraseña" required>
	<br>
	<label>E-Mail:</label><br>
	<input type="email" name="correoReg"  placeholder="E-Mail" required>
	<br>
	<center><input type="submit" name="GuardarUsuario" value="Guardar"></center>
</form>
<?php 
	$registro = new MvcController();

	//se invoca la función nuevoGrupoController de la clase MvcController:
	$registro -> nuevoUsuarioController();

	if(isset($_GET["action"])){
	  if($_GET["action"] == "Ok"){
	    echo "<center><font size='6' color='green'>Registro Exitoso</font></center>";
	  }
	}

?>