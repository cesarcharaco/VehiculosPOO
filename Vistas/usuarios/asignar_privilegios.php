<?php
extract($_REQUEST);
$privilegios=unserialize($privilegios);

?><!DOCTYPE html>
<html>
<head>
	<title>Asignacion de Privilegios</title>
</head>
<body>
<a href="../../Controladores/ControladorUsuarios.php?operacion=index">Listar Usuarios</a><br>
<a href="../../home.php">Inicio</a>
<br>

<form>
	<table>
		<tr><td>Usuario: <?=$nombre?> | <?=$correo?></td></tr>
	</table>
	<label><b>Privilegios</b></label>
	<table>
<?php 
	for ($i=0; $i < $row_priv; $i++) { 
		
			?>
			<tr><td>Módulo:<?=$privilegios[$i][1]?> | <?=$privilegios[$i][2]?></td><td><input type="checkbox" name="id_privilegio[]" value="<?=$privilegios[$i][0]?>" 
				<?php if ($privilegios[$i][3]=="Si") {
				?> checked="checked" <?php
				} ?>></td></tr>
			<?php
		
	}
?>
		

	</table>
</form>
</body>
</html>








