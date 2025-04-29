<?php

// Compatibilidad para str_ends_with en PHP < 8
if (!function_exists('str_ends_with')) {
    function str_ends_with($haystack, $needle) {
        return substr($haystack, -strlen($needle)) === $needle;
    }
}

// Rutas de todos los controladores usados
include_once 'Controllers/IndexController.php';
include_once 'Controllers/CategoriasController.php';
include_once 'Controllers/ProductosController.php';
include_once 'Controllers/UsuariosController.php';
include_once 'Controllers/AuthController.php';
include_once 'Controllers/PublicController.php';
include_once 'Controllers/ClientesController.php';
include_once 'Controllers/VentasController.php';
include_once 'Controllers/CarritoController.php';

const PATH = '/TextilExport';

$url = $_SERVER['REQUEST_URI'];
$slices = explode('/', $url);

$controller = empty($slices[2]) ? "IndexController" : $slices[2] . "Controller";
$methodRaw = empty($slices[3]) ? "index" : $slices[3];
$method = explode('?', $methodRaw)[0];  

$params = array_slice($slices, 4);

$cont = new $controller;
call_user_func_array([$cont, $method], $params);
