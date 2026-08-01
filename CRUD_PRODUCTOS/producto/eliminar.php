<?php

	if(isset($_GET["idEliminar"]))
	{
		//Incorporar el archivo PHP con la clase
		require_once("../models/producto.php");
		//Leer el Id Eliminar
		$idEliminar = $_GET["idEliminar"];
		//Instanciar la clase Producto
		$producto = new Producto();
		//Ejecutar el metodo de eliminacion
		$producto->setEliminar($idEliminar);

		//Mostrar un mensaje
		echo "<h1>Eliminando ...<h1>";

		//Reireccionamiento
		header("refresh:1;url=index.php");


	}
	else
	{
		echo "No hay idEliminar";
	}

?>