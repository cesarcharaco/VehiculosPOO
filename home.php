<?php include('./Controladores/ControladorPrivilegios.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Vehiculos</title>
</head>
<body>
<h1>Bienvenido!! tu de nuevo?</h1>
<br><a href="Controladores/ControladorLogin.php?operacion=logout">Salir</a>

<strong>Categorias</strong>
<ul>
	<li><a href="Controladores/ControladorCategorias.php?operacion=registrar">Registro</a></li>
<?php if (ControladorPrivilegios::buscar_acceso('Categorias','index')>0) { ?> 
	<li><a href="Controladores/ControladorCategorias.php?operacion=index">Listar</a></li>
<?php } ?>

</ul>
<strong>Tipos</strong>
<ul>
	<li><a href="Controladores/ControladorTipos.php?operacion=registrar">Registro</a></li>
	<li><a href="Controladores/ControladorTipos.php?operacion=index">Listar</a></li>
</ul>
<br>
<strong>Vehículos</strong>
<ul>
	<li><a href="Controladores/ControladorVehiculos.php?operacion=registrar">Registro</a></li>
	<li><a href="Controladores/ControladorVehiculos.php?operacion=index">Listar</a></li>
</ul>
<br>
<strong>Usuarios</strong>
<ul>
	<li><a href="Controladores/ControladorUsuarios.php?operacion=registrar">Registro</a></li>
	<li><a href="Controladores/ControladorUsuarios.php?operacion=index">Listar</a></li>
	<li><a href="Controladores/ControladorUsuarios.php?operacion=asignar_registrar">Asignación de Privilegios</a></li>
</ul>
</body>

</html>