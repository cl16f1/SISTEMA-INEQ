<?php
	session_start();
	include "../../conexion.php";

	$ruc 		= '';
	$nombre 	= '';
	$telefono 	= '';
	$celular 	= '';
	$correo  	= '';
	$direccion  = '';
	$alert 		= '';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "../includes/scripts.php"; ?>
	<title>Registro Cliente</title>
</head>
<?php 
if(!empty($_POST))
{
	$ruc 		= strClean($_POST['ruc']);
	$nombre 	= ucwords(strClean($_POST['nombre']));
	$telefono 	= intval($_POST['telefono']);
	$celular 	= intval($_POST['celular']);
	$correo  	= strtolower(strClean($_POST['correo']));
	$direccion  = strClean($_POST['direccion']);
	$usuario_id = intval($_SESSION['idUser']);

	if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))
	{
		$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
	}else{
		$result = 0;
		$ruc 	= $_POST['ruc'];
		$query  = mysqli_query($conection,"SELECT * FROM cliente WHERE ruc = '$ruc' OR correo = '$correo' ");
		$result = mysqli_fetch_array($query);

		if($result > 0 && !$correo == ''){
			$alert='<p class="msg_error">El número de RUC ya existe o el email, ingrese otro.</p>';
		}else{
			if(strlen($ruc) != 10 && strlen($ruc) != 14){
				$alert='<p class="msg_error">10 para Cedula o 14 para RUC</p>';
			}else{
				$query_insert = mysqli_query($conection,"INSERT INTO cliente(ruc,nombre,telefono,celular,correo,direccion,usuario_id)
													VALUES('$ruc','$nombre','$telefono','$celular','$correo','$direccion','$usuario_id')");

				if($query_insert){
					$alert='<p class="msg_save">Cliente guardado correctamente.</p>';
					$ruc 		= '';
					$nombre 	= '';
					$telefono 	= '';
					$celular 	= '';
					$correo  	= '';
					$direccion  = '';
					$usuario_id = '';
				}else{
					$alert='<p class="msg_error">Error al guardar el cliente.</p>';
				}
			}
		}
	}
}
 ?>
<body>
	<?php include "../includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1><i class="fas fa-user-plus"></i> Registro cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<div>
					<p>Los campos con (*) son obligatorios.</p>
				</div>
				<label for="ruc"><th><?= strtoupper(IDENTIFICACION_TRIBUTARIA); ?></th> o Cédula (*)</label>
				<input type="text" name="ruc" id="ruc" placeholder="Identificación tributaria" value="<?= $ruc;  ?>" required>
				<label for="nombre">Nombre (*)</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?= $nombre;  ?>" required>
				<label for="telefono">Teléfono (*)</label>
				<input type="text" name="telefono" id="telefono" placeholder="Teléfono" value="<?= $telefono;  ?>" required>
				<label for="celular">Celular</label>
				<input type="text" name="celular" id="celular" placeholder="Celular" value="<?= $celular;  ?>">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?= $correo;  ?>">
				<label for="direccion">Dirección (*)</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección completa" value="<?= $direccion;  ?>" required>
				<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i> Guardar Cliente</button>
			</form>
		</div>

	</section>
	<?php include "../includes/footer.php"; ?>
</body>
</html>