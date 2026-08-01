<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="estilo_pdo.css">
	<title>Producto</title>
</head>
<body>
	<?php
	//Incluir el archivo PHP del modelo Producto
	require_once("../models/producto.php");

	//Instanciar el Producto
	$producto = new Producto();

	if(isset($_GET["txtId"]))
	{
		//INSERTAR EL NUEVO PRODUCTO

		//Recoger los valores enviados por el formulario en el objeto Producto
		$producto->id = $_GET["txtId"];
		$producto->descripcion = $_GET["txtDescripcion"];
		$producto->categoria = $_GET["txtCategoria"];
		$producto->precio = $_GET["txtPrecio"];

		//Verificar si el ID es 0 para INSERTAR
		if($producto->id==0)
		{
			//Ejecutar el metodo de insercion de un producto
			//Recoger el nuevo ID en el objeto Producto
			$producto->id = $producto->setInsertar($producto);
		}
	}
	else
	{
		//ESTABLECER VALORES PREDETERMINADOS
		$producto->id = 0;
		$producto->descripcion = "";
		$producto->categoria = "";
		$producto->precio = 0.0;
	}

	?>

	<h1>Agregar Productos</h1>

	<a href="agregar.php">Nuevo</a>
	
	<hr>
	<form>
		<table>
			<tr>
				<td><label>CODIGO</label></td>
				<td><input type="text" name="txtId" size="5" readonly value="<?php echo $producto->id ?>"/></td>
			</tr>
			<tr>
				<td><label>DESCRIPCION</label></td>
				<td><input type="text" name="txtDescripcion" size="50" value="<?php echo $producto->descripcion ?>"/></td>
			</tr>
			<tr>
				<td><label>CATEGORIA</label></td>
				<td><input type="text" name="txtCategoria" size="25" value="<?php echo $producto->categoria ?>"/></td>
			</tr>
			<tr>
				<td><label>PRECIO</label></td>
				<td><input type="text" name="txtPrecio" size="10" value="<?php echo $producto->precio ?>"/></td>
			</tr>

			<tr>
				<td><a href="index.php">Retornar</a></td>
				<td><input type="submit" value="Guardar" /></td>
			</tr>

		</table>
	</form>
	



</body>
</html>