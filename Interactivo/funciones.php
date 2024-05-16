<?php
include "help.php";
$db_host = "localhost";
$db_user = "heketo";
$db_password = "cuervo2005";
$db_name = "TaskManager";

function iniciar_sesion(){
try{
  $conexion = mysqli_connect($db_host, $db_user, $db_password, $db_name);
} catch(exception){
  echo "Error al conectar a la base de datos: " . mysqli_connect_error();
  exit;
}
}
function crearTarea($titulo, $descripcion, $prioridad) {
  global $conexion;

  $sql = "INSERT INTO tareas (titulo, descripcion, prioridad) VALUES (?, ?, ?)";

  $stmt = mysqli_prepare($conexion, $sql);

  mysqli_stmt_bind_param($stmt, "ssi", $titulo, $descripcion, $prioridad);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
}
function obtenerTareas() {
  global $conexion;

  $sql = "SELECT * FROM tareas ORDER BY fecha_creacion DESC";

  $resultado = mysqli_query($conexion, $sql);

  $tareas = [];

  while ($fila = mysqli_fetch_assoc($resultado)) {
    $tareas[] = $fila;
  }

  mysqli_free_result($resultado);

  return $tareas;
}
function actualizarTarea($id, $titulo, $descripcion, $prioridad, $estado) {
  global $conexion;

  $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, prioridad = ?, estado = ? WHERE id = ?";

  $stmt = mysqli_prepare($conexion, $sql);

  mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $descripcion, $prioridad, $estado, $id);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
}
function eliminarTarea($id) {
  global $conexion;

  $sql = "DELETE FROM tareas WHERE id = ?";

  $stmt = mysqli_prepare($conexion, $sql);

  mysqli_stmt_bind_param($stmt, "i", $id);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
}
?>

