<!DOCTYPE html>
<html>
<head>
	<title>Tipos</title>
</head>
<body>
<a href="../../Controladores/ControladorTipos.php?operacion=index">Listar Tipos</a><br>
<a href="../../index.php">Inicio</a>
<br>
<h1>Registro de Tipos</h1>
<form action="../../Controladores/ControladorTipos.php" method="post" name="form">
<strong>Nombre </strong>
<input type="text" name="nombre" placeholder="Ej: Tucan" required="required">
<input type="hidden" name="operacion" value="guardar">
<br>
<input type="submit" name="guardar" value="Guardar">
<input type="reset" name="limpiar" value="Limpiar">
	
</form>
</body>
</html>