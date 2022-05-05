<?php

if (isset($_POST['guardar'])){
    include_once '../Models/Conexion.php';
    $Equipo = $_POST['nombre'];
    $representante = $_POST['repre'];
    $lugar = $_POST['lugar'];
    $Estado = 1;
    $sql = "INSERT INTO equipos (Nombre_E, Presidente_E,Lugar_Or,Estado_Eq) VALUES (?,?,?,?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$Equipo,$representante,$lugar,$Estado]);
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
        
        <div class="card">
            <div class="card-header text-center">
                <h3>Equipos</h3>
            </div>
            <div class="card-body text-center">
                <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Registrar Equipo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Registro de Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nombre del Equipo</label>
                                        <input type="text" class="form-control" placeholder="" name="nombre" id="nombre">
                                    </div>
                                </div>
                                <div class="col-4"> <div class="form-group">
                                        <label for="">Nombre del Representante</label>
                                        <input type="text" class="form-control" placeholder="" name="repre" id="repre">
                                    </div></div>
                                <div class="col-4">
                                <div class="form-group">
                                        <label for="">Localidad del equipo</label>
                                        <input type="text" class="form-control" placeholder="" name="lugar" id="lugar">
                                    </div>
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-primary" name="guardar">GUARDAR</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                       
                    </div>
                </div>
            </div>
        </div>
                <table id="equipos" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Equipo</th>
                            <th>Represetante</th>
                            <th>Lugar</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../Models/Conexion.php';
                            $sql = "SELECT * FROM equipos";
                            $result = $pdo->query($sql);
                          
                            while ($filas= $result->fetch()) {
                                ?>
                        <tr>
                            <td><?php echo $filas[0]?></td>
                            <td><?php echo $filas[1]?></td>
                            <td><?php echo $filas[2]?></td>
                            <td><?php echo $filas[3]?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php
                           
                            }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Num</th>
                            <th>Equipo</th>
                            <th>Represetante</th>
                            <th>Lugar</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer text-muted">
                equipos
            </div>
        </div>
    </div>

</body>

</html>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
    $('#equipos').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
</script>