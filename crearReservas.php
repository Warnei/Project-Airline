<?php 
require_once("config/reserva.php");
if(isset($_POST['form-reserva']) && $_POST['form-reserva'] === 'guardar-reserva'){
$obj = new Reserva();

$resp = $obj->crearReserva();
    if($resp){
        $id = $obj->id_reserva();
        $cant = $obj->cant_reserva();
        header('Location: detalleReserva.php?token='.$id.'&cant='.$cant);
        echo "        
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Reserva</strong> Successfully Added!.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }else{
        echo "        
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>             
            <strong>Error, verifique las instrucciones!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";     
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
        #genero{
            padding: 15px;                   
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
    <script>
        let valorAdultos = 450000;
        let valorNinos   = 350000;
        function calcularReserva(){
            const nAd = document.getElementById('nAdultos').value;
            const nNi = document.getElementById('nNinos').value;
            
            let val_A = valorAdultos*nAd;
            let val_N = valorNinos*nNi;
            let valorFinal = val_A+val_N;
            
            console.log(valorFinal);
            document.getElementById('valor').value = valorFinal;
        }
        function calcularFecha(){
            const fecha = document.getElementById('fecha_vuelo').value;
            const hoy = new Date();
            console.log(fecha);
            if(hoy <= fecha){
                console.log('fecha no valida')
            }else{
                console.log('Ok')
            }
        }
    </script>
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
                <h3>Crear Reserva</h3>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="form-reserva" value="guardar-reserva">
            <table class="table table-bordered">
                <tr>
                    <th><label for="id">Código de Reserva</label></th>
                    <td><input type="number" name="id" id="id" placeholder="Código de Reserva" required class="form-control"></td>
                </tr>
                <tr>
                    <th><label for="fecha_vuelo">Fecha de Reserva, Posteriores a 24hr</label></th>
                    <td>
                        <input type="date" name="fecha" id="fecha_vuelo" required class="form-control" onchange="calcularFecha();">                    
                    </td>
                </tr>  
                <tr>
                    <th><label for="Origen">Ciudad Origen</label></th>
                    <td><input type="text" name="Origen" id="Origen" placeholder="Ciudad Origen" required class="form-control"></td>
                </tr>
                <tr>
                    <th><label for="Destino">Ciudad Destino</label></th>
                    <td><input type="text" name="Destino" id="Destino" placeholder="Ciudad Destino" required class="form-control"></td>
                </tr>     
                <tr>
                    <th><label for="nAdultos">No. Adultos</label></th>
                    <td><input type="number" name="nAdultos" id="nAdultos" placeholder="No. Personas Adultos" required class="form-control"></td>
                </tr>  
                <tr>
                    <th><label for="nNinos">No. Niños</label></th>
                    <td><input type="number" name="nNinos" id="nNinos" placeholder="No. de Niños" required class="form-control" onchange="calcularReserva();"></td>
                </tr>    
                <tr>
                    <th><label for="valor">Valor Total Reserva</label></th>
                    <td>
                        <div class="ajax">
                        <input type="number" name="valor" id="valor" placeholder="Valor" class="form-control" readonly>
                        </div>
                    </td>
                </tr>                                                                    
                <tr>
                    <td colspan="2">
                        <center>
                            <input type="submit" value="Guardar" class="btn btn-success btn-lg">
                            <a href="viewReservas.php" class="btn btn-lg btn-danger">Cancelar</a>
                            <a href="viewReservas.php" class="btn btn-lg btn-danger">Atras</a>
                        </center>
                    </td>
                </tr>
            </table>
            </form>
        </div>

    </main>

    <footer>
		<p>Aerolínea del Norte S.A.S &copy; 2023</p>
	</footer>
    
</body>
</html>