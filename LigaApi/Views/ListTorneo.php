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
    <form action="" method="post">
        <div class="row">
           
            <div class="col-5">
                <label for="">Buscar por Equipo</label>
                <select name="" id="equipos" class="form-select form-control" required>
                                <option value="0">Equipos</option>
                                <?php
                                include_once '../Models/Conexion.php';
                                $sql = "SELECT * FROM torneos";
                                $result = $pdo->query($sql);
                                
                            while ($filas= $result->fetch()) {
                                ?>
                                    <option value="<?php echo $filas[0] ?>"><?php echo $filas[1] ?></option>
                            <?php
                            }?>
                            </select>
                           
                            <input type="hidden" class="form-control" name="numero" id="equipo">
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary" name="filtro">BUSCAR</button>
                </form>
                <button  class="btn btn-primary" name="limpiar">LIMPIAR</button>
            </div>
            
        </div>
        
        <div class="card">
            <div class="card-header text-center">
                <h3>Jugadores</h3>
            </div>
            <div class="card-body">
          
            <div class="row">
            
                <?php
                $WHERE="";
                if(isset($_POST['filtro'])){
                    $equipoFiltro=$_POST['numero'];
                    $WHERE= "WHERE eq.idTorneo=".$equipoFiltro;
                }else{
                    $WHERE="";
                }
                if (isset($_POST['limpiar'])) {
                    $WHERE="";
                }
                            include_once '../Models/Conexion.php';
                            $sql = "SELECT * FROM torneos ".$WHERE;
                            $result = $pdo->query($sql);
                          
                            while ($filas= $result->fetch()) {
                                
                                ?>
                                    <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>Torneo: <?php echo $filas[1]?></h6>
                                    </div>
                                    <div class="card-body">
                                    <h5 class="text-center">Información</h5>
                                        <div class="row">
                                            <div class="col-4">
                                            <img src="../img/jugador.png" class="rounded" alt="..." width="100px" height="100px">
                                            </div>
                                            <div class="col-8">
                                            
                                            <h6><b>Fecha Inicio: </b><?php echo $filas[2]?></h6>
                                            <h6><b>Fecha Final: </b><?php echo $filas[3]?></h6>
                                            </div>
                                          
                                        </div>
                                    
                                   
                                    </div>
                                    <div class="card-footer">
                                        <form action="ListPartidos.php" method="post">
                                            <input type="hidden" name="idtorneo" value="<?php echo $filas[0] ?>">
                                            <button class="btn btn-info" name="listar" type="submit">Ver Partidos</button>
                                        </form>
                                        
                                      
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