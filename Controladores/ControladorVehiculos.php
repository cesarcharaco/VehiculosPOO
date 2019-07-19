<?php

include('../Modelos/clasedb.php');
extract($_REQUEST);

/**
 * 
 */
class ControladorVehiculos
{

public function index()
{
	$db=new clasedb();
	$conex=$db->conectar();

	$sql="SELECT vehiculos.id,vehiculos.marca,vehiculos.modelo,vehiculos.placa,categorias.categoria,tipos.tipo FROM vehiculos,categorias,tipos WHERE vehiculos.id_categoria=categorias.id AND vehiculos.id_tipo=tipos.id";
	
	if ($res=mysqli_query($conex,$sql)) {
		
		$campos=mysqli_num_fields($res);
		$filas=mysqli_num_rows($res);
		
		$datos[]=array();
		$i=0;
		while ($data=mysqli_fetch_array($res)) {
			for ($j=0; $j < $campos; $j++) { 
				$datos[$i][$j]=$data[$j];
			}
			$i++;
		}

		header("Location: ../Vistas/vehiculos/index.php?campos=".$campos."&filas=".$filas."&data=".serialize($datos));

	} else {
		//en caso de no pasar la consulta
		header("Location: ../index.php");
	}
	
}//fin de index
public function registrar()
{
	$db=new clasedb();
	$conex=$db->conectar();
	$cont=0; //para contar si no se ejecutaron consultas
	//consulta de categorias
		$sql="SELECT * FROM categorias";
		if ($res=mysqli_query($conex,$sql)) {
			# se ejecutó la consulta
			$campos_cat=mysqli_num_fields($res);
			$filas_cat=mysqli_num_rows($res);
			$categorias[]=array();
			$i=0;
			while ($data=mysqli_fetch_array($res)) {
				for ($j=0; $j < $campos_cat; $j++) { 
					$categorias[$i][$j]=$data[$j];
				}
				$i++;
			}
		} else {
			# no se ejecutó la consulta
			$cont++;
		}
		
	//-------
	// consulta de tipos
		$sql2="SELECT * FROM tipos";
		if ($res2=mysqli_query($conex,$sql2)) {
			# se ejecutó la consulta
			$campos_tip=mysqli_num_fields($res2);
			$filas_tip=mysqli_num_rows($res2);
			$tipos[]=array();
			$i=0;
			while ($data2=mysqli_fetch_array($res2)) {
				for ($j=0; $j < $campos_tip; $j++) { 
					$tipos[$i][$j]=$data2[$j];
				}
				$i++;
			}

		} else {
			# no se ejecutó la consulta
			$cont++;
		}
		
	//-------
		if ($cont==0) {
			# se ejecutó
			header("Location: ../Vistas/vehiculos/registrar.php?campos_cat=".$campos_cat."&filas_cat=".$filas_cat."&categorias=".serialize($categorias)."&campos_tip=".$campos_tip."&filas_tip=".$filas_tip."&tipos=".serialize($tipos));
		} else {
			# hubo un error
			header("Location: ../index.php");
		}
		
}//fin registrar

public function guardar()
{
	extract($_POST);

	$db=new clasedb();
	$conex=$db->conectar();
	$cont=0;
	//verificado q la placa no este registrando
		$sql="SELECT * FROM  vehiculos WHERE placa='".$placa."'";
		//echo $sql;
		if ($res=mysqli_query($conex,$sql)) {
			# se ejecutó la consulta
			$registros=mysqli_num_rows($res);
			
			if ($registros>0) {
				?>
				<script type="text/javascript">
					alert("LA PLACA YA ESTA REGISTRADA");
					window.location="ControladorVehiculos.php?operacion=index";
				</script>
			<?php
			} else {
				# no está registrada la placa
				$sql="INSERT INTO vehiculos VALUES(NULL,".$id_categoria.",".$id_tipo.",'".$marca."','".$modelo."','".$placa."')";
				//echo $sql;
				if ($res2=mysqli_query($conex,$sql)) {
					?>
				<script type="text/javascript">
					if (confirm("REGISTRO EXITOSO, DESEA REGISTRAR OTRO?")) {
						window.location="ControladorVehiculos.php?operacion=registrar";	
					}else{
						window.location="ControladorVehiculos.php?operacion=index";
					}
				</script>
			<?php	
				} else {
					?>
				<script type="text/javascript">
					alert("REGISTRO FALLIDO");
					window.location="ControladorVehiculos.php?operacion=index";
				</script>
			<?php
				}
				
			}
			
		} else {
			$cont++;
			//echo "no consultó";
		}
		
	//-----
		
}
public function modificar()
{
	extract($_REQUEST);
	$db=new clasedb();
	$conex=$db->conectar();

	//--- buscando registro de vehículo
	$sql="SELECT * FROM vehiculos WHERE id=".$id_vehiculo;

	$res=mysqli_query($conex,$sql);
	$data_v=mysqli_fetch_array($res);
	//echo $sql;

	$cont=0; //para contar si no se ejecutaron consultas
	//consulta de categorias
		$sql="SELECT * FROM categorias";
		if ($res=mysqli_query($conex,$sql)) {
			# se ejecutó la consulta
			$campos_cat=mysqli_num_fields($res);
			$filas_cat=mysqli_num_rows($res);
			$categorias[]=array();
			$i=0;
			while ($data=mysqli_fetch_array($res)) {
				for ($j=0; $j < $campos_cat; $j++) { 
					$categorias[$i][$j]=$data[$j];
				}
				$i++;
			}
		} else {
			# no se ejecutó la consulta
			$cont++;
		}
		
	//-------

	// consulta de tipos
		$sql2="SELECT * FROM tipos";
		if ($res2=mysqli_query($conex,$sql2)) {
			# se ejecutó la consulta
			$campos_tip=mysqli_num_fields($res2);
			$filas_tip=mysqli_num_rows($res2);
			$tipos[]=array();
			$i=0;
			while ($data2=mysqli_fetch_array($res2)) {
				for ($j=0; $j < $campos_tip; $j++) { 
					$tipos[$i][$j]=$data2[$j];
				}
				$i++;
			}

		} else {
			# no se ejecutó la consulta
			$cont++;
		}
		//echo $data_v[0];
		if ($cont==0) {
			header("Location: ../Vistas/vehiculos/modificar.php?data_v=".serialize($data_v)."&filas_cat=".$filas_cat."&categorias=".serialize($categorias)."&filas_tip=".$filas_tip."&tipos=".serialize($tipos));
		} else {
			header("Location: ControladorVehiculos.php?operacion=index");
		}
		

}

public function actualizar()
{
	extract($_POST);

	$db=new clasedb();
	$conex=$db->conectar();

	$sql="SELECT * FROM vehiculos WHERE placa='".$placa."' AND id<>".$id_vehiculo;
	echo $sql;
	if ($resul=mysqli_query($conex,$sql)) {
		if (mysqli_num_rows($resul)>0) {
					?>
					<script type="text/javascript">
						alert('Placa ya registrada, try again');
					window.location="ControladorVehiculos.php?operacion=index";
					</script>

					<?php
				} else {
					# en caso de que no este registrada la placa
					$sql="UPDATE vehiculos SET id_categoria=".$id_categoria.",id_tipo=".$id_tipo.",marca='".$marca."',modelo='".$modelo."',placa='".$placa."' WHERE id=".$id_vehiculo;
				//echo $sql;
					$registro=mysqli_query($conex,$sql);
					if ($registro) {
						?>
						<script type="text/javascript">
							alert('Actualiación exitosa');
							window.location="ControladorVehiculos.php?operacion=index";
						</script>
						<?php
					} else {
						?>
						<script type="text/javascript">
							alert('Actualiación fallida');
							window.location="ControladorVehiculos.php?operacion=index";
						</script>
						<?php
					}
							

				}
						
	} else {
		
	}
	
}//fin de la funcion
static function controlador($operacion){
	$vehiculo=new ControladorVehiculos();

	switch ($operacion) {
		case 'index':
			$vehiculo->index();
			break;
		case 'registrar':
			$vehiculo->registrar();
			break;
		case 'guardar':
			$vehiculo->guardar();
			break;
		case 'modificar':
			$vehiculo->modificar();
			break;
		case 'actualizar':
			$vehiculo->actualizar();
			break;
		default:
			?>
				<script type="text/javascript">
					alert("No existe la ruta");
					window.location="ControladorVehiculos.php?operacion=index";
				</script>
			<?php
			break;
	}
}	
}
ControladorVehiculos::controlador($operacion);
?>