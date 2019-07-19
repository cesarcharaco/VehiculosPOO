<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
</head>
<body>
<a href="../../Controladores/ControladorUsuarios.php?operacion=index">Listar Usuarios</a><br>
<a href="../../home.php">Inicio</a>
<br>
<h1>Registro de Usuarios</h1>
<form action="../../Controladores/ControladorUsuarios.php" method="post" name="form">
<strong>Nombre </strong>
<input type="text" name="nombre" placeholder="Ej: Cesar" required="required">

<br>
<strong>Correo </strong>
<input type="email" name="correo" placeholder="Ej: micorreo@gmail.com" required="required">

<br>
<strong>Nivel </strong>
<select name="tipo_usuario" title="Seleccione el Nivel">
	<option value="Nivel 1">Nivel 1</option>
	<option value="Nivel 2">Nivel 2</option>
</select>

<br>
<strong>Clave </strong>
<input type="password" name="clave" required="required">

<br>
<strong>Repita la Clave </strong>
<input type="password" name="clave_repetir" required="required">

<br>
<strong>Pregunta Secreta </strong>
<input type="text" name="pregunta" required="required">
<br>
<strong>Respuesta Secreta </strong>
<input type="text" name="respuesta" required="required">

<br>
<input type="hidden" name="operacion" value="guardar">
<input type="submit" name="guardar" value="Guardar">
<input type="reset" name="limpiar" value="Limpiar">
	
</form>
</body>
</html>