<?php
extract($_REQUEST);
$data=unserialize($data);
 ?><!DOCTYPE html>
<html>
<head>
	<title>Lista de Tipos</title>
<script type="text/javascript">
	function eliminar(id) {
		if (confirm("Seguro desea eliminar el registro?")) {
			window.location="../../Controladores/ControladorTipos.php?operacion=eliminar&id_tipo="+id;
		}
	}
</script>
</head>
<body>

<table align="center">
<a href="../../home.php">Inicio</a>
<center><a href="../../Controladores/ControladorTipos.php?operacion=registrar">Registrar</a></center>
	<tr><th>Nro</th><th>Tipo</th><th>Opciones</th></tr>
	<?php $num=1; 
		for ($i=0; $i < $filas; $i++) { 
			echo "<tr>";		
	?>	
<td><?=$num?></td>
	<?php for ($j=1; $j < $campos; $j++) { ?>
		<td><?=$data[$i][$j]?></td>

<?php } ?>
<td><a href="../../Controladores/ControladorTipos.php?operacion=modificar&id_tipo=<?=$data[$i][0]?>">Modificar</a>

<a href="javascript:eliminar(<?=$data[$i][0]?>)">Eliminar</a>
</td>
<?php	
		$num++;
		} 	?>
</table>
</body>
</html>