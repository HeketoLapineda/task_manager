<?php
include "funciones.php";
include "help.php";
if (PHP_SAPI !== 'cli') {

  exit;
}
try {
  iniciar_sesion();
} catch (\Throwable $th) {
  echo("hay un error con el inicio de sesion");
}
$options = getopt("a:c:d:p:e:i:u:l:h");

if (!$options) {
    echo "Uso: php index.php -a <accion> -c <titulo> -d <descripcion> -p <prioridad> -e <estado> -i <id> -u <titulo> -l <prioridad> -h\n";
    exit(1);
}

if (isset($options['h'])) {
    mostrar_ayuda();
    exit(0);
}

try {
    iniciar_sesion();
} catch (Exception $e) {
    echo "Error al iniciar sesión: " . $e->getMessage() . "\n";
    exit(1);
}

if (isset($options['a'])) {
    $accion = $options['a'];
    switch ($accion) {
        case 'crear':
            if (!isset($options['c']) || !isset($options['d']) || !isset($options['p'])) {
                echo "Para crear una tarea, se requieren los parámetros -c (titulo), -d (descripcion) y -p (prioridad).\n";
                exit(1);
            }
            crearTarea($options['c'], $options['d'], $options['p']);
            echo "Tarea creada correctamente.\n";
            break;
        case 'ver':
            $tareas = obtenerTareas();
            foreach ($tareas as $tarea) {
                echo "ID: " . $tarea["id"] . "\n";
                echo "Titulo: " . $tarea["titulo"] . "\n";
                echo "Descripcion: " . $tarea["descripcion"] . "\n";
                echo "Prioridad: " . $tarea["prioridad"] . "\n";
                echo "Estado: " . $tarea["estado"] . "\n";
                echo "\n";
            }
            break;
        case 'actualizar':
            if (!isset($options['i']) || !isset($options['u']) || !isset($options['l']) || !isset($options['e'])) {
                echo "Para actualizar una tarea, se requieren los parámetros -i (id), -u (nuevo titulo), -l (nueva prioridad) y -e (nuevo estado).\n";
                exit(1);
            }
            actualizarTarea($options['i'], $options['u'], $options['d'], $options['l'], $options['e']);
            echo "Tarea actualizada correctamente.\n";
            break;
        case 'eliminar':
            if (!isset($options['i'])) {
                echo "Para eliminar una tarea, se requiere el parámetro -i (id).\n";
                exit(1);
            }
            eliminarTarea($options['i']);
            echo "Tarea eliminada correctamente.\n";
            break;
        default:
            echo "Acción no válida. Use -h para ver la ayuda.\n";
            exit(1);
    }
} else {
    echo "Se requiere la acción. Use -h para ver la ayuda.\n";
    exit(1);
}

