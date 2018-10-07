<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Conexion.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class UsuarioData extends Conexion{

	# METODO PARA REGISTRAR NUEVOS USUARIOS	
	#-------------------------------------
	public static function newUsuarioModel($UsuarioModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::get()->prepare("INSERT INTO $tabla_db (usuario,password,correo) VALUES (:usuario,:password,:correo)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":usuario", $UsuarioModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $UsuarioModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $UsuarioModel["correo"], PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE USUARIOS
	#-------------------------------------

	public static function viewUsuariosModel($tabla_db){

		$stmt = Conexion::get()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN USUARIO
	#------------------------------------
	public static function deleteUsuarioModel($UsuarioModel, $tabla_db){

		$stmt = Conexion::get()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $UsuarioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN USUARIO
	#------------------------------------
	public static function editarUsuarioModel($UsuarioModel, $tabla_db){

		$stmt = Conexion::get()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $UsuarioModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN USUARIO
	#------------------------------------
	public static function actualizarUsuarioModel($UsuarioModel, $tabla_db){

		$stmt = Conexion::get()->prepare("UPDATE $tabla_db SET usuario=:usuario, password=:password, correo=:correo WHERE id = :id");
		$stmt->bindParam(":usuario", $UsuarioModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $UsuarioModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $UsuarioModel["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $UsuarioModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA EL INGRESO DE UN USUARIO
	#------------------------------------
	public static function ingresoUsuarioModel($UsuarioModel, $tabla_db)
	{
		$stmt = Conexion::get()->prepare("SELECT usuario, password FROM $tabla_db WHERE usuario = :usuario AND password = :password");	
		$stmt->bindParam(":usuario", $UsuarioModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $UsuarioModel["password"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();
	}
}
?>