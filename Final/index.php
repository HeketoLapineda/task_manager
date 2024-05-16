<?php
include "funciones.php";

$patataBucle = true;

function limpiarTerminal() {
    if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
        system('clear');
    } else {
        system('cls');
    }
}

function mostrarMenu() {
    echo "**Gestor de Tareas**\n";
    echo "--------------------\n";
    echo "1. Crear tarea\n";
    echo "2. Ver tareas\n";
    echo "3. Actualizar tarea\n";
    echo "4. Eliminar tarea\n";
    echo "5. Salir\n";
}

function obtenerOpcion() {
    return readline("Introduzca una opción: ");
}

function procesarOpcion($opcion) {
    switch ($opcion) {
        case 1:
            $guardarEn = readline("¿Dónde quieres guardar la tarea? (JSON / SQL): ");
            if ($guardarEn === "JSON") {
                $titulo = readline("Introduzca el título de la tarea: ");
                $descripcion = readline("Introduzca la descripción de la tarea: ");
                $prioridad = readline("Introduzca la prioridad de la tarea (0-5): ");

                crearTareaJSON($titulo, $descripcion, $prioridad);

                echo "Tarea creada correctamente.\n";
                sleep(3);
                limpiarTerminal();
            } elseif ($guardarEn === "SQL") {
                $titulo = readline("Introduzca el título de la tarea: ");
                $descripcion = readline("Introduzca la descripción de la tarea: ");
                $prioridad = readline("Introduzca la prioridad de la tarea (0-5): ");

                crearTareaSQL($titulo, $descripcion, $prioridad);

                echo "Tarea creada correctamente.\n";
                sleep(3);
                limpiarTerminal();
            } else {
                echo "Opción no válida.\n";
            }
            break;

        case 2:
            $guardarEn = readline("¿Dónde quieres obtener las tareas? (JSON / SQL): ");
            if ($guardarEn === "JSON") {
                $tareas = obtenerTareasJSON();
            } elseif ($guardarEn === "SQL") {
                $tareas = obtenerTareasSQL();
            } else {
                echo "Opción no válida.\n";
                break;
            }

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
            $guardarEn = readline("¿Dónde quieres actualizar la tarea? (JSON / SQL): ");
            if ($guardarEn === "JSON") {
                $id = readline("Introduzca el ID de la tarea a actualizar: ");
                $titulo = readline("Introduzca el nuevo título de la tarea: ");
                $descripcion = readline("Introduzca la nueva descripción de la tarea: ");
                $prioridad = readline("Introduzca la nueva prioridad de la tarea (0-5): ");
                $estado = readline("Introduzca el nuevo estado de la tarea (pendiente/completada): ");

                actualizarTareaJSON($id, $titulo, $descripcion, $prioridad, $estado);

                echo "Tarea actualizada correctamente.\n";
                sleep(3);
                limpiarTerminal();
            } elseif ($guardarEn === "SQL") {
                $id = readline("Introduzca el ID de la tarea a actualizar: ");
                $titulo = readline("Introduzca el nuevo título de la tarea: ");
                $descripcion = readline("Introduzca la nueva descripción de la tarea: ");
                $prioridad = readline("Introduzca la nueva prioridad de la tarea (0-5): ");
                $estado = readline("Introduzca el nuevo estado de la tarea (pendiente/completada): ");

                actualizarTareaSQL($id, $titulo, $descripcion, $prioridad, $estado);

                echo "Tarea actualizada correctamente.\n";
                sleep(3);
                limpiarTerminal();
            } else {
                echo "Opción no válida.\n";
            }
            break;

        case 4:
            $guardarEn = readline("¿Dónde quieres eliminar la tarea? (JSON / SQL): ");
            if ($guardarEn === "JSON") {
                $id = readline("Introduzca el ID de la tarea a eliminar: ");
                eliminarTareaJSON($id);
            } elseif ($guardarEn === "SQL") {
                $id = readline("Introduzca el ID de la tarea a eliminar: ");
                eliminarTareaSQL($id);
            } else {
                echo "Opción no válida.\n";
                break;
            }

            echo "Tarea eliminada correctamente.\n";
            sleep(3);
            limpiarTerminal();
            break;

        case 5:
            exit;
            break;

        default:
            echo "Opción no válida.\n";
            break;
    }
}

while ($patataBucle) {
    mostrarMenu();
    $opcion = obtenerOpcion();
    procesarOpcion($opcion);
}
?>

