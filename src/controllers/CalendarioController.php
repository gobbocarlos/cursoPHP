<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;
use \src\Handlers\JogoHandler;

class CalendarioController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            $this->redirect('/login');
        }
        
    }
    public function index() {
        $dataJogo1 = date('Y/m/01');
        $ultimoDia = date('t');
        if($ultimoDia==31){
            $dataJogo2 = date('Y/m/30');
        }
        else if($ultimoDia==29){
            $dataJogo2 = date('Y/m/29');
        }
        else if($ultimoDia==28){
            $dataJogo2 = date('Y/m/28');
        }
        else{
            $dataJogo2 = date('Y/m/30');
        }
        $jogosQuadro1 = JogoHandler::procurarPorQuadro('1',$dataJogo1,$dataJogo2);
        $jogosQuadro2 = JogoHandler::procurarPorQuadro('2',$dataJogo1,$dataJogo2);
        $numeroMes = date('m');
        switch ($numeroMes) {
            case (1):
                $mes = "JANEIRO";   
            break;
            case (2):
                $mes = "FEVEREIRO";
                break;
            case (3):
                $mes = "MARÇO";
                break;
            case (4):
                $mes = "ABRIL";
                break;
            case (5):
                $mes = "MAIO";
                break;
            case (6):
                $mes = "JUNHO";
                break;
            case (7):
                $mes = "JULHO";
                break;
            case (8):
                $mes = "AGOSTO";
                break;
            case (9):
                $mes = "SETEMBRO";
                break;
            case (10):
                $mes = "OUTUBRO";
                break;
            case (11):
                $mes = "NOVEMBRO";
                break;
            case (12):
                $mes = "DEZEMBRO";
                break;
        }
        $this->render('calendario',['loggedUser'=> $this->loggedUser, 'jogosQuadro1'=>$jogosQuadro1, 'jogosQuadro2'=>$jogosQuadro2,'mes'=>$mes,'ano'=>date('Y')]);
    }
    

}