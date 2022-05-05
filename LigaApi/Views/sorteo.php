<?php
error_reporting(E_ERROR |  E_PARSE);
	function main() {

?>
<h1 align="center"> Generador de jornadas </h1>
    <?php
	echo '<table width="30%" border="2" align="center" style="text-align:center;">';
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
            $rounds[$round][$match] = team_name($home + 1, $names) . " VS " . team_name($away + 1, $names);
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
		for ($i = 0; $i < sizeof($rounds); $i++) {
			echo "<td>";
			print "<h3> <b> Jornada " . ($i + 1) . "</b> </h3>";
			foreach ($rounds[$i] as $r) {
				print $r . "<br />";
			}
			
			echo "</td>";
	
    }
    echo "</tr>";
	//
	echo "<tr>";
		echo "<td>";
		print $r;
		echo "</td>";
	echo "</tr>";
	//
	echo "<tr>";
		echo "<td>";
		print "<h2> <b> Segunda vuelta </b> </h2>";
		echo "</td>";
	echo "</tr>";
 
	echo "<tr>";
		$round_counter = sizeof($rounds) + 1;
		for ($i = sizeof($rounds) - 1; $i >= 0; $i--) {
			echo "<td>";
			print "<h3> <b> Jornada " . $round_counter . "</b> </h3>\n";
			$round_counter += 1;
			foreach ($rounds[$i] as $r) {
				print flipp($r) . "<br />";
			}
			print "<br />";
			echo "</td>";
	echo "</tr>";
    }
    print "<br />";
 
    if ($ghost) {
        print "Matches against team " . $teams . " are byes.";
    }
}
 
function flip($match) {
    $components = explode(' v ',$match);
    return $components[1] . "  " . $components[0];
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
<html>
<body>
<form action= <?php $_SERVER['SCRIPT_NAME'] ?>>
        <label for="names">Nombre de los equipos que participan (un equipo por linea)</label>
        <?php
        include_once '../Models/Conexion.php';
        $sql = "SELECT Nombre_E FROM equipos";
        $result = $pdo->query($sql);
		$filas=$result->fetch();
        ?>
        <textarea name="names" rows="8" cols="40" readonly><?php do{echo $filas[0] . "\n";}while ($filas = $result->fetch());?>
        </textarea>
        <input type="submit" value="Crear Calendario" />
    </form>
</body>
</html>
<?php
main();
 
?>