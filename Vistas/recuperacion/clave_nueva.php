<?php
extract($_REQUEST);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Vehiculo P&G</title>
</head>
<body>
	
	<br><br><br><br><br><br><br>
	<div style="background-color: #C0C0C0; width: 300px;">
<table align="center">
	<form action="../../Controladores/ControladorLogin.php" name="form" method="POST">
		<input type="hidden" name="operacion" value="cambiar_clave">
		<input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
		<tr>
			<td colspan="2" align="center"><b>Cambio de clave</b><br>
				</td>
		</tr>
		<tr>
			<td>Clave Nueva: </td>
			<td><input type="password" name="clave_nueva"  title="Ingrese su clave nueva" required="required" ></td>
		</tr>
		<tr>
			<td>Confirmación: </td>
			<td><input type="password" name="clave_nueva_confirm" title="Ingrese la Confirmación de su Clave Nueva" required="required"></td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" name="enviar" value="Enviar"></td></tr>
		
	</form>
</table>
</div>
</body>
</html>