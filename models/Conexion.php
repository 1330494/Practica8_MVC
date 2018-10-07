<?php 
// Clase para devolver una conexion a una base de datos especifica.
class Conexion
{
	
	public static function get()
	{
		// Devuelve la conexion a la base de datos.
		$tmp_conn = new PDO("mysql:host=localhost;dbname=practica_mvc;port=3307;","root","usbw");
		return $tmp_conn;
	}

}

 ?>