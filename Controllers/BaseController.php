<?php
namespace Controllers;

use View;
use Request;

class BaseController
{
    protected $view;
    protected $request;
    protected $controllerName;
    protected $parameters;

    public function __construct(
        View $view,
        Request $request,
        $name,
        $parameters
    )
    {
        $this->view = $view;
        $this->request = $request;
        $this->controllerName = $name;
        $this->parameters = $parameters;
        $this->onLoad();
    }

    protected function onLoad() {}

    public function redirect(
        $controller = null,
        $action = null,
        $params = []
    ) {
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);
        $url = "//" . $_SERVER['HTTP_HOST'] . "/";
        foreach ($requestUri as $k => $uri) {
            if ($uri == $this->controllerName) {
                break;
            }
            $url .= "$uri";
        }
        if ($controller) {
            $url .= "/$controller";
        }
        if ($action) {
            $url .= "/$action";
        }
        foreach ($params as $key => $param) {
            $url .= "/$param";
        }
        header("Location: " . $url);
        exit;
    }

    public function checkToken(){
        $actualToken = $_SESSION['token'];
        $uri = 'localhost/' . $_SERVER['REQUEST_URI'];

        $c = curl_init($uri);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);
        $pattern = '/value="(.*)"/';
        preg_match($pattern, $html, $matches);
        $tokenValue = intval($matches[1]);
        if($tokenValue != $actualToken){
            echo 'Invalid Token!';
            die;
        }
    }
}