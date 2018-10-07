<?php 
session_start();

if (!isset($_SESSION['user'])) {
	header("Location: index.php?action=Ingreso");
	exit();
}

if(isset($_GET["idBorrar"])){
	$idBorrar = $_GET["idBorrar"];
}

if (isset($_SESSION['password'])) {
	$password = $_SESSION['password'];
}

if(isset($_GET["confirmed"])){
	$confirmed = "true";
	$eliminar = new MvcController();
	$eliminar -> deleteUsuarioController();
}else{
	$confirmed = "false";
}

?>
<input type="hidden" name="idBorrar" id="idBorrar" value="<?php echo $idBorrar; ?>"/>
<input type="hidden" name="password" id="password" value="<?php echo $password; ?>"/>
<input type="hidden" name="confirmed" id="confirmed" value="<?php echo $confirmed; ?>" />
<script type="text/javascript">
	var id = document.getElementById('idBorrar').value;
	var password = document.getElementById('password').value;
	var confirmed = document.getElementById('confirmed').value;
	var resp = confirm("Deseas eliminar el usuario?");

	if (resp && confirmed!="true") {
		var pwc = prompt("Ingresa tu contraseña para confirmar:");
		if (pwc && pwc==password) {
			alert("Eliminado correctamente.");
			var timer = 2;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=Eliminar&idBorrar="+id+"&confirmed=true";
				}
			}
			idInterval = setInterval(time,1000);
			
		}else{
			alert("Contraseña incorrecta, imposible eliminar.");
			var timer = 2;
			var idInterval = null;

			function time() {
				timer--;
				if (timer==0) {
					clearInterval(idInterval);
					window.location = "index.php?action=Usuarios";
				}
			}
			idInterval = setInterval(time,1000);
		}
		
	}else{
		window.location = "index.php?action=Usuarios";
	}

</script>
<?php 



?>