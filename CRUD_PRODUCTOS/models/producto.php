<?php
//Incluir el PHP de la conexion
require_once("../config/conexion.php"); //Ruta relativa tipo linux


//Declarar la clase producto
class Producto
{
	//Propiedades
	public $id;
	public $descripcion;
	public $categoria;
	public $precio;

	//Metodos (CRUD)
	public function getBuscarPorId($idBuscar)
	{
		//Crear la conexion: ejecutar el metodo estatico
		$cnx = Conexion::getConexionMySQL();

		//Preparar la sentencia SQL (statement)
		$snt = $cnx->prepare("select * from producto where id=:idBuscar;");

		//Pasar el valor del parametro a la sentencia SQL
		$snt->bindValue(":idBuscar", $idBuscar);

		//Ejecutar la sentencia
		$snt->execute();

		//Recoger la fila
		$fila = $snt->fetch();

		//Leer los valores de la fila en la misma clase
		$this->id = $fila["id"];
		$this->descripcion = $fila["descripcion"];
		$this->categoria = $fila["categoria"];
		$this->precio = $fila["precio"];

		//Retornar el resultado
		return $this;

	}
	public function getBuscarPorDescripcion($descripcionBuscar)
	{
		//Crear la conexion: ejecutar el metodo estatico
		$cnx = Conexion::getConexionMySQL();

		//Preparar la sentencia SQL (statement)
		$snt = $cnx->prepare("select * from producto where descripcion like concat('%',:descripcionBuscar,'%');");

		//Pasar el valor del parametro a la sentencia SQL
		$snt->bindValue(":descripcionBuscar", $descripcionBuscar);

		//Ejecutar la sentencia
		$snt->execute();

		//Declarar el array de productos
		$productos = [];

		//Recorrer mientras exista una fila
	    while($fila = $snt->fetch()) 
	    {
	    	//Instanciar un Producto
	        $producto = new Producto();
	        
	        //Leer los valores de la fila
	        $producto->id = $fila["id"];
	        $producto->descripcion = $fila["descripcion"];
	        $producto->categoria = $fila["categoria"];
	        $producto->precio = $fila["precio"];

	        //Agregar al array el objeto Producto
	        $productos[] = $producto;
    	}

		//Retornar el resultado
		return $productos;
	}
	
	public function setInsertar($producto)
	{
		//Crear la conexion: ejecutar el metodo estatico
		$cnx = Conexion::getConexionMySQL();

		// *** INSERTAR EL PRODUCTO *** //

		//Preparar la sentencia SQL (statement)
		$snt = $cnx->prepare("insert into producto (descripcion, categoria, precio) values (:descripcion,:categoria,:precio);");

		//Pasar el valor del parametro a la sentencia SQL
		$snt->bindValue(":descripcion", $producto->descripcion);
		$snt->bindValue(":categoria", $producto->categoria);
		$snt->bindValue(":precio", $producto->precio);

		//Ejecutar la sentencia
		$snt->execute();

		// *** RECUPERAR EL NUEVO ID *** //
		//Preparar la sentencia SQL (statement)
		$snt = $cnx->prepare("select max(id) as nuevoId from producto;");
		//Ejecutar la sentencia
		$snt->execute();
		//Recoger la fila
		$fila = $snt->fetch();

		//Leer el valor del nuevo Id
		$nuevoId = $fila["nuevoId"];

		//Retornar el resultado
		return $nuevoId;

	}
	public function setActualizar($producto)
	{
		//Crear la conexion: ejecutar el metodo estatico
		$cnx = Conexion::getConexionMySQL();

		// *** ACTUALIZAR EL PRODUCTO *** //

		//Preparar la sentencia SQL (statement)
		$snt = $cnx->prepare("update producto set descripcion=:descripcion, categoria=:categoria, precio=:precio where id=:id;");

		//Pasar el valor del parametro a la sentencia SQL
		$snt->bindValue(":id", $producto->id);
		$snt->bindValue(":descripcion", $producto->descripcion);
		$snt->bindValue(":categoria", $producto->categoria);
		$snt->bindValue(":precio", $producto->precio);

		//Ejecutar la sentencia
		$snt->execute();		
	}
	public function setEliminar($idEliminar)
	{
		//Crear la conexion: ejecutar el metodo estatico
		$cnx = Conexion::getConexionMySQL();

		// *** ELIMINAR EL PRODUCTO *** //

		//Preparar la sentencia SQL (statement)
		$snt = $cnx->prepare("delete from producto where id=:id;");

		//Pasar el valor del parametro a la sentencia SQL
		$snt->bindValue(":id", $idEliminar);

		//Ejecutar la sentencia
		$snt->execute();
	}


}

?>