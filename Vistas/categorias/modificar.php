<?php 

extract($_REQUEST);
$data=unserialize($data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificando Categoría</title>
</head>
<body>
<label>Categoría a modificar: <?=$data[1]?></label>
<br>
<form action="../../Controladores/ControladorCategorias.php" method="post" name="form">
<label>Nueva Categoría:<input type="text" name="nombre" value="<?=$data[1]?>"></label>
<br>
<input type="hidden" name="id_categoria" value="<?=$data[0]?>">
<input type="hidden" name="operacion" value="actualizar">
<input type="submit" name="enviar" value="enviar">
</form>
</body>
</html>