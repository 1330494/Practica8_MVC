<?php
class MvcController{
	//Llamar a la plantilla
	public function plantilla(){
		//include se utiliza para invocar el archivo que ocntiene el codigo html
		include "views/template.php";
	}
	//INTERACCION CON EL USUARIO
	public function enlacesPaginasController(){
		//TRABAJAR CON LOS ENLACES DE LAS PAGINAS
		//VALIDAMOS SI LA VARIABLE "action" VIENE VACIA, ES DECIR, CUANDO SE ABRE LA PAGINA POR PRIMERA VEZ SE DEBE CARGAR LA VISTA index.php

		if(isset($_GET["action"])){
			//guardar el valor de la variable action en "views/modules/navegacion.php" en el cual se recibe mediante el metodo GET esa variable 
			$enlacesController = $_GET["action"];
		}
		else{
			//Si viene vacio inicializo con index
			$enlacesController = "index";
		}
		//Mostrar los archivos de los enlaces de cada una de las secciones: Inicio, Nosotros, etc
		//PARA ESTO HAY QUE MANDAR AL MODELO PARA QUE HAGA DICHO PROCESO Y MUESTRE LA INFORMACION
		$respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);
		include $respuesta;
	}

	public function NavController()
	{
		EnlacesPaginas::NavegacionModel();
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Control para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteUsuarioController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = UsuarioData::deleteUsuarioModel($datosController, "usuarios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de usuarios
				header("location:index.php?action=Usuarios");
			}
		}
	}

	# REGISTRO DE USUARIOS
	#------------------------------------
	public function nuevoUsuarioController(){

		if(isset($_POST["GuardarUsuario"])){
			//Recibe a traves del método POST el name (html) de usuario, password y correo se almacenan los datos en una variable de tipo array con sus respectivas propiedades (usuario, password, correo):
			$datosController = array( 
				"usuario"=>$_POST['usuarioReg'],
				"password"=>$_POST['passwordReg'],
				"correo"=>$_POST['correoReg']
			);

			//Se le dice al modelo models/UsuarioCrud.php (UsuarioData::registroUsuarioModel),que en la clase "UsuarioData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = UsuarioData::newUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				header("Location: index.php?action=Ok");
			}
			else{
				header("location:index.php");
			}
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = UsuarioData::viewUsuariosModel("usuarios");
		$par = "";
		$inpar = "";  
		$posPar = 0;
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<table>
			<thead>
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Password</th>
					<th>Correo</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>';
				foreach($respuesta as $usuario){
					if ($posPar%2 == 0) {$par="par";$inpar="inpar2";}
					else{$par="";$inpar="inpar";}
				echo'<tr>
					<td id="'.$inpar.'">'.$usuario["id"].'</td>
					<td id="'.$par.'">'.$usuario["usuario"].'</td>
					<td id="'.$par.'">'.crypt($usuario["password"],'YYL').'</td>
					<td id="'.$par.'">'.($usuario["correo"]).'</td>
					<td id="'.$par.'"><a href="index.php?action=Editar&idUsuario='.$usuario["id"].'">Editar</a></td>
					<td id="'.$par.'"><a id="delete" href="index.php?action=Eliminar&idBorrar='.$usuario["id"].'">Eliminar</a></td>
					</tr>
				';
					$posPar++;
				}
	  echo '</tbody>
			</table>';
	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController()
	{
		// Si se envia formulario de nuevo usuario
		if(isset($_POST["AccederUsuario"])){
			// Guardamos los datos en un arreglo
			$datosController = array( "usuario"=>$_POST["usuarioLog"], 
								      "password"=>$_POST["passwordLog"]);

			$respuesta = UsuarioData::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["usuario"] == $_POST["usuarioLog"] && $respuesta["password"] == $_POST["passwordLog"]){
				
				// Se crea la sesion
				session_start();
				$_SESSION["user"] = true;
				$_SESSION["password"] = $_POST["passwordLog"];
				
				header("Location: ./index.php?action=Usuarios");
			}else{
				header("Location: ./index.php?action=Fallo");
			}
		}	
	}

	#EDITAR USUARIOS
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["idUsuario"];
		$respuesta = UsuarioData::editarUsuarioModel($datosController, "usuarios");

		echo'
		<h1 id="font">Editar Usuario</h1>
    		<!-- form start -->
    		<form method="POST">
        
              	<label>Usuario:</label><br>
              	<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required >
              	<br>
              	<label>Correo:</label><br>
              	<input type="email" value="'.$respuesta["correo"].'" name="correoEditar" required >
	         	<br>
              	<label for="PW1">Nueva contraseña:</label><br>
              	<input type="password" id="PW1" name="password1Editar" >
	      		<br>
              	<label for="PW2">Confirmar contraseña:</label><br>
              	<input type="password" id="PW2" name=password2Editar" >
              	<br>					
        
              	<label>Contraseña anterior:</label><br>
              	<input type="password" id="oldPassword" name="oldPassword" >
              	<br>
              	<input type="hidden" name="passwordEditar" id="passwordEditar" value="'.$respuesta['password'].'">

              	<input type="hidden" name="id" id="id" value="'.$respuesta['id'].'">
              	<script type="text/javascript">
					document.getElementById("PW1").onchange = function(e){
							
						if( this.value ){
							this.required = "required";
							document.getElementById("PW2").required = "required";
							document.getElementById("oldPassword").required = "required";					
						}else{
							this.required = false;
							document.getElementById("PW2").required = false;
							document.getElementById("oldPassword").required = false;
						}
					};

					document.getElementById("PW2").onchange = function(e){
						if( this.value != document.getElementById("PW1").value){
							this.value = "";
							document.getElementById("PW1").focus();
							alert("Nuevas con no coinciden");
						}
					};

					document.getElementById("oldPassword").onchange = function(e){
						if( this.value != document.getElementById("passwordEditar").value){
							this.value = "";
							this.focus();
							alert("Confirmar con la contraseña correcta.");
						}
					};

				</script>
 				
           		<center> <input type="submit" value="Actualizar" name="UsuarioEditar"> </center>
    		</form>';
	}

	#ACTUALIZAR USUARIOS
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["UsuarioEditar"])){
			$datosController = array();
			if ($_POST["password1Editar"]) {
				$datosController = array(
					"id" => $_POST["id"],
					"usuario"=>$_POST["usuarioEditar"],
					"password"=>$_POST["password1Editar"],
					"correo"=>$_POST["correoEditar"]
				);
			}else{
				$datosController = array(
					"id" => $_POST["id"],
					"usuario"=>$_POST["usuarioEditar"],
					"password"=>$_POST["passwordEditar"],
					"correo"=>$_POST["correoEditar"]
				);
			}

			
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				header("Location: index.php?action=Editar&idUsuario=".$_POST["id"]."&Cambio=1");
			}else{
				echo "error";
			}
		}
	}

}

?>