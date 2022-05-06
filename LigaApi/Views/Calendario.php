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
                    <li class="nav-item">
                <a class="nav-link" href="Partidos.php">Partidos</a>
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
        <style>
            
#cale{
    background-image: url('../img/calepar.jpg');
  border: none;
  transition: all 500ms cubic-bezier(0.19, 1, 0.22, 1);
 overflow:hidden;
 border-radius:20px;
 min-height:270px;
   box-shadow: 0 0 12px 0 rgba(0,0,0,0.2);

 @media (max-width: 768px) {
  min-height:350px;
}

@media (max-width: 420px) {
  min-height:300px;
}
}

        </style>
        <div  class="card">
            <div class="card-header text-center">
                <h3>CALENDARIO</h3>
            </div>
            <div class="card-body">
          
            <div class="row">
            
                <?php
            
                
                            include_once '../Models/Conexion.php';
                            $sql = "SELECT par.idPartido,par.Jornada_P,par.Fecha_P,par.Hora_P,par.Arbitro_P, 
                            eq1.Nombre_E, eq2.Nombre_E, tor.Nombre_T, 
                            par.Vuelta_P
                            FROM partidos par 
                            INNER JOIN equipos eq1 ON eq1.idEquipo = par.Equipo_1 
                            INNER JOIN equipos eq2 ON eq2.idEquipo = par.Equipo_2 
                            INNER JOIN torneos tor ON tor.idTorneo = par.Torneo_P 
                            WHERE tor.idTorneo=(SELECT MAX(idTorneo) FROM torneos)";
                            $result = $pdo->query($sql);
                          
                            while ($filas= $result->fetch()) {
                                if($filas[8]==1){
                                    $PartidoDisputar = $filas[5]." VS ".$filas[6];
                                    $Vuelta="Ida";
                                }else if ($filas[8]==2) {
                                    $PartidoDisputar = $filas[6]." VS ".$filas[5];
                                    $Vuelta="Vuelta";
                                }
                                ?>
                                    <div class="col-4">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <h6>Jornada: <?php echo $filas[1]."  - ".$Vuelta?></h6>
                                    </div>
                                    <div id="cale" class="card-body" >
                                        <br>
                                        <h5 style="color: white;"><?php echo $filas[7]?></h5>
                                        <h5 style="color: white;"><?php echo $PartidoDisputar?></h5>   
                                        <h5 style="color: white;">Fecha: <?php echo $filas[2] ?></h5>
                                        <h6 style="color: white;">Hora: <?php echo $filas[3] ?></h6>
                                        <h6 style="color: white;">Arbitro: <?php echo $filas[4] ?></h6>
                                   
                                    </div>
                                    <div class="card-footer">
                                      calendario 
                                    </div>
                                </div>
                                </div>
                        <?php
                           
                            }
                        ?>
               
            </div>   
                       

                  
            </div>
            <div class="card-footer text-muted">
                jugadores
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
$(document).ready(function() {
    $('#equipos').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
</script>
