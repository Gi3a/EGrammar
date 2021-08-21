<?php

namespace application\core;

use application\core\View;

class Router {

    protected $routes = []; // protected доступность только внутри данног класса
    protected $params = [];
    
    public function __construct() {
        $arr = require 'application/config/routes.php'; // подклюение всех массивов routes
        foreach ($arr as $key => $val) { // перебор значений -> ключ, и возвращение в $this->add
            $this->add($key, $val);
        }
    }

    public function add($route, $params) {
        $route = preg_replace('/{([a-zа-яё]+):([^\}]+)}/u', '(?P<\1>\2)', $route);
        $route = '#^'.$route.'$#u'; // делаем из routes -> регулярное выражение
        $this->routes[$route] = $params; // записываем в протектед массив routes[$route] - ключ, $params - значение
    }

    public function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/'); // убираем все /
        foreach ($this->routes as $route => $params) { // разбиваем protected routes, который ранее был записан в add
            if (preg_match($route, $url, $matches)) { // совпадение между routes и текущем url, в matches записываем результат сравнения
                foreach ($matches as $key => $match) { 
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(){
        if ($this->match()) { // вызов функции match для поиска совпадений между routes и текущем url
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller'; // подключение папки controller'ов
            if (class_exists($path)) { // существует ли такой класс, контроллер
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

}