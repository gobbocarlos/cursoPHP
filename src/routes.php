<?php
use core\Router;

$router = new Router();

$router->get('/', 'HomeController@index');
$router->get('/login','LoginController@signin');
$router->post('/login','LoginController@signinAction');
$router->get('/cadastro','LoginController@signup');
$router->post('/cadastro','LoginController@signupAction');
$router->get('/cadastroAtualizar','LoginController@update');
$router->post('/cadastroAtualizar','LoginController@updateAction');
//$router->post('/cadastroAtualizarAcao','LoginController@updateAction');
$router->get('/sair','LoginController@logout');
$router->get('/sobre','HomeController@sobre');
$router->get('/perfilJogador/{id}','PerfilController@perfilJogador');
$router->get('/perfil','PerfilController@index');
$router->get('/jogo/{id}', 'JogoController@jogo');
$router->get('/jogos', 'JogoController@index');
$router->post('/jogoAdd', 'JogoController@jogoadd');
$router->get('/jogoeditar/{id}', 'JogoController@jogoeditar');
$router->get('/paineldecontrole', 'PainelDeControleController@index');
$router->post('/ajax/dadosjogo','AjaxController@dadosjogo');//rota adicionada para a requisição ajax
$router->post('/ajax/dadosjogadores','AjaxController@dadosjogadores');
$router->get('/calendario','CalendarioController@index');
$router->post('/ajax/calendarioVoltar','AjaxController@calendarioVoltar');
$router->post('/ajax/calendarioAdiantar','AjaxController@calendarioAdiantar');
$router->post('/notasJogador','PerfilController@notasJogador');