<?php
extract($_REQUEST);
$categorias=unserialize($categorias);
$tipos=unserialize($tipos);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro Vehículo</title>
</head>
<body>
<a href="../../Controladores/ControladorVehiculos.php?operacion=index">Listar Vehículos</a><br>
<a href="../../index.php">Inicio</a>
<br>
<form action="../../Controladores/ControladorVehiculos.php" method="post" name="form">
<strong>Marca </strong>
<input type="text" name="marca" placeholder="Ej: Ferrari" required="required">
<strong>Modelo </strong>
<input type="text" name="modelo" placeholder="Ej: porche" required="required">
<strong>Placa </strong>
<input type="text" name="placa" placeholder="Ej: MOAS9" required="required">
<br><br>
<strong>Categoría</strong>
<select name="id_categoria" title="Seleccione la Categoría">
	<?php
	for ($i=0; $i < $filas_cat; $i++) { 
			?>
			<option value="<?=$categorias[$i][0]?>"><?=$categorias[$i][1]?></option>
			<?php
	}
	?>
</select>

<strong>Tipos</strong>
<select name="id_tipo" title="Seleccione el tipo">
	<?php
	for ($i=0; $i < $filas_tip; $i++) { 
			?>
			<option value="<?=$tipos[$i][0]?>"><?=$tipos[$i][1]?></option>
			<?php
	}
	?>
</select>
<br><br>

<input type="hidden" name="operacion" value="guardar">
<br>
<input type="submit" name="guardar" value="Guardar">
<input type="reset" name="limpiar" value="Limpiar">
	
</form>
</body>
</html>