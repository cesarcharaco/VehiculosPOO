
<?php 
include("../Modelos/clasedb.php");

extract($_REQUEST);


class ControladorUsuarios
{
	

public function index(){
	$db=new clasedb();//instanciando clasedb
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT id,nombre,correo,tipo_usuario,pregunta,respuesta FROM usuarios";//query

	//ejecutando query
	if ($res=mysqli_query($conex,$sql)) {
		//echo "entro";
		$campos=mysqli_num_fields($res);//cuantos campos trae la consulta	
		$filas=mysqli_num_rows($res);//cuantos registro trae la consulta
		$i=0;
		$datos[]=array();//inicializando array
		//extrayendo datos
		while($data=mysqli_fetch_array($res)){
			for ($j=0; $j <$campos ; $j++) { 
				$datos[$i][$j]=$data[$j];
			}
			$i++;
		}
		
	    header("Location: ../Vistas/usuarios/index.php?filas=".$filas."&campos=".$campos."&data=".serialize($datos));
	} else {
		echo "Error en la BDD";
	}
	
	
		//enviando datos
}//fin de la funcion index
public function registrar(){

	header("Location: ../Vistas/usuarios/registrar.php");
}//fin registrar

public function guardar(){
	extract($_POST);//EXTRAYENDO VARIABLES DEL FORMULARIO
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT * FROM usuarios WHERE correo='".$correo."'";
	$res=mysqli_query($conex,$sql);
	$cuantos=mysqli_num_rows($res);
	//echo $cuantos;
	if ($cuantos>0) {
		?>
		<script type="text/javascript">
			alert("EL USUARIO CON ESTE CORREO YA EXISTE");
			window.location="ControladorUsuarios.php?operacion=registrar";
		</script>
			<?php
	} else {
		if ($clave == $clave_repetir) {
			
		$clave=hash('sha256',$clave); 
		$sql="INSERT INTO usuarios(nombre,correo,clave,tipo_usuario,pregunta,respuesta) VALUES('".$nombre."','".$correo."','".$clave."','".$tipo_usuario."','".$pregunta."','".$respuesta."')";
		//echo $sql;
		$result=mysqli_query($conex,$sql);
		$id_usuario=mysqli_insert_id($conex);//obteniendo el último id generado
		//echo $id_usuario;
		if ($result) {
			//---------asignando privilegios --------
			for ($i=1; $i <= 18; $i++) { 
				$sql="INSERT INTO usuarios_has_privilegios VALUES(null,".$id_usuario.",".$i.",'No')";
				mysqli_query($conex,$sql);
			}
			//--------------------
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO EXITOSO, DESEA REGISTRAR OTRO?")) {
				window.location="ControladorUsuarios.php?operacion=registrar";	
			}else{
				window.location="ControladorUsuarios.php?operacion=index";
			}
			
		</script>
			<?php

		} else {
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO FALLIDO, DESEA VOLVER A INTENTARLO?")) {
				window.location="ControladorUsuarios.php?operacion=registrar";	
			}else{
				window.location="ControladorUsuarios.php?operacion=index";
			}
			
		</script>
			<?php
		}//cierre del else de $result = true
		} else {
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO FALLIDO, LAS CLAVES NO COINCIDEN?")) {
				window.location="ControladorUsuarios.php?operacion=registrar";	
			}else{
				window.location="ControladorUsuarios.php?operacion=index";
			}
			
		</script>
			<?php
		}
		
	}//cierre del else de cuantos>0
}//fin de la funcion guardar
public function modificar(){
	extract($_REQUEST);//extrayendo valores de url
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos
	
	$sql="SELECT * FROM usuarios WHERE id=".$id_usuario."";
	$res=mysqli_query($conex,$sql);//ejecutando consulta
	$data=mysqli_fetch_array($res);//extrayendo datos en array

	header("Location: ../Vistas/usuarios/modificar.php?data=".serialize($data));
}
public function actualizar()
{
	extract($_POST);//EXTRAYENDO VARIABLES DEL FORMULARIO
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos
	
	$sql="SELECT * FROM usuarios WHERE correo='".$correo."' AND id<>".$id_usuario;
//echo $sql;
	$res=mysqli_query($conex,$sql);

	$cant=mysqli_num_rows($res);//trae cuantos registros tiene la consulta
		if ($cant>0) {
			?>
				<script type="text/javascript">
					alert("USUARIO YA REGISTRADO");
					window.location="ControladorUsuarios.php?operacion=index";
				</script>
			<?php
		}else{
			//modificando en caso de que quiera cambiar la clave
			if (isset($cambiar)) {
				$sql="SELECT clave FROM usuarios WHERE id=".$id_usuario;
				$res=mysqli_query($conex,$sql);
				$row=mysqli_fetch_object($res);
				$clave_anterior=hash('sha256',$clave_anterior); 
				if ($row->clave==$clave_anterior) {
					if ($clave_repetir==$clave) {
						$clave=hash('sha256',$clave);
						$sql="UPDATE usuarios SET nombre='".$nombre."',correo='".$correo."',tipo_usuario='".$tipo_usuario."',clave='".$clave."',pregunta='".$pregunta."',respuesta='".$respuesta."' WHERE id=".$id_usuario;

							$res=mysqli_query($conex,$sql);
							if ($res) {
								?>
									<script type="text/javascript">
										alert("REGISTRO MODIFICADO");
										window.location="ControladorUsuarios.php?operacion=index";
									</script>
								<?php
							} else {
								?>
									<script type="text/javascript">
										alert("ERROR AL MODIFICAR EL REGISTRO");
										window.location="ControladorUsuarios.php?operacion=index";
									</script>
								<?php
							}			
					} else {
						?>
						<script type="text/javascript">
							alert("LA CLAVE Y REPETIR CLAVE NO COINCIDEN");
							window.location="ControladorUsuarios.php?operacion=index";
						</script>
						<?php	
					}//fin del condicional de la clave y repetir no coinciden
					
				} else {
					?>
						<script type="text/javascript">
							alert("LA CLAVE ANTERIOR NO COINCIDE");
							window.location="ControladorUsuarios.php?operacion=index";
						</script>
					<?php
				}//fin del condicional de comparacion con clave anterior
				
			} else {
			
			$sql="UPDATE usuarios SET nombre='".$nombre."',correo='".$correo."',tipo_usuario='".$tipo_usuario."',pregunta='".$pregunta."',respuesta='".$respuesta."' WHERE id=".$id_usuario;

			$res=mysqli_query($conex,$sql);
				if ($res) {
					?>
						<script type="text/javascript">
							alert("REGISTRO MODIFICADO");
							window.location="ControladorUsuarios.php?operacion=index";
						</script>
					<?php
				} else {
					?>
						<script type="text/javascript">
							alert("ERROR AL MODIFICAR EL REGISTRO");
							window.location="ControladorUsuarios.php?operacion=index";
						</script>
					<?php
				}
			}//fin del condicional de cambiar
		}//fin del condicional de correo registrado
}//fin de la función actualizar
public function eliminar()
{
	extract($_REQUEST);//extrayendo variables del url
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos

	$sql="DELETE FROM usuarios WHERE id=".$id_usuario;

		$res=mysqli_query($conex,$sql);
		if ($res) {
			?>
				<script type="text/javascript">
					alert("REGISTRO ELIMINADO");
					window.location="ControladorUsuarios.php?operacion=index";
				</script>
			<?php
		} else {
			?>
				<script type="text/javascript">
					alert("REGISTRO NO ELIMINADO");
					window.location="ControladorUsuarios.php?operacion=index";
				</script>
			<?php
		}
}//fin de la función eliminar

public function asignar_registrar()
{
	$db=new clasedb();
	$conex=$db->conectar();

	$sql="SELECT id,nombre,correo FROM usuarios";

	if ($res=mysqli_query($conex,$sql)) {
		$usuarios[]=array();
		$row_use=mysqli_num_rows($res);
		
		$i=0;
		while ($data=mysqli_fetch_array($res)) {
			for ($j=0; $j < 3; $j++) { 
				$usuarios[$i][$j]=$data[$j];
			}
			$i++;		
		}
		
			header('Location: ../Vistas/usuarios/select_usuario.php?row_use='.$row_use.'&usuarios='.serialize($usuarios));	
		} else {
			echo "Error en la BDD";
		}
	
}//fin de la funcion asignar_registrar
public function asignar(){

		extract($_POST);
		$db=new clasedb();
		$conex=$db->conectar();
		if (isset($id_privilegio)) {
			for ($i=0; $i < count($id_privilegio) ; $i++) { 
				
			}
		} else {
			?>
				<script type="text/javascript">
					alert("NO HA SELECCIONADO NINGÚN PRIVILEGIO");
					window.location="ControladorUsuarios.php?operacion=asignar_registrar";
				</script>
				<?php
		}
		
		

}//fin de la funcion asignar
public function buscar_privilegios_usuario()
{
	extract($_POST);
	$db=new clasedb();
	$conex=$db->conectar();

	$sql="SELECT * FROM usuarios WHERE id=".$id_usuario;
	$res=mysqli_query($conex,$sql);
	$data=mysqli_fetch_object($res);
	$nombre=$data->nombre;
	$correo=$data->correo;
	//buscando privilegios
		$sql="SELECT privilegios.*,usuarios_has_privilegios.status FROM privilegios,usuarios_has_privilegios,usuarios WHERE  privilegios.id=usuarios_has_privilegios.id_privilegio AND usuarios.id=usuarios_has_privilegios.id_usuario AND usuarios.id=".$id_usuario;
	//echo $sql;
		if ($res2=mysqli_query($conex,$sql)) {
			if (mysqli_num_rows($res2)>0) {
				$privilegios[]=array();
				$i=0;
				$row_priv=mysqli_num_rows($res2);
				while ($data2=mysqli_fetch_array($res2)) {
					for ($j=0; $j < 4; $j++) { 
						$privilegios[$i][$j]=$data2[$j];
					}
					$i++;
				}
			header('Location: ../Vistas/usuarios/asignar_privilegios.php?nombre='.$nombre.'&correo='.$correo.'&row_priv='.$row_priv.'&privilegios='.serialize($privilegios));			
			} else {
				?>
				<script type="text/javascript">
					alert("NO EXISTEN PRIVILEGIOS REGISTRADOS");
					window.location="ControladorUsuarios.php?operacion=index";
				</script>
				<?php
			}
}
}//cierre de la funcion
static function controlador($operacion){
		$nombre=new ControladorUsuarios();
	switch ($operacion) {
		case 'index':

			$nombre->index();
			break;
		case 'registrar':
			$nombre->registrar();
			break;
		case 'guardar':
			$nombre->guardar();
			break;
		case 'modificar':
			$nombre->modificar();
			break;
		case 'actualizar':
			$nombre->actualizar();
			break;
		case 'eliminar':
			$nombre->eliminar();
			break;
		case 'asignar_registrar':
			$nombre->asignar_registrar();
			break;
		case 'asignar':
			$nombre->asignar();
			break;
		case 'buscar_privilegios_usuario':
			$nombre->buscar_privilegios_usuario();
			break;
		default:
			?>
				<script type="text/javascript">
					alert("No existe la ruta");
					window.location="ControladorUsuarios.php?operacion=index";
				</script>
			<?php
			break;
	}//cierre del switch
}//cierre de la funcion controlador
}//cierre de la clase


ControladorUsuarios::controlador($operacion);


?>