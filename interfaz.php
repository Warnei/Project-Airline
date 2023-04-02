<?php 
require_once("config/checkIn.php");
if(isset($_POST['form-check']) && $_POST['form-check'] === 'guardar-check'){
$ch = new CheckIn();
$cantCliente = count($_POST["id_cliente"]);
$resp = $ch->crearCheckIn($cantCliente);
    if($resp){
        echo "        
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Check-In</strong> Successfully Added!.
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
<html lang="en">
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

<script>
    function buscarReserva(){
        let idReserv = $("#codigo").val().trim(); 
        if(idReserv.length <= 0 || idReserv == "" || idReserv == 0){
            console.log("Error, campo Input Vacio");
            $("#codigo").addClass("bg-warning");
        }else{
            $("#codigo").removeClass("bg-warning");
            var parametros = {"idReserv" : idReserv};        
            $.ajax({
                    data:  parametros,
                    url:   'ajaxReserva.php',
                    type:  'POST',

                    beforeSend: function () {
                        $("#query").html("<div class='spinner-border text-success' align='center'></div>");
                    },

                    success:  function (response) {
                        $("#query").html(response);                
                    }
            }); 
        }              
    }

    function buscarUsuario(){
        let idUsuario = $("#idUsuario").val().trim(); 
        if(idUsuario.length <= 0 || idUsuario == "" || idUsuario == 0){
            console.log("Error, campo Input Vacio");
            $("#idUsuario").addClass("bg-warning");
        }else{
            $("#idUsuario").removeClass("bg-warning");
            var parametros = {idUsuario};                

            $.ajax({
                    data:  parametros,
                    url:   'ajaxCliente.php',
                    type:  'POST',

                    beforeSend: function () {
                        $("#query").html("<div class='spinner-border text-success' align='center'></div>");
                    },

                    success:  function (response) {
                        $("#query").html(response);                
                    }
            }); 
        }         
    }

    function ActivarCasilla(casilla){
        miscasillas=document.getElementsByTagName('input'); 
        for(i=0;i<miscasillas.length;i++) 
        {
            if(miscasillas[i].type == "checkbox") 
            {
                miscasillas[i].checked=casilla.checked; 
            }
        }
    }    


    $(document).ready(function(){
        $('.tr-cliente').hide(); 
        $('.tr-reserva').hide(); 
        let r = 'activo';
        $('#btnReserva').click(function(){
            $('.tr-reserva').show();
            $('.tr-cliente').hide();       
        });  
        $('#btnCliente').click(function(){                        
            $('.tr-cliente').show();  
            $('.tr-reserva').hide();            
        });          
    });

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
                <h3>Check-In</h3>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th colspan="2" style="text-align: right">
                        <a href="viewClientes.php" class="btn btn-primary btn-sm">Ver Cliente</a>
                        <a href="viewVuelos.php" class="btn btn-primary btn-sm">Ver Vuelos</a>
                        <a href="viewReservas.php" class="btn btn-primary btn-sm">Ver Reserva</a>
                    </th>
                </tr>
                <tr>
                    <th><a href="#" id="btnReserva">Buscar Reserva</a></th>
                </tr>
                <div>
                <tr class="tr-reserva">
                    <th>
                        <input type="text" name="codigo" id="codigo" placeholder="Código de Reserva" required class="form-control">
                    </th>
                </tr>
                <tr class="tr-reserva">
                    <td>
                        <input type="button" value="Buscar" id="btn-buscar" class="btn btn-success btn-lg" onclick="buscarReserva();">
                    </td>
                </tr>
                </div>
                <tr>
                    <th><a href="#" id="btnCliente">Buscar Check Cliente</a></th>
                </tr>
                <div>
                <tr class="tr-cliente">
                    <th>
                        <input type="text" name="idUsuario" id="idUsuario" placeholder="Identificación de Usuario" required class="form-control">
                    </th>
                </tr>
                <tr class="tr-cliente">
                    <td>
                        <input type="button" value="Buscar" id="btn-buscar-usuario" class="btn btn-success btn-lg" onclick="buscarUsuario();">
                    </td>
                </tr>  
                </div>          
            </table>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="form-check" value="guardar-check">         
                <div id="query"></div>            
            </form>

        </div>

	</main>

        
    <footer>
		<p>Aerolínea del Norte S.A.S &copy; 2023</p>
	</footer>
</body>
</html>