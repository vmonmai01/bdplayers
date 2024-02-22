<html>
    <head>
        <title>Buscar Jugador</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <h1> Buscar jugador por DNI, Equipo o Posición</h1>
        <form action="" method="POST">

            Buscar por:
            <select id="buscarpor" name="buscarpor">
                <option value='DNI' > DNI </option>
                <option value='Equipo'> Equipo </option>
                <option value='Posicion'> Posicion </option>

            </select><br>

            Valor a buscar: <input type="text" name="valorbuscado" required > 

            <input type="submit" name="buscar" value=" Buscar en la base de datos ">
        </form>
        <?php
        if (isset($_POST["buscar"])) {
            
            $buscarpor = $_POST["buscarpor"];
            $valor = $_POST["valorbuscado"];

            // Realiza la conexión a la base de datos
            try {
                $conex = new mysqli('localhost', 'dwes', 'abc123.', 'fplayers');
                $conex->set_charset('utf8mb4');

                // Consulta SQL con marcadores de posición
                $query = "SELECT * FROM player WHERE $buscarpor = ?";

                if ($buscarpor === "Posicion") {
                    // Si la búsqueda es por "Posicion", usamos FIND_IN_SET
                    $query = "SELECT * FROM player WHERE FIND_IN_SET(?, Posicion) > 0";
                }

                // Preparar la sentencia
                $stmt = $conex->prepare($query);

                if ($stmt) {
                    // Vincular el valor a la sentencia preparada
                    $stmt->bind_param('s', $valor);

                    // Ejecutar la sentencia
                    if ($stmt->execute()) {
                        $result = $stmt->get_result();

                        // Verificar si se encontraron registros
                        if ($result->num_rows > 0) {
                            ?>

                            <h1> Mostrar Datos del/ de los Jugador/es buscado/s </h1>

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
                                while ($row = $result->fetch_object()) {
                                    echo "<tr>";
                                    echo "<td>" . $row->Nombre . "</td>";
                                    echo "<td>" . $row->DNI . "</td>";
                                    echo "<td>" . $row->Dorsal . "</td>";
                                    echo "<td>" . $row->Posicion . "</td>";
                                    echo "<td>" . $row->Equipo . "</td>";
                                    echo "<td>" . $row->N_Goles . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No se encontraron registros.</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "Error en la preparación de la sentencia: " . $conex->error;
                        }

                        // Cerrar la sentencia preparada
                        $stmt->close();
                    } else {
                        echo "Error al ejecutar la sentencia: " . $stmt->error;
                    }

                    // Cerrar la conexión a la base de datos
                    $conex->close();
                } catch (Exception $ex) {
                    die($ex->getMessage());
                }
            }
            ?>
            <br>
            <a href="index.php">Volver al menú</a>  
    </body>
</html>

