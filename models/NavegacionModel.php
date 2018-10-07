<?php
class EnlacesPaginas{
	//Una funcion con el parametro $enlacesModel que se recibe a travez del controlador 
	public static function enlacesPaginasModel($enlacesModel){
		//Validamos 
		if($enlacesModel == "Registro" || $enlacesModel == "Ingreso" || $enlacesModel == "Salir" || $enlacesModel == "Usuarios" || $enlacesModel == "Editar" || $enlacesModel == "Eliminar"){
			//Mostramos el URL concatenando con $enlacesModel
			$module = "views/modules/".$enlacesModel.".php";

		}
		//Una vez "action" viene vacio (validando en el controlador) entonces se consulta si la variable $enlacesModel es igual a la cadena "index" para de ser asi se muestre index.php 
		else if ($enlacesModel == "index"){
			$module = "views/modules/Ingreso.php";
		}
		else if ($enlacesModel == "Ok"){
			$module = "views/modules/Registro.php";
		}
		else if ($enlacesModel == "Fallo"){
			$module = "views/modules/Ingreso.php";
		}
		//Validar una LISTA BLANCA
		else{
			$module = "views/modules/Ingreso.php";
		}
		return $module;
	}

	public static function NavegacionModel()
	{
		include 'views/modules/navegacion.php';
	}
}

?>