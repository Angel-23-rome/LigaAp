

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
    <?php 
error_reporting(E_ERROR |  E_PARSE);
function main() {
?>
        <?php
        
	echo '<table table-bordered width="50%" border="2" align="center" style="text-align:center;">';
    // Cuantos equipos habra
    if (! isset($_GET['teams']) && ! isset($_GET['names'])) {
        //print get_form();
    } else {
        # comprobar cuantos equipos hay
        print show_fixtures(isset($_GET['teams']) ?  nums(intval($_GET['teams'])) : explode("\n", trim($_GET['names'])));
    }
	}
 
	function nums($n) {
    $ns = array();
    for ($i = 1; $i <= $n; $i++) {
        $ns[] = $i;
    }
    return $ns;
	}
 
function show_fixtures($names) {
    $teams = sizeof($names);
 
    print "<h3 align='center'> <b> Calendario de $teams equipos </b> </h3>";
 
    // Si es impar el numero de equipo añadir otro para ser pares
    $ghost = false;
    if ($teams & 2 == 1) {
        $teams++;
        $ghost = true;
    }
 
    // Generar calendario
    $totalRounds = $teams - 1;
    $matchesPerRound = $teams / 2;
    $rounds = array();
    for ($i = 0; $i < $totalRounds; $i++) {
        $rounds[$i] = array();
    }
 
    for ($round = 0; $round < $totalRounds; $round++) {
        for ($match = 0; $match < $matchesPerRound; $match++) {
            $home = ($round + $match) % ($teams - 1);
            $away = ($teams - 1 - $match + $round) % ($teams - 1);
            // El ultimo equipo permanece en su posicion y el resto de equipos rotaran para los enfrentamientos
            if ($match == 0) {
                $away = $teams - 1;
            }
            $rounds[$round][$match] = team_name($home + 1, $names) . " ," . team_name($away + 1, $names);
        }
    }
	
 
    //Intercalando los partidos de casa y fuera
    $interleaved = array();
    for ($i = 0; $i < $totalRounds; $i++) {
        $interleaved[$i] = array();
    }
 
    $evn = 0;
    $odd = ($teams / 2);
    for ($i = 0; $i < sizeof($rounds); $i++) {
        if ($i % 2 == 0) {
            $interleaved[$i] = $rounds[$evn++];
        } else {
            $interleaved[$i] = $rounds[$odd++];
        }
    }
 
    $rounds = $interleaved;
 
    // Si hay equipos impar hacer que se enfrenten
    for ($round = 0; $round < sizeof($rounds); $round++) {
        if ($round % 2 == 1) {
            $rounds[$round][0] = flip($rounds[$round][0]);
        }
    }
 
    // mostrar
	echo "<tr>";
		echo "<td colspan='3'>";
		print "<h2> <b> Primera vuelta </b> </h2>";
		echo "</td>";
	    echo "</tr>";
 
	echo "<tr>";
    include '../Models/Conexion.php';
		for ($i = 0; $i < sizeof($rounds); $i++) {
			echo "<td>";
            $jor=($i+1);
			print "<h3> <b> Jornada " . $jor . "</b> </h3>";
			foreach ($rounds[$i] as $r) {
                $equiposIn= explode(",", $r);
                $sql = "INSERT INTO partidos (Equipo_1,Equipo_2,Jornada_P,Torneo_P) SELECT $equiposIn[0],$equiposIn[1],$jor,MAX(idTorneo) FROM torneos";
                $stmt= $pdo->prepare($sql);
                $stmt->execute();
                
				print $r.$jor . "<br />";
			}
			
			echo "</td>";
	
    }
    echo "</tr>";
	
	echo "<tr>";
		echo "<td colspan='3'>";
		print "<h2> <b> Segunda vuelta </b> </h2>";
		echo "</td>";
	echo "</tr>";
 
	echo "<tr>";
		$round_counter = sizeof($rounds) + 1;
		for ($i = sizeof($rounds) - 1; $i >= 0; $i--) {
			echo "<td>";
			print "<h3> <b> Jornada " . $round_counter . "</b> </h3>\n";
			//$round_counter += 1;
			foreach ($rounds[$i] as $r) {
                $equiposIns= explode(",", $r);
                $sql = "INSERT INTO partidos (Equipo_1,Equipo_2,Jornada_P,Torneo_P) SELECT $equiposIns[0],$equiposIns[1],$round_counter,MAX(idTorneo) FROM torneos";
                $stmt= $pdo->prepare($sql);
                $stmt->execute();
				print $r.$round_counter . "<br />";
			}
            $round_counter += 1;
			print "<br />";
			echo "</td>";
	
    }
    echo "</tr>";
    print "<br />";
 
    if ($ghost) {
        print "Matches against team " . $teams . " are byes.";
    }
}
 
function flip($match) {
    $components = explode(' v ',$match);
 
    return $components[1] .  $components[0];
}
function flipp($match) {
    $components = explode(' v ',$match);
    return $components[0] . "  " . $components[1];
} 

function team_name($num, $names) {
    $i = $num - 1;
    if (sizeof($names) > $i && strlen(trim($names[$i])) > 0) {
        return trim($names[$i]);
    } else {
        return $num;
    }
}
echo '</table>';
?>
<form action= <?php $_SERVER['SCRIPT_NAME'] ?>>
        <label for="names">Nombre de los equipos que participan (un equipo por linea)</label><br>
        <?php
        include_once '../Models/Conexion.php';
        $sql = "SELECT idEquipo,Nombre_E FROM equipos";
        $result = $pdo->query($sql);
		$filas=$result->fetch();
        ?>
        <textarea name="names" rows="8" cols="40" readonly><?php do{echo $filas[0] . "\n";}while ($filas = $result->fetch());?>
        </textarea><br>
        <input type="submit" class="btn btn-info" value="Crear Calendario" />
    </form>
    </div>
</body>

</html>
<?php
main();
 
?>