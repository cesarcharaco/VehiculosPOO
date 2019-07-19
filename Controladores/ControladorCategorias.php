<?php 
include("../Modelos/clasedb.php");
extract($_REQUEST);


class ControladorCategorias
{
	

public function index(){
	$db=new clasedb();//instanciando clasedb
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT * FROM categorias";//query

	$res=mysqli_query($conex,$sql);//ejecutando query
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
	mysqli_close($conex);
		//enviando datos
	    header("Location: ../Vistas/categorias/index.php?filas=".$filas."&campos=".$campos."&data=".serialize($datos));
}//fin de la funcion index
public function registrar(){

	header("Location: ../Vistas/categorias/registrar.php");
}//fin registrar

public function guardar(){
	extract($_POST);//EXTRAYENDO VARIABLES DEL FORMULARIO
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos

	$sql="SELECT * FROM categorias WHERE categoria='".$nombre."'";
	$res=mysqli_query($conex,$sql);
	$cuantos=mysqli_num_rows($res);
	if ($cuantos>0) {
		?>
		<script type="text/javascript">
			alert("LA CATEGORIA YA EXISTE");
			window.location="ControladorCategorias.php?operacion=registrar";
		</script>
			<?php
	} else {
		$sql="INSERT INTO categorias(categoria) VALUES('".$nombre."')";

		$result=mysqli_query($conex,$sql);
		if ($result) {
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO EXITOSO, DESEA REGISTRAR OTRO?")) {
				window.location="ControladorCategorias.php?operacion=registrar";	
			}else{
				window.location="ControladorCategorias.php?operacion=index";
			}
			
		</script>
			<?php

		} else {
			?>
		<script type="text/javascript">
			
			if (confirm("REGISTRO FALLIDO, DESEA VOLVER A INTENTARLO?")) {
				window.location="ControladorCategorias.php?operacion=registrar";	
			}else{
				window.location="ControladorCategorias.php?operacion=index";
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

	$sql="SELECT * FROM categorias WHERE id=".$id_categoria."";
	$res=mysqli_query($conex,$sql);//ejecutando consulta
	$data=mysqli_fetch_array($res);//extrayendo datos en array

	header("Location: ../Vistas/categorias/modificar.php?data=".serialize($data));
}
public function actualizar()
{
	extract($_POST);//EXTRAYENDO VARIABLES DEL FORMULARIO
	$db=new clasedb();
	$conex=$db->conectar();//conectando con la base de datos
	
	$sql="SELECT * FROM categorias WHERE categoria='".$nombre."' AND id<>".$id_categoria;
//echo $sql;
$res=mysqli_query($conex,$sql);

$cant=mysqli_num_rows($res);//trae cuantos registros tiene la consulta
		if ($cant>0) {
			?>
				<script type="text/javascript">
					alert("CATEGORIA YA REGISTRADA");
					window.location="ControladorCategorias.php?operacion=index";
				</script>
			<?php
		}else{
		$sql="UPDATE categorias SET categoria='".$nombre."' WHERE id=".$id_categoria;

		$res=mysqli_query($conex,$sql);
			if ($res) {
				?>
					<script type="text/javascript">
						alert("REGISTRO MODIFICADO");
						window.location="ControladorCategorias.php?operacion=index";
					</script>
				<?php
			} else {
				?>
					<script type="text/javascript">
						alert("ERROR AL MODIFICAR EL REGISTRO");
						window.location="ControladorCategorias.php?operacion=index";
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

	$sql="DELETE FROM categorias WHERE id=".$id_categoria;

		$res=mysqli_query($conex,$sql);
		if ($res) {
			?>
				<script type="text/javascript">
					alert("REGISTRO ELIMINADO");
					window.location="ControladorCategorias.php?operacion=index";
				</script>
			<?php
		} else {
			?>
				<script type="text/javascript">
					alert("REGISTRO NO ELIMINADO");
					window.location="ControladorCategorias.php?operacion=index";
				</script>
			<?php
		}
}//fin de la función eliminar
static function controlador($operacion){
		$categoria=new ControladorCategorias();
	switch ($operacion) {
		case 'index':

			$categoria->index();
			break;
		case 'registrar':
			$categoria->registrar();
			break;
		case 'guardar':
			$categoria->guardar();
			break;
		case 'modificar':
			$categoria->modificar();
			break;
		case 'actualizar':
			$categoria->actualizar();
			break;
		case 'eliminar':
			$categoria->eliminar();
			break;
		default:
			?>
				<script type="text/javascript">
					alert("No existe la ruta");
					window.location="ControladorCategorias.php?operacion=index";
				</script>
			<?php
			break;
	}//cierre del switch
}//cierre de la funcion controlador
}//cierre de la clase


ControladorCategorias::controlador($operacion);


?>