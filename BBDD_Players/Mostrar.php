
<html>
    <head>
        <title>Mostrar Datos de los Jugadores </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>Mostrar Datos de los Jugadores</h1>

        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Dorsal</th>
                <th>Posición</th>
                <th>Equipo</th>
                <th>Número de Goles</th>
            </tr>

            <?php
            // Realiza la conexión a la base de datos
            try {
                $conex = new mysqli('localhost', 'dwes', 'abc123.', 'fplayers');
                $conex->set_charset('utf8mb4');
                $query = "SELECT * FROM player ORDER BY Equipo";
                $stmt = $conex->prepare($query);

                if ($stmt) {
                    // Ejecutar la sentencia
                    if ($stmt->execute()) {
                        // Vincular resultados a variables
                        $stmt->bind_result($nombre, $dni, $dorsal, $posicion, $equipo, $goles);

                        // Mostrar los resultados
                        while ($stmt->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $nombre . "</td>";
                            echo "<td>" . $dni . "</td>";
                            echo "<td>" . $dorsal . "</td>";
                            echo "<td>" . $posicion . "</td>";
                            echo "<td>" . $equipo . "</td>";
                            echo "<td>" . $goles . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Error al ejecutar la sentencia: " . $stmt->error;
                    }

                    // Cerrar la sentencia preparada
                    $stmt->close();
                } else {
                    echo "Error en la preparación de la sentencia: " . $conex->error;
                }

                // Cerrar la conexión a la base de datos
                $conex->close();
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
            ?>
        </table>

        <br>
        <a href="index.php">Volver al menú</a>
    </body>
</html>



