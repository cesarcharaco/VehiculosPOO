<!DOCTYPE html>
<html>
<head>
	<title>Categorias</title>
</head>
<body>
<a href="../../Controladores/ControladorCategorias.php?operacion=index">Listar categorias</a><br>
<a href="../../index.php">Inicio</a>
<br>
<h1>Registro de Categorías</h1>
<form action="../../Controladores/ControladorCategorias.php" method="post" name="form">
<strong>Nombre </strong>
<input type="text" name="nombre" placeholder="Ej: Terrestre" required="required">
<input type="hidden" name="operacion" value="guardar">
<br>
<input type="submit" name="guardar" value="Guardar">
<input type="reset" name="limpiar" value="Limpiar">
	
</form>
</body>
</html>