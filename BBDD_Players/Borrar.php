<html>
    <head>
        <title>Borrar jugador de la BBDD</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

        <form action="" method="POST">
            DNI del jugador: <input type="text" name="dni" required> 
            <input type="submit" name="buscar" value="Buscar en la base de datos">        
        </form>

        <?php
        if (isset($_POST["buscar"])) {
            try {
                $conex = new mysqli('localhost', 'dwes', 'abc123.', 'fplayers');
                $conex->set_charset('utf8mb4');

                $query = "SELECT * FROM player WHERE DNI = ?";
                $stmt = $conex->prepare($query);
                $stmt->bind_param('s', $_POST['dni']);
                $stmt->execute();
                $result = $stmt->get_result();
            } catch (Exception $ex) {
                die($ex->getMessage());
            }

            // Verificar si se encontraron registros
            if ($result->num_rows > 0) {
                ?>

                <h1>Mostrar Datos del Jugador buscado</h1> 

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
                ?>
                <br>
                <form action="" method="POST"> 
                    <input type="hidden" name="dni" value="<?php echo $_POST['dni'] ?>">
                    <input type="submit" name="borrar" value="Borrar de la base de Datos"> 
                </form>

                <?php
                // Cerrar la conexión a la base de datos
                $conex->close();
            }
            ?>


            <?php
            if (isset($_POST["borrar"])) {
                try {
                    $conex = new mysqli('localhost', 'dwes', 'abc123.', 'fplayers');
                    $conex->set_charset('utf8mb4');

                    $query = "DELETE FROM player WHERE DNI = ?";
                    $stmt = $conex->prepare($query);
                    $stmt->bind_param('s', $_POST['dni']);
                    if ($stmt->execute()) {
                        echo "Borrado del jugador realizado correctamente.";
                    } else {
                        echo "Error al borrar el jugador en la base de datos: " . $conex->error;
                    }
                } catch (Exception $ex) {
                    die($ex->getMessage());
                }
                // Cerrar la conexión a la base de datos
                $conex->close();
            }
            ?>
            <br>
            <a href="index.php">Volver al menú</a>
    </body>
</html>
