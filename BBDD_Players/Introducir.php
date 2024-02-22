<?php
require 'funciones.php';
?>

<html>
    <head>
        <title>Introducir.php</title>
    </head>
    <body>
        <h1> Introducción de Jugadores  </h1>

        <?php
        if (isset($_POST["insert"])) {
           
            $selectedPositions = isset($_POST["posiciones"]) ? $_POST["posiciones"] : array();
            $posiciones = array_sum($selectedPositions);
            $goles = intval($_POST["goles"]);
            
            if (!validarTexto($_POST["nombre"])) {
                $errores["nombre"] = "Nombre del jugador no valido, debe ser inferior a 50 caracteres.";
            }
            if (!validarDNI($_POST["dni"])) {
                $errores["dni"] = "DNI no valido, 8 dígitos y 1 Letra.";
            }
            if (empty($_POST["posiciones"])) {
                $errores["posiciones"] = "Debes seleccionar al menos una posición.";
            }
            if (!validarTexto($_POST["equipo"])) {
                $errores["equipo"] = "Nombre del equipo no valido, debe ser inferior a 50 caracteres.";
            }
            if (!validarGoles($goles)) {
                $errores["goles"] = "Número de goles no valido, entre 0 y 9999.";
            }
        }
        ?>

        <form action="" method="POST"> 

            Nombre: <input type="text" name="nombre" value="<?php if (isset($_POST["insert"]) && !isset($errores["nombre"])) echo $_POST["nombre"]; ?>"   /> 
            <?php if (isset($errores["nombre"])) echo '<span style="color: red">' . $errores["nombre"] . '</span>'; ?>
            <br>
            DNI: <input type="text" name="dni" value="<?php if (isset($_POST["insert"]) && !isset($errores["dni"])) echo $_POST["dni"]; ?>"  />
            <?php if (isset($errores["dni"])) echo '<span style="color: red">' . $errores["dni"] . '</span>'; ?>
            <br>
            Dorsal:
            <select id="dorsal" name="dorsal">
                <?php
                for ($i = 1; $i <= 25; $i++) {
                    $selected = ($dorsal == $i) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
            <br>

            Posicion:
            <select multiple="" name="posiciones[]">
                <option value="1" <?php if (isset($_POST['insert']) && in_array('1', (array) $selectedPositions)) echo 'selected'; ?>  >Portero</option>
                <option value="2" <?php if (isset($_POST['insert']) && in_array('2', (array) $selectedPositions)) echo 'selected'; ?>  >Defensa</option>
                <option value="4" <?php if (isset($_POST['insert']) && in_array('4', (array) $selectedPositions)) echo 'selected'; ?>  >Centrocampista</option>
                <option value="8" <?php if (isset($_POST['insert']) && in_array('8', (array) $selectedPositions)) echo 'selected'; ?>  >Delantero</option>

            </select>
            <br>
            <?php if (isset($errores["posiciones"])) echo '<span style="color: red">' . $errores["posiciones"] . '</span>'; ?>
            <br>

            Equipo: <input type="text" name="equipo" value=" <?php if (isset($_POST["insert"]) && !isset($errores["equipo"])) echo $_POST["equipo"]; ?>" /> 
            <?php if (isset($errores["equipo"])) echo '<span style="color: red">' . $errores["equipo"] . '</span>'; ?>
            <br>
            Número de goles: <input type="text" name="goles" value=" <?php if (isset($_POST["insert"]) && !isset($errores["goles"])) echo $_POST["goles"]; ?>" />
            <?php if (isset($errores["goles"])) echo '<span style="color: red">' . $errores["goles"] . '</span>'; ?><br>
            <br>
            <input type="submit" name="insert" value="Insertar jugador en la base de datos">
        </form> 
        <br>
        <a href="index.php">  Volver al menú  </a>

        <?php
        if (isset($_POST["insert"]) && empty($errores)) {

            try {
                // conexion
                $conex = new mysqli('localhost', 'dwes', 'abc123.', 'fplayers');
                $conex->set_charset('utf8mb4');

                // Definir la consulta SQL con marcadores de posición
                $query = "INSERT INTO player (Nombre, DNI, Dorsal, Posicion, Equipo, N_Goles) VALUES (?, ?, ?, ?, ?, ?)";
                // Preparar la sentencia
                $stmt = $conex->prepare($query);

                if ($stmt) {

                    $stmt->bind_param('ssissi', $_POST["nombre"], $_POST["dni"], $_POST["dorsal"], $posiciones, $_POST["equipo"], $_POST["goles"]);

                    // Ejecutar la sentencia preparada
                    if ($stmt->execute()) {
                        echo "Registro del jugador realizado correctamente";
                    } else {
                        echo "Error al insertar en la base de datos: " . $conex->error;
                    }
                    // Cerrar la sentencia preparada
                    $stmt->close();
                } else {
                    
                    echo "Error en la preparación de la sentencia: " . $conex->error;
                }
                $conex->close();
            } catch (Exception $ex) {
                die($ex->getMessage());
            }
        }
        ?>


    </body>
</html>
