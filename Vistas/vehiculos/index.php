<?php
extract($_REQUEST);
$data=unserialize($data);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vehículos</title>
	<script type="text/javascript">
	function eliminar(id) {
		if (confirm("Seguro desea eliminar el registro?")) {
			window.location="../../Controladores/ControladorVehiculos.php?operacion=eliminar&id_vehiculo="+id;
		}
	}
</script>
</head>
<body>
<a href="../../home.php">Inicio</a>
<center><a href="../../Controladores/ControladorVehiculos.php?operacion=registrar">Registrar</a></center>
<table>
	<tr><th>Nro</th><th>Marca</th><th>Modelo</th><th>Placa</th><th>Categoría</th><th>Tipo</th><th>Opciones</th></tr>
	<?php $num=1; 
		for ($i=0; $i < $filas; $i++) { 
			echo "<tr>";		
	?>	
<td><?=$num?></td>
	<?php for ($j=1; $j < $campos; $j++) { ?>
		<td><?=$data[$i][$j]?></td>

<?php } ?>
<td><a href="../../Controladores/ControladorVehiculos.php?operacion=modificar&id_vehiculo=<?=$data[$i][0]?>">Modificar</a>

<a href="javascript:eliminar(<?=$data[$i][0]?>)">Eliminar</a>
</td>
<?php	
		$num++;
		} 	?>
</table>
</body>
</html>