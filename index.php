<?php
session_start();

spl_autoload_register(function($class){
    require_once $class . '.php';
});

$uri = $_GET['uri'];

$request = explode('/', $uri);
$controller = array_shift($request);
$action = array_shift($request);
$parameters = $request;

$controllerName = '\\Controllers\\' . ucfirst($controller) . 'Controller';



$dbConfigClass = new \Configs\DbConfig();

Db::setInstance(
    $dbConfigClass::USER,
    $dbConfigClass::PASS,
    $dbConfigClass::DBNAME,
    $dbConfigClass::HOST
);

$view = new View($controller, $action);
$requestObject = new \Request($request);
try {
    $controllerInstance = new $controllerName(
        $view,
        $requestObject,
        $controller
    );
} catch (\Exception $e) {
    echo "No such controller";
    die;
}

if (!$action) {
    $action = "index";
}
if (!method_exists($controllerInstance, $action)) {
    die("no such action");
}
$controllerInstance->$action();

$view->render();

