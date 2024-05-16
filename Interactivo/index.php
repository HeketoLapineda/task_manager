<?php
include "funciones.php";
$patataBucle=true;
if (PHP_SAPI !== 'cli') {
  
  exit;
}
try {
  iniciar_sesion();
} catch (Exception $e) {
  echo "hay un error con el inicio de sesion: " . $e->getMessage();
  exit;
}
function Clean(){
  if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    system('clear');
  }
  else {
    system('cls');
  }
}
Clean();
while ($patataBucle) {
  echo "**Gestor de Tareas**\n";
  echo "--------------------\n";
  echo "1. Crear tarea\n";
  echo "2. Ver tareas\n";
  echo "3. Actualizar tarea\n";
  echo "4. Eliminar tarea\n";
  echo "5. Salir\n";

  $opcion = readline("Introduzca una opcion: ");

  switch ($opcion) {
    case 1:
      $titulo = readline("Introduzca el titulo de la tarea: ");
      $descripcion = readline("Introduzca la descripcion de la tarea: ");
      $prioridad = readline("Introduzca la prioridad de la tarea (0-5): ");

      crearTarea($titulo, $descripcion, $prioridad);

      echo "Tarea creada correctamente.\n";
      sleep(3);
      Clean();
      break;

    case 2:
      $tareas = obtenerTareas();

      if (empty($tareas)) {
                echo "No hay tareas disponibles.\n";
            } else {
                foreach ($tareas as $tarea) {
                    echo "ID: " . $tarea["id"] . "\n";
                    echo "Titulo: " . $tarea["titulo"] . "\n";
                    echo "Descripcion: " . $tarea["descripcion"] . "\n";
                    echo "Prioridad: " . $tarea["prioridad"] . "\n";
                    echo "Estado: " . $tarea["estado"] . "\n";
                    echo "\n";
                }
            }
            break;

    case 3:

      $id = readline("Introduzca el ID de la tarea a actualizar: ");
      $titulo = readline("Introduzca el nuevo titulo de la tarea: ");
      $descripcion = readline("Introduzca la nueva descripcion de la tarea: ");
      $prioridad = readline("Introduzca la nueva prioridad de la tarea (0-5): ");
      $estado = readline("Introduzca el nuevo estado de la tarea (pendiente/completada): ");  
      actualizarTarea($id, $titulo, $descripcion, $prioridad, $estado);

      echo "Tarea actualizada correctamente.\n";
      sleep(3);
      Clean();
      break;

    case 4:
      $id = readline("Introduzca el ID de la tarea a eliminar: ");

      eliminarTarea($id);

      echo "Tarea eliminada correctamente.\n";
      sleep(3);
      Clean();
      break;

    case 5:
      $patataBucle=False;
      Clean();
      exit;
    default:
      echo "Opcion no valida.\n";


  }

}
