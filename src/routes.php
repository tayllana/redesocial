<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@login');

$router->get('/cadastro', 'LoginController@signup');
$router->post('/cadastro', 'LoginController@cadastro');