<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@singin');
$router->get('/cadastro', 'LoginController@singup');