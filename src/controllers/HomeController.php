<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;
use \src\models\User;
class HomeController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            //$this->redirect('/login');
        }
        
    }
    public function index() {
        if($this->loggedUser===false){
            $provisorio= new User();
            $provisorio->email = 'teste@teste.com.br';
            $provisorio->avatar = 'Mascote.jpg';
            $this->render('home',['loggedUser'=>$provisorio]);
        }
        else{
            $this->render('home',['loggedUser'=>$this->loggedUser]);
        }
        // $this->render('home',['loggedUser'=> $this->loggedUser]);
    }
    public function sobre() {
        if($this->loggedUser===false){
            $provisorio= new User();
            $provisorio->email = 'teste@teste.com.br';
            $provisorio->avatar = 'Mascote.jpg';
            $this->render('sobre',['loggedUser'=>$provisorio]);
        }
        else{
            $this->render('sobre',['loggedUser'=>$this->loggedUser]);
        }
        
    }

}