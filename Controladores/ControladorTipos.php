<?php 
include("../Modelos/clasedb.php");

extract($_REQUEST);


class ControladorTipos
{
	

public function index(){
	$db=new clasedb();//instanciando clasedb
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT * FROM tipos";//query

	//ejecutando query
	if ($res=mysqli_query($conex,$sql)) {
		echo "entro";
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
		
	    header("Location: ../Vistas/tipos/index.php?filas=".$filas."&campos=".$campos."&data=".serialize($datos));
	} else {
		echo "nanai";
	}
	
	
		//enviando datos
}//fin de la funcion index
public function registrar(){

	header("Location: ../Vistas/tipos/registrar.php");
}//fin registrar

public function guardar(){
	extract($_POST);//EXTRAYENDO VARIABLES DEL FORMULARIO
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT * FROM tipos WHERE tipo='".$nombre."'";
	$res=mysqli_query($conex,$sql);
	$cuantos=mysqli_num_rows($res);
	echo $cuantos;
	if ($cuantos>0) {
		?>
		<script type="text/javascript">
			alert("EL TIPO YA EXISTE");
			window.location="ControladorTipos.php?operacion=registrar";
		</script>
			<?php
	} else {
		$sql="INSERT INTO tipos(tipo) VALUES('".$nombre."')";

		$result=mysqli_query($conex,$sql);
		if ($result) {
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO EXITOSO, DESEA REGISTRAR OTRO?")) {
				window.location="ControladorTipos.php?operacion=registrar";	
			}else{
				window.location="ControladorTipos.php?operacion=index";
			}
			
		</script>
			<?php

		} else {
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO FALLIDO, DESEA VOLVER A INTENTARLO?")) {
				window.location="ControladorTipos.php?operacion=registrar";	
			}else{
				window.location="ControladorTipos.php?operacion=index";
			}
			
		</script>
			<?php
		}//cierre del else de $result = true
	}//cierre del else de cuantos>0
}//fin de la funcion guardar
public function modificar(){
	extract($_REQUEST);//extrayendo valores de url
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos
	
	$sql="SELECT * FROM tipos WHERE id=".$id_tipo."";
	$res=mysqli_query($conex,$sql);//ejecutando consulta
	$data=mysqli_fetch_array($res);//extrayendo datos en array

	header("Location: ../Vistas/tipos/modificar.php?data=".serialize($data));
}
public function actualizar()
{
	extract($_POST);//EXTRAYENDO VARIABLES DEL FORMULARIO
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos
	
	$sql="SELECT * FROM tipos WHERE tipo='".$nombre."' AND id<>".$id_tipo;
//echo $sql;
$res=mysqli_query($conex,$sql);

$cant=mysqli_num_rows($res);//trae cuantos registros tiene la consulta
		if ($cant>0) {
			?>
				<script type="text/javascript">
					alert("TIPO YA REGISTRADO");
					window.location="ControladorTipos.php?operacion=index";
				</script>
			<?php
		}else{
		$sql="UPDATE tipos SET tipo='".$nombre."' WHERE id=".$id_tipo;

		$res=mysqli_query($conex,$sql);
			if ($res) {
				?>
					<script type="text/javascript">
						alert("REGISTRO MODIFICADO");
						window.location="ControladorTipos.php?operacion=index";
					</script>
				<?php
			} else {
				?>
					<script type="text/javascript">
						alert("ERROR AL MODIFICAR EL REGISTRO");
						window.location="ControladorTipos.php?operacion=index";
					</script>
				<?php
			}

		}
}//fin de la función actualizar
public function eliminar()
{
	extract($_REQUEST);//extrayendo variables del url
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos

	$sql="DELETE FROM tipos WHERE id=".$id_tipo;

		$res=mysqli_query($conex,$sql);
		if ($res) {
			?>
				<script type="text/javascript">
					alert("REGISTRO ELIMINADO");
					window.location="ControladorTipos.php?operacion=index";
				</script>
			<?php
		} else {
			?>
				<script type="text/javascript">
					alert("REGISTRO NO ELIMINADO");
					window.location="ControladorTipos.php?operacion=index";
				</script>
			<?php
		}
}//fin de la función eliminar
static function controlador($operacion){
		$tipo=new ControladorTipos();
	switch ($operacion) {
		case 'index':

			$tipo->index();
			break;
		case 'registrar':
			$tipo->registrar();
			break;
		case 'guardar':
			$tipo->guardar();
			break;
		case 'modificar':
			$tipo->modificar();
			break;
		case 'actualizar':
			$tipo->actualizar();
			break;
		case 'eliminar':
			$tipo->eliminar();
			break;
		default:
			?>
				<script type="text/javascript">
					alert("No existe la ruta");
					window.location="ControladorTipos.php?operacion=index";
				</script>
			<?php
			break;
	}//cierre del switch
}//cierre de la funcion controlador
}//cierre de la clase


ControladorTipos::controlador($operacion);


?>