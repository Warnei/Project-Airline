<?php 
require_once("config/clientes.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js" ></script>    
    <script src="js/jquery.js"></script>
    <style>
        .container{
            width: 80%;
            height: 80%;
            padding: 20px;
        }
        .header{
            height: 150px;
            padding: 20px;
            text-align: center; 
        }
        #codigo{
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        body{
		height: 800px;
		background-image: url("img/background1.jpg");
		background-size: cover;
		background-size: 100%;
		background-repeat: no-repeat;
		background-position: center center;
		background-attachment: fixed;
	    }
    </style>
</head>
<body>

    <header>
		<div class="logo">
			<img src="img/logo.png" alt="Logo de Aerolínea del Norte">
		</div>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="crearReservas.php">Reservar vuelo</a></li>
				<li><a href="interfaz.php">Check-in en línea</a></li>
				<li><a href="viewVuelos.php">Información de vuelos</a></li>
				<li><a href="viewReservas.php">Ver Reserva</a></li>
			</ul>
		</nav>
	</header>
    
    <main>
    <div class="container">
        <div class="header bg-info">
            <h1>Aerolínea del Norte</h1>
            <h3>Clientes</h3>
        </div>

        <table class="table table-bordered">
            <tr>
                <th colspan="2" style="text-align: right">
                    <a href="interfaz.php" class="btn btn-success btn-sm">Atras</a>
                    <a href="crearCliente.php" class="btn btn-success btn-sm">Crear Cliente</a>
                    <a href="viewVuelos.php" class="btn btn-primary btn-sm">Ver Vuelos</a>
                    <a href="viewReservas.php" class="btn btn-primary btn-sm">Ver Reserva</a>
                </th>
            </tr>
            
        </table>
        <table class="table table-bordered">
            <tr class="bg-warning">
                <th>Tipo y Numero Id</th>
                <th>Nombres y Apellidos</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Genero</th>
                <th>Fecha Nacimiento</th>
            </tr>
            <tbody class="table-striped">
            <?php 
            $obj = new Cliente();
            $resp = $obj->getClientes();
            for ($i=0; $i < count($resp); $i++) {                            
            ?>       
            <tr>
                <td><?php echo $resp[$i]['Tipo_doc_cliente'].' '.$resp[$i]['Id_cliente'];?></td>
                <td><?php echo $resp[$i]['Nombre_cliente'].' '.$resp[$i]['Apellido_cliente'];?></td>
                <td><?php echo $resp[$i]['Email_cliente'];?></td>
                <td><?php echo $resp[$i]['Telefono_cliente'];?></td>
                <td><?php echo $resp[$i]['Genero_cliente'];?></td>
                <td><?php echo $resp[$i]['Fecha_Nac_cliente'];?></td>
            </tr>
            <?php 
            }
            ?>
            </tbody>
        </table>        
    </div>

    </main>

    <footer>
		<p>Aerolínea del Norte S.A.S &copy; 2023</p>
	</footer>

    
</body>
</html>