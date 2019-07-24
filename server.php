<?php
require_once 'config.php';
require_once 'Model.php';
require_once 'api/MainApi.php';
require_once 'api/Books.php';
require_once 'api/Author.php';


$url = parse_url($_SERVER['REQUEST_URI']);
$path = explode('/', $url['path']);

$need_class = ucfirst(array_pop($path));
$need_method = mb_strtolower($_SERVER['REQUEST_METHOD']);

if (class_exists($need_class)) {
    $inst = new $need_class;
    if (method_exists($inst, $need_method)) {
        try {
            $result = $inst->$need_method($_GET);
        } catch (Exception $e) {
            $result = json_encode(Array('error' => $e->getMessage()));
        }
    } else {
        header('HTTP/1.1 404 Not Found');
        header("Content-Type: application/json");
        $result = json_encode(['error' => 'Не существует метод api']);
    }
} else {
    header('HTTP/1.1 404 Not Found');
    header("Content-Type: application/json");
    $result = json_encode(['error' => 'Не существует api']);
}

echo $result;




