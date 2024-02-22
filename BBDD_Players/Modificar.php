<html>
    <head>
        <title>Modificar Datos del Jugador</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

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

                if ($result->num_rows > 0) {
                    $row = $result->fetch_object();

                    $posiciones1 = explode(',', $row->Posicion);
                    ?>
                    <form action="" method="POST">

                        Nombre: <input type="text" name="nombre" value="<?php echo $row->Nombre ?>"> <br>
                        DNI: <input type="text" name="dni" value="<?php echo $_POST["dni"] ?>">  <br>
                        Dorsal:
                        <select id="dorsal" name="dorsal">
                            <?php
                            for ($i = 1; $i <= 25; $i++) {
                                $selected = ($i == $row->Dorsal) ? 'selected' : '';
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>

                        </select>
                        <br>
                        Posicion:
                        <select multiple="" name="posiciones[]">
                            <option value="1" <?php if (in_array("Portero", $posiciones1)) echo 'selected'; ?>>Portero</option>
                            <option value="2" <?php if (in_array("Defensa", $posiciones1)) echo 'selected'; ?>>Defensa</option>
                            <option value="4" <?php if (in_array("Centrocampista", $posiciones1)) echo 'selected'; ?>>Centrocampista</option>
                            <option value="8" <?php if (in_array("Delantero", $posiciones1)) echo 'selected'; ?>>Delantero</option>
                        </select>
                        <br>

                        Equipo: <input type="text" name="equipo" value="<?php echo $row->Equipo ?>"> <br>
                        Número de goles: <input type="text" name="goles" value="<?php echo $row->N_Goles ?>"> <br>

                        <input type="submit" name="modificar" value="Modificar en la base de datos" />

                    </form>
                    <?php
                } else {
                    echo "No se han encontrado resultados";
                }
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
            $conex->close();
        } else {
            ?>

            <h1>Modificar Datos del Jugador</h1>
            <form action="" method="POST">
                DNI: <input type="text" name="dni" required >

                <input type="submit" name="buscar" value="Buscar en la base de datos">
            </form>

            <br>
            <a href="index.php">Volver a la página de inicio</a>

            <?php
        }
        ?>
        <?php
        if (isset($_POST["modificar"])) {
            $posi = array_sum($_POST["posiciones"]);

            try {
                $conex = new mysqli('localhost', 'dwes', 'abc123.', 'fplayers');
                $conex->set_charset('utf8mb4');

                $query = "UPDATE player SET Nombre = ?, Dorsal = ?, Posicion = ?, Equipo = ?, N_Goles = ? WHERE DNI = ?";
                $stmt = $conex->prepare($query);
                $stmt->bind_param('siisis', $_POST['nombre'], $_POST['dorsal'], $posi, $_POST['equipo'], $_POST['goles'], $_POST['dni']);

                if ($stmt->execute()) {
                    echo "Modificación del jugador realizada correctamente";
                } else {
                    echo "Error al modificar el jugador en la base de datos: " . $conex->error;
                }
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
            $conex->close();
        }
        ?>

    </body>
</html>
