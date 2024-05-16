<?php

function mostrarAyuda() {
    echo "Gestor de Tareas\n";
    echo "Uso: php index.php [opciones]\n\n";
    echo "Opciones:\n";
    echo "  -a <accion>       Especifica la acción a realizar (crear, ver, actualizar, eliminar)\n";
    echo "  -c <titulo>       Título de la tarea (para crear)\n";
    echo "  -d <descripcion>  Descripción de la tarea (para crear o actualizar)\n";
    echo "  -p <prioridad>    Prioridad de la tarea (para crear)\n";
    echo "  -e <estado>       Estado de la tarea (para actualizar)\n";
    echo "  -i <id>           ID de la tarea (para actualizar o eliminar)\n";
    echo "  -u <titulo>       Nuevo título de la tarea (para actualizar)\n";
    echo "  -l <prioridad>    Nueva prioridad de la tarea (para actualizar)\n";
    echo "  -h                Muestra esta ayuda\n";
}

?>

