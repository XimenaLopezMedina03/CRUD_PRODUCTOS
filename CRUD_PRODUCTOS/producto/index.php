<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="estilo_pdo.css">
	<title>Producto</title>

	<script>
		function confirmar(ruta)
		{
			//Mostrar un mensaje y recoger la respuesta
			var respuesta = confirm("Esta seguro que desea ELIMINAR ?");
			//Controlar respuesta
			if(respuesta)
			{
				//Direccionar hacia la ruta
				parent.location = ruta;
			}

		}
	</script>

</head>
<body>
	<?php
		if(isset($_GET["txtDescripcionBuscar"]))
		{
			//Recoger el valor
			$descripcionBuscar = $_GET["txtDescripcionBuscar"];
			//Incluir el archivo PHP que contiene la Clase Producto
			require_once("../models/producto.php"); //Ruta Relativa
			//Instanciar la clase Producto
			$producto = new Producto();
			//Ejecutar el metodo de busqueda
			$productos = $producto->getBuscarPorDescripcion($descripcionBuscar);
		}
		else
		{
			$descripcionBuscar = "";
			$productos = array();
		}

	?>

	<h1>Gestion de Productos</h1>

	<a href="agregar.php">Agregar</a>
	
	<hr>
	<form>
		<table>
			<tr>
				<td><label>Descripcion: </label></td>
				<td><input type="text" name="txtDescripcionBuscar" size="100" value="<?php echo $descripcionBuscar; ?>"></td>
				<td><input type="submit" value="Buscar"></td>
			</tr>
		</table>
	</form>
	
	<hr>
	<table class="tabla-resultado">
		<tr>
			<th>CODIGO</th>
			<th>DESCRIPCION</th>
			<th>CATEGORIA</th>
			<th>PRECIO S/</th>
		</tr>



		<?php
			foreach($productos as $producto)
			{
		?>
		<tr>
			<td><?php echo $producto->id; ?></td>			
			<td><?php echo $producto->descripcion; ?></td>
			<td><?php echo $producto->categoria; ?></td>
			<td><?php echo $producto->precio; ?></td>

			<td><a href='editar.php?idBuscar=<?php echo $producto->id; ?>'>Editar</a></td>
			<td><a href="javascript:confirmar('eliminar.php?idEliminar=<?php echo $producto->id; ?>')" >Eliminar</a></td>

		</tr>
		<?php
			}
		?>

	</table>


</body>
</html>