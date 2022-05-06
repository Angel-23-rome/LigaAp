<?php

if (isset($_POST['guardar'])){
    include_once '../Models/Conexion.php';
    $Curp=$_POST['curp'];
    $NomJugador=$_POST['nombre'];
    $ApeJugador=$_POST['apellidos'];
    $pesoJugador=$_POST['peso'];
    $AlturaJugador=$_POST['altura'];
    $equipoJugador=$_POST['equipo'];
    $RutaImagen= "img/".$equipoJugador."/".$Curp;
    $TipoJugador=$_POST['tipo'];
    $PosicionJugador=$_POST['posicion'];
    $Comunidad=$_POST['comuni'];
   
    $sql = "INSERT INTO jugadores (Nombre_J, Apellido_J,Peso_J,Altura_J,Ruta_J,Equipo_J,Curp_J,Tipo_J,Posicion_J,Comunidad_J) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$NomJugador,$ApeJugador,$pesoJugador,$AlturaJugador,$RutaImagen,$equipoJugador,$Curp,$TipoJugador,$PosicionJugador,$Comunidad]);
    if ($stmt) {
       
    } else {
        echo "error";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <title>Liga Apipilulco</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Liga</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Jugadores
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="Jugador.php">Registro Jugador</a></li>
                  <li><a class="dropdown-item" href="ListJugador.php">Lista Jugadores</a></li>
                </ul>
              </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Equipos.php">Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./">Sorteo</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card text-center">
            <div class="card-header">
                <h3>Registro de Jugador</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">

               
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">CURP</label>
                            <input type="text" class="form-control" placeholder="" name="curp" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Nombre Jugador</label>
                            <input type="text" class="form-control" placeholder="" name="nombre" required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                    <div class="form-group">
                            <label for="">Peso</label>
                            <input type="text" class="form-control" name="peso" required>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                            <label for="">Estatura</label>
                            <input type="text" class="form-control" name="altura" required>
                        </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                            <label for="">Equipo</label>
                            <select name="" id="equipos" class="form-control" required>
                                <option value="">Equipos</option>
                                <?php
                                include_once '../Models/Conexion.php';
                                $sql = "SELECT * FROM equipos";
                                $result = $pdo->query($sql);
                                
                            while ($filas= $result->fetch()) {
                                ?>
                                    <option value="<?php echo $filas[0] ?>"><?php echo $filas[1] ?></option>
                            <?php
                            }?>
                            </select>
                           
                            <input type="hidden" class="form-control" name="equipo" id="equipo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Tipo de Jugador</label>
                            <select name="" id="tipos" class="form-control" required>
                                <option value="">Jugador</option>
                                <option value="1">Local</option>
                                <option value="2">Extranjero</option>
                            </select>
                            <input type="hidden" name="tipo" id="tipo">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Posición</label>
                            <input type="text" class="form-control" name="posicion" id="posicion">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="">Comunidad</label>
                        <input type="text" class="form-control" name="comuni">
                    </div>
                </div>
                <br>
                <button type="submit" name="guardar" class="btn btn-primary">GUARDAR</button>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
        
    </div>

</body>

</html>
<script type="text/javascript" language="javascript" class="init">
    	$(function(){
  	$(document).on('change','#equipos',function(){ //detectamos el evento change
    	var value = $(this).val();//sacamos el valor del select
      $('#equipo').val(value);//le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
    });
  });

  $(function(){
  	$(document).on('change','#tipos',function(){ //detectamos el evento change
    	var value = $(this).val();//sacamos el valor del select
      $('#tipo').val(value);//le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
    });
  });

$(document).ready(function() {
    $('#equipos').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
</script>