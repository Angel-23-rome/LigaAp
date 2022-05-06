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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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

                <table id="partidos" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Equipo 1</th>
                            <th>Equipo 2</th>
                            <th>Jornada</th>
                            <th>Torneo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once '../Models/Conexion.php';
                            $idTorneo="";
                            if(isset($_POST['listar'])){
                                $idTorneo = $_POST['idtorneo'];
                            }
                            $sql = "SELECT par.idPartido,par.Equipo_1,par.Equipo_2,par.Jornada_P,par.Torneo_P,par.Fecha_P,par.Hora_P,
                            par.Goles_E1,par.Goles_E2, par.Arbitro_P, eq1.idEquipo,eq1.Nombre_E, eq2.idEquipo,eq2.Nombre_E, tor.idTorneo,
                            tor.Nombre_T 
                            FROM partidos par 
                            INNER JOIN equipos eq1 ON eq1.idEquipo = par.Equipo_1
                             INNER JOIN equipos eq2 ON eq2.idEquipo = par.Equipo_2 
                             INNER JOIN torneos tor ON tor.idTorneo = par.Torneo_P
                            WHERE tor.idTorneo = $idTorneo";
                            $result = $pdo->query($sql);
                          
                            while ($filas= $result->fetch()) {
                                ?>
                        <tr>
                            <td><?php echo $filas[0]?></td>
                            <td><?php echo $filas[11]?></td>
                            <td><?php echo $filas[13]?></td>
                            <td><?php echo $filas[3]?></td>
                            <td><?php echo $filas[15]?></td>
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
    $('#partidos').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
});
</script>