<?php

extract($_REQUEST);
$categorias=unserialize($categorias);
$tipos=unserialize($tipos);
$data=unserialize($data_v);

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
<input type="text" name="marca" placeholder="Ej: Ferrari" required="required" value="<?=$data[3]?>">
<strong>Modelo </strong>
<input type="text" name="modelo" placeholder="Ej: porche" required="required" value="<?php echo $data[4]; ?>">
<strong>Placa </strong>
<input type="text" name="placa" placeholder="Ej: MOAS9" required="required" value="<?=$data[5]?>">
<br><br>
<strong>Categoría</strong>
<select name="id_categoria" title="Seleccione la Categoría">
	<?php
	for ($i=0; $i < $filas_cat; $i++) { 
			?>
			<option value="<?=$categorias[$i][0]?>"
				<?php if($categorias[$i][0]==$data[1]){ ?> selected="selected" <?php } ?>
				><?=$categorias[$i][1]?></option>
			<?php
	}
	?>
</select>

<strong>Tipos</strong>
<select name="id_tipo" title="Seleccione el tipo">
	<?php
	for ($i=0; $i < $filas_tip; $i++) { 
			?>
			<option value="<?=$tipos[$i][0]?>"
				<?php if($tipos[$i][0]==$data[2]){ ?> selected="selected" <?php } ?>
				><?=$tipos[$i][1]?></option>
			<?php
	}
	?>
</select>
<br><br>

<input type="hidden" name="operacion" value="actualizar">
<input type="hidden" name="id_vehiculo" value="<?=$data[0]?>">
<br>
<input type="submit" name="guardar" value="Guardar">
<input type="reset" name="limpiar" value="Limpiar">
	
</form>
</body>
</html>