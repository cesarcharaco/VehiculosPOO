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
		<input type="hidden" name="operacion" value="validar_correo">

		<tr><td colspan="2" align="center"><b>Ingrese su correo para verificación</b></td></tr>
		<tr><td>Correo: </td>
			<td><input type="email" name="correo" placeholder="Ej:micorreo@vehiculo.com" title="Ingrese un correo válido" required="required" ></td></tr>
		
		<tr><td colspan="2" align="center"><input type="submit" name="enviar" value="enviar"></td></tr>
		
	</form>
</table>
</div>
</body>
</html>