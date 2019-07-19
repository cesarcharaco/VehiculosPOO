<?php
extract($_REQUEST);
$data=unserialize($data);
 ?><!DOCTYPE html>
<html>
<head>	<title>Lista de Usuarios</title>
<script type="text/javascript">
	function eliminar(id) {
		if (confirm("Seguro desea eliminar el registro?")) {
			window.location="../../Controladores/ControladorUsuarios.php?operacion=eliminar&id_usuario="+id;
		}
	}
</script>
</head>
<body>

<table align="center">
<a href="../../home.php">Inicio</a>
<center><a href="../../Controladores/ControladorUsuarios.php?operacion=registrar">Registrar</a></center>
	<tr><th>Nro</th><th>Nombre</th><th>Correo</th><th>Tipo Usuario</th><th>Pregunta</th><th>Respuesta</th><th>Opciones</th></tr>
	<?php $num=1; 
		for ($i=0; $i < $filas; $i++) { 
			echo "<tr>";		
	?>	
<td><?=$num?></td>
	<?php for ($j=1; $j < $campos; $j++) { ?>
		<td><?=$data[$i][$j]?></td>

<?php } ?>
<td><a href="../../Controladores/ControladorUsuarios.php?operacion=modificar&id_usuario=<?=$data[$i][0]?>">Modificar</a>

<a href="javascript:eliminar(<?=$data[$i][0]?>)">Eliminar</a>
</td>
<?php	
		$num++;
		} 	?>
</table>
</body>
</html>