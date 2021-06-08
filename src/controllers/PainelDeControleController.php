<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;
use \src\Handlers\PostHandler;
class PainelDeControleController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            $this->redirect('/login');
        }
        if($this->loggedUser->id!=1 &&$this->loggedUser->id!=2){
            $this->redirect('/login');
        }
        
    }
    public function index() {
        $this->render('paineldecontrole',['loggedUser'=>$this->loggedUser]);
    }
   
}