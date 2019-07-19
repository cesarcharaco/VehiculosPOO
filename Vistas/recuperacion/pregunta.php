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
		<input type="hidden" name="operacion" value="respuestas">
		<input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
		<tr><td colspan="2" align="center"><b>Ingrese la respuesta a la pregunta de seguridad</b></td></tr>
		<tr>
			<td>Pregunta: </td>
			<td><span><b><?=$pregunta?></b></span></td>
		</tr>
		<tr>
			<td>Respuesta: </td>
			<td><input type="password" name="respuesta" title="Ingrese su respuesta de seguridad" required="required"></td>
		</tr>
		<tr><td colspan="2" align="center"><input type="submit" name="enviar" value="enviar"></td></tr>
		
	</form>
</table>
</div>
</body>
</html>