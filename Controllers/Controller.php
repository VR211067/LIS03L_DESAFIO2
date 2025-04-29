<?php

// Clase abstracta base que sirve como controlador padre para todos los controladores del sistema
abstract class Controller {

    // Método que renderiza una vista con datos opcionales pasados en $viewBag
    public function render($view, $viewBag = []) {
        // Construye la ruta del archivo de la vista en base al nombre del controlador actual y el nombre de la vista
        $file = "Views/" . static::class . "/$view";

        // Elimina la palabra "Controller" del nombre del controlador para que coincida con el nombre de la carpeta
        $file = str_replace("Controller", "", $file);

        // Verifica si el archivo de la vista existe
        if (is_file($file)) {
            extract($viewBag);
            // Inicia el almacenamiento en buffer de salida (captura todo lo que se imprime)
            ob_start();
            // Incluye el archivo de la vista
            require($file);
            // Obtiene el contenido almacenado en el buffer
            $content = ob_get_contents();
            // Limpia el buffer y lo cierra
            ob_end_clean();
            // Muestra el contenido de la vista
            echo $content;
        } else {
            // Si el archivo no existe, muestra un mensaje de error
            echo "<h1> View not found</h1>";
        }
    }
}
