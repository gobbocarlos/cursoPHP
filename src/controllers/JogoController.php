<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;
use \src\Handlers\PostHandler;
use \src\Handlers\JogoHandler;
use \src\Models\Jogo;
use \src\Models\Escalacao;
use \src\Models\User;

class JogoController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            $this->redirect('/login');
        }
        
    }
    public function index() {
        $jogos= Jogo::select()->orderby('quadro','asc')->orderby('data','desc')->execute();
        $this->render('jogos',['jogos'=>$jogos,'loggedUser'=>$this->loggedUser]);
    }
    public function jogo($idJogo) {
        $jogo = Jogo::select()->where('id',$idJogo)->one();
        $page = intval(filter_input(INPUT_GET,'page'));
        $feed = PostHandler::getHomeFeed(
            $this->loggedUser->id,
            $page,
            $idJogo
        );
        $escalacao = [];
        $escalacao = Escalacao:: select()->where('idjogo',$idJogo)->get();
       foreach ($escalacao as $key => $novaEscalacao) {
           $escalacao[$key]['jogador'] = User::select()->where('id',$novaEscalacao['iduser'])->get();
       }
        $this->render('jogo',[
            'loggedUser'=>$this->loggedUser,
            'feed'=>$feed,
            'jogo'=>$jogo,
            'escalacao'=>$escalacao
            ]);
    }
   public function jogoadd(){
        $adversario = filter_input(INPUT_POST,'adversario');
        $data = filter_input(INPUT_POST,'data');
        $golsPro = filter_input(INPUT_POST,'golsPro',FILTER_SANITIZE_NUMBER_INT);
        $golsContra = filter_input(INPUT_POST,'golsContra',FILTER_SANITIZE_NUMBER_INT);
        $local = filter_input(INPUT_POST,'local');
        $quadro = filter_input(INPUT_POST,'quadro');
        $resultado = JogoHandler::jogoAdd($adversario,$data,$golsPro,$golsContra,$local,$quadro);
        $this->redirect('/paineldecontrole',['resultado'=>$resultado]);
   }
   public function jogoeditar($idJogo){
        if($this->loggedUser->id!=1 &&$this->loggedUser->id!=2){
            $this->redirect('/login');
        }
        $gols = 0;
        $assistencias = 0;   
        $jogo = Jogo::select()->where('id',$idJogo)->one();
        $users = UserHandler::listUsers();
        $escalacao = [];
        $escalacao = Escalacao:: select()->where('idjogo',$idJogo)->get();
       foreach ($escalacao as $key => $novaEscalacao) {
           $escalacao[$key]['jogador'] = User::select()->where('id',$novaEscalacao['iduser'])->get();
           $gols = $gols +$novaEscalacao['gol'];
           $assistencias = $assistencias + $novaEscalacao['assistencia'];
       }
        $this->render('jogoeditar',['loggedUser'=>$this->loggedUser,'jogo'=>$jogo,'users'=>$users,'escalacao'=>$escalacao,'gols'=>$gols,'assistencias'=>$assistencias]);
   }

}