<?php
	session_start();
	require_once("clase.php");
	$usar_db = new DBControl();
	if (!empty($_GET["accion"])) {
		switch ($_GET["accion"]) {
			case "agregar":
				if (!empty($_POST["txtcantidad"])) {
					$codproducto = $usar_db->vaiQuery("SELECT * FROM poject_18_productos WHERE cod='" . $_GET["cod"] . "'");
					$items_array = array(
						$codproducto[0]["cod"] => array(
							'vai_nom'    => $codproducto[0]["nom"],
							'vai_cod'    => $codproducto[0]["cod"],
							'txtcantidad' => $_POST["txtcantidad"],
							'vai_pre'    => $codproducto[0]["pre"],
							'vai_img'    => $codproducto[0]["img"]
						)
					);
					if (!empty($_SESSION["items_carrito"])) {
						if (in_array($codproducto[0]["cod"], array_keys($_SESSION["items_carrito"]))) {
							foreach ($_SESSION["items_carrito"] as $i => $j) {
								if ($codproducto[0]["cod"] == $i) {
									if (empty($_SESSION["items_carrito"][$i]["txtcantidad"])) {
										$_SESSION["items_carrito"][$i]["txtcantidad"] = 0;
									}
									$_SESSION["items_carrito"][$i]["txtcantidad"] += $_POST["txtcantidad"];
								}
							}
						} else {
							$_SESSION["items_carrito"] = array_merge($_SESSION["items_carrito"], $items_array);
						}
					} else {
						$_SESSION["items_carrito"] = $items_array;
					}
				}
				break;
			case "eliminar":
				if (!empty($_SESSION["items_carrito"])) {
					foreach ($_SESSION["items_carrito"] as $i => $j) {
						if ($_GET["eliminarcode"] == $i) {
							unset($_SESSION["items_carrito"][$i]);
						}
						if (empty($_SESSION["items_carrito"])) {
							unset($_SESSION["items_carrito"]);
						}
					}
				}
				break;
			case "vacio":
				unset($_SESSION["items_carrito"]);
				break;
			case "pagar":
				echo "<script> alert('Gracias por su compra');window.location= 'index.php' </script>";
				unset($_SESSION["items_carrito"]);
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Gestor de Carrito de Compras</title>
		<link href="../../assets/img/logo.png" rel="icon">
        <link href="../../assets/img/logo-grande.png" rel="apple-touch-icon">
		<link href="style.css" rel="stylesheet" />
	</head>
	<body>
		<div>
			<h1>Carrito de Compras</h1>
			<div>
				<h2>Lista de productos a comprar</h2>
			</div>
			<?php if (isset($_SESSION["items_carrito"])): ?>
				<table>
					<tr>
						<th style="width:30%">Descripción</th>
						<th style="width:10%">Código</th>
						<th style="width:10%">Cantidad</th>
						<th style="width:10%">Precio x unidad</th>
						<th style="width:10%">Precio</th>
						<th style="width:10%"><a href="index.php?accion=vacio">Limpiar</a></th>
					</tr>
					<?php
						$totcantidad = 0;
						$totprecio = 0;
						foreach ($_SESSION["items_carrito"] as $item) {
							$item_price = $item["txtcantidad"] * $item["vai_pre"];
					?>
					<tr>
						<td><img src="<?php echo $item["vai_img"]; ?>" class="imagen_peque" /><br><?php echo $item["vai_nom"]; ?></td>
						<td><?php echo $item["vai_cod"]; ?></td>
						<td><?php echo $item["txtcantidad"]; ?></td>
						<td><?php echo "$ " . $item["vai_pre"]; ?></td>
						<td><?php echo "$ " . number_format($item_price, 2); ?></td>
						<td><a href="index.php?accion=eliminar&eliminarcode=<?php echo $item["vai_cod"]; ?>">Eliminar</a></td>
					</tr>
					<?php
						$totcantidad += $item["txtcantidad"];
						$totprecio += $item_price;
					}
					?>
					<tr style="background-color:#f3f3f3">
						<td colspan="2"><b>Total de productos:</b></td>
						<td><b><?php echo $totcantidad; ?></b></td>
						<td colspan="2"><strong><?php echo "$ " . number_format($totprecio, 2); ?></strong></td>
						<td><a href="index.php?accion=pagar">Pagar</a></td>
					</tr>
				</table>
			<?php else: ?>
				<div align="center"><h3>¡El carrito está vacío!</h3></div>
			<?php endif; ?>
		</div>
		<div>
			<h2>Productos</h2>
			<div class="contenedor_general">
				<?php
					$productos_array = $usar_db->vaiquery("SELECT * FROM poject_18_productos ORDER BY id ASC");
					if (!empty($productos_array)) {
						foreach ($productos_array as $i => $k) {
				?>
					<div class="contenedor_productos">
						<form method="POST" action="index.php?accion=agregar&cod=<?php echo $productos_array[$i]["cod"]; ?>">
							<div><img src="<?php echo $productos_array[$i]["img"]; ?>"></div>
							<div style="padding-top:10px;font-size:18px;font-weight:bold;"><?php echo $productos_array[$i]["nom"]; ?></div>
							<div style="padding-top:10px;font-size:20px;"><?php echo "$" . $productos_array[$i]["pre"]; ?></div>
							<div>
								<input type="text" name="txtcantidad" value="1" size="2" />
								<input type="submit" value="Agregar" />
							</div>
						</form>
					</div>
				<?php
						}
					}
				?>
			</div>
		</div>
	</body>
</html>