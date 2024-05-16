<?php
$db_host = "localhost";
$db_user = "heketo";
$db_password = "cuervo2005";
$db_name = "TaskManager";

define("ARCHIVO_JSON", "tareas.json");

function iniciar_sesion(){
    global $db_host, $db_user, $db_password, $db_name;
    try {
        $conexion = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        if (!$conexion) {
            throw new Exception("Error al conectar a la base de datos: " . mysqli_connect_error());
        }
        return $conexion;
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}



function crearTareaSQL($titulo, $descripcion, $prioridad) {
    $conexion = iniciar_sesion();
    $sql = "INSERT INTO tareas (titulo, descripcion, prioridad) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $titulo, $descripcion, $prioridad);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);


}

function obtenerTareasSQL() {
    $conexion = iniciar_sesion();
    $sql = "SELECT * FROM tareas ORDER BY fecha_creacion DESC";
    $resultado = mysqli_query($conexion, $sql);
    $tareas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    return $tareas;
}

function actualizarTareaSQL($id, $titulo, $descripcion, $prioridad, $estado) {
    $conexion = iniciar_sesion();
    $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, prioridad = ?, estado = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $descripcion, $prioridad, $estado, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}


function eliminarTareaSQL($id) {
    $conexion = iniciar_sesion();
    $sql = "DELETE FROM tareas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);


}
function crearTareaJSON($titulo, $descripcion, $prioridad) {
    $tareas = obtenerTareasJSON();
    $id = uniqid();
    $nuevaTarea = [
        "id" => $id,
        "titulo" => $titulo,
        "descripcion" => $descripcion,
        "prioridad" => $prioridad,
        "estado" => "pendiente"
    ];

    $tareas[] = $nuevaTarea;

    file_put_contents("tareas.json", json_encode($tareas, JSON_PRETTY_PRINT));
}

function obtenerTareasJSON() {
    if (file_exists("tareas.json")) {
        $json = file_get_contents("tareas.json");
        $tareas = json_decode($json, true);
    } else {
        $tareas = [];
    }
    return $tareas;
}

function actualizarTareaJSON($id, $titulo, $descripcion, $prioridad, $estado) {
    $tareas = obtenerTareasJSON();

    foreach ($tareas as &$tarea) {
        if ($tarea["id"] === $id) {
            $tarea["titulo"] = $titulo;
            $tarea["descripcion"] = $descripcion;
            $tarea["prioridad"] = $prioridad;
            $tarea["estado"] = $estado;
            break;
        }
    }

    file_put_contents("tareas.json", json_encode($tareas, JSON_PRETTY_PRINT));
}

function eliminarTareaJSON($id) {
    $tareas = obtenerTareasJSON();

    foreach ($tareas as $index => $tarea) {
        if ($tarea["id"] === $id) {
            unset($tareas[$index]);
            break;
        }
    }

    file_put_contents("tareas.json", json_encode($tareas, JSON_PRETTY_PRINT));
}
?>

