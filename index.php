<?php
//El index muestra al usuario la salida de las vistas y a traves de el enviaremos las distintas acciones del usuario al CONTROLADOR

//MOSTRARA LA PLANTILLA AL USUARIO (template.php) LA CUAL ALOJARA EN views



//Invocamos el modelo que se utilizara en todos los archivos
require_once"models/NavegacionModel.php";
require_once"models/Usuario_CRUD.php";
require_once"controllers/controller.php";

//Para poder ver el template o plantilla, se hace una peticion mediante a un controlador 
//Creamos el objeto:
$mvc = new MvcController();

//muestra la funcion "plantilla" que se encuentra en controllers/controller
$mvc -> plantilla();


?>