<?php 

extract($_REQUEST);
$data=unserialize($data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificando Tipo</title>
</head>
<body>
<label>Tipo a modificar: <?=$data[1]?></label>
<br>
<form action="../../Controladores/ControladorTipos.php" method="post" name="form">
<label>Nuevo Tipo:<input type="text" name="nombre" value="<?=$data[1]?>"></label>
<br>
<input type="hidden" name="id_tipo" value="<?=$data[0]?>">
<input type="hidden" name="operacion" value="actualizar">
<input type="submit" name="enviar" value="enviar">
</form>
</body>
</html>