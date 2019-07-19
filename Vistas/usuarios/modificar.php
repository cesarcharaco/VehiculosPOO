<?php 

extract($_REQUEST);
$data=unserialize($data);
?>
<!DOCTYPE html>
<html>

<head>
	<title>Usuarios</title>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript">
            window.onload = function() {
                document.getElementById('cambiar').onclick = function () {
                    if( $(this).prop('checked') ) {
						$('#clave_anterior').removeAttr('disabled');
						$('#clave').removeAttr('disabled');
						$('#clave_repetir').removeAttr('disabled');
					}else{
						$('#clave_anterior').attr('disabled',true);
						$('#clave').attr('disabled',true);
						$('#clave_repetir').attr('disabled',true);
					}
                }
            }
            
        </script>
</head>
<body>
<a href="../../Controladores/ControladorUsuarios.php?operacion=index">Listar Usuarios</a><br>
<a href="../../index.php">Inicio</a>
<br>
<h1>Modificación de Usuarios</h1>
<form action="../../Controladores/ControladorUsuarios.php" method="post" name="form">
<strong>Nombre </strong>
<input type="text" name="nombre" value="<?=$data[1]?>"  placeholder="Ej: Cesar" required="required">

<br>
<strong>Correo </strong>
<input type="email" name="correo" value="<?=$data[2]?>" placeholder="Ej: micorreo@gmail.com" required="required">
<br>
<strong>Nivel </strong>
<select name="tipo_usuario" title="Seleccione el Nivel">
	<?php if ($data[4]=="Admin") {
	?>
	<option value="Admin" <?php if($data[4]=="Admin"){ ?> selected="selected" <?php } ?> >Admin</option>
	<?php	
	}
	?>
	<option value="Nivel 1" <?php if($data[4]=="Nivel 1"){ ?> selected="selected" <?php } ?> >Nivel 1</option>
	<option value="Nivel 2" <?php if($data[4]=="Nivel 2"){ ?> selected="selected" <?php } ?> >Nivel 2</option>
</select>
<br>
<input type="checkbox" name="cambiar" id="cambiar" value="1"> Deseo cambiar la clave
<br><strong>Clave Anterior</strong>
<input type="password" name="clave_anterior" id="clave_anterior" required="required" disabled="disabled" />

<br><strong>Clave </strong>
<input type="password" name="clave" id="clave" required="required" disabled="disabled">

<br>
<strong>Repita la Clave </strong>
<input type="password" name="clave_repetir" id="clave_repetir" required="required" disabled="disabled">

<br>
<strong>Pregunta Secreta </strong>
<input type="text" name="pregunta" value="<?=$data[5]?>" required="required">
<br>
<strong>Respuesta Secreta </strong>
<input type="text" name="respuesta" value="<?=$data[6]?>" required="required">

<br>
<input type="hidden" name="id_usuario" value="<?=$data[0]?>">
<input type="hidden" name="operacion" value="actualizar">
<input type="submit" name="guardar" value="Guardar">
<input type="reset" name="limpiar" value="Limpiar">
	
</form>
</body>
</html>
