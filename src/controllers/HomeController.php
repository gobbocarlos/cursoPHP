<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;

class HomeController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            $this->redirect('/login');
        }
        
    }
    public function index() {
        $this->render('home',['loggedUser'=> $this->loggedUser]);
    }
    public function sobre() {
        $this->render('sobre');
    }

}