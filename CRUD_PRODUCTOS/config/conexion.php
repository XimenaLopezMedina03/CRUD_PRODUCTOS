<?php

//Declarar la clase para la conexion a BD
class Conexion
{
	//Propiedades

	//Metodos
	public static function getConexionMySQL()
	{
		//Declarar la variables (parametros) para PDO
		$cadena = "mysql:host=127.0.0.1;port=3307;dbname=BDMARKET";
		$usuario = "root";
		$clave = "";

		//Instanciar un nuevo objeto PDO
		$conexion = new PDO($cadena,$usuario,$clave);

		//Retornar el objeto de conexion
		return $conexion;
	}
}

?>