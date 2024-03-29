<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@login');

$router->get('/sair', 'LoginController@logout');

$router->get('/cadastro', 'LoginController@signup');
$router->post('/cadastro', 'LoginController@cadastro');

$router->post('/post/new', 'PostController@new');
$router->get('/post/{id}/delete', 'PostController@delete');

$router->get('/perfil/{id}/fotos', 'PerfilController@photos');
$router->get('/perfil/{id}/amigos', 'PerfilController@friends');
$router->get('/perfil/{id}/follow', 'PerfilController@follow');
$router->get('/perfil/{id}', 'PerfilController@index');
$router->get('/perfil', 'PerfilController@index');

$router->get('/amigos', 'PerfilController@friends');

$router->get('/fotos', 'PerfilController@photos');

$router->get('/pesquisa', 'SearchController@index');

$router->get('/configuracoes', 'ConfigController@index');
$router->post('/configuracoes', 'ConfigController@save');

$router->get('/ajax/like/{id}', 'AjaxController@like');
$router->post('/ajax/comment', 'AjaxController@comment');
$router->post('/ajax/upload', 'AjaxController@upload');
