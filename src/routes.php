<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login','LoginController@signin');
$router->post('/login','LoginController@signinAction');
$router->get('/cadastro','LoginController@signup');
$router->post('/cadastro','LoginController@signupAction');
$router->get('/sair','LoginController@logout');
$router->get('/sobre','HomeController@sobre');
$router->get('/perfil/{id}','PerfilController@index');
$router->get('/perfil','PerfilController@index');
$router->get('/jogo/{id}', 'JogoController@jogo');
$router->get('/jogos', 'JogoController@index');
$router->post('/jogoAdd', 'JogoController@jogoadd');
$router->get('/jogoeditar/{id}', 'JogoController@jogoeditar');
$router->get('/paineldecontrole', 'PainelDeControleController@index');
$router->post('/ajax/dadosjogo','AjaxController@dadosjogo');//rota adicionada para a requisição ajax