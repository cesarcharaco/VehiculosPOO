<?php
extract($_REQUEST);
$usuarios=unserialize($usuarios);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Seleccionando Usuario</title>
</head>
<body>
<a href="../../Controladores/ControladorUsuarios.php?operacion=index">Listar Usuarios</a><br>
<a href="../../home.php">Inicio</a>
<br>
<form action="../../Controladores/ControladorUsuarios.php?operacion=buscar_privilegios_usuario" name="form" method="POST">
	<label>Usuarios</label>
	<br>
	<select name="id_usuario" title="Seleccione un usuario">
		<?php
			for ($i=0; $i < $row_use; $i++) { 
				?>
				<option value="<?=$usuarios[$i][0]?>"><?=$usuarios[$i][1]?> | <?=$usuarios[$i][2]?></option>
				<?php
			}
		 ?>
	</select>
	
	<br>
	<input type="submit" name="Guardar" id="guardar" value="Guardar">
</form>
</body>
</html>












