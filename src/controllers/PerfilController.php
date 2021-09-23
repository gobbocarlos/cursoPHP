<?php
namespace src\controllers;

use \core\Controller;
use\src\Handlers\UserHandler;
use\src\Models\User;
use\src\Models\Jogo;
use\src\Models\Escalacao;
use \src\Models\Nota;

class PerfilController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            $this->redirect('/login');
        }
       
    }
    public function index() {
        $usuarios = User:: select()->get();
        $this->render('perfil',['loggedUser'=>$this->loggedUser,'listaUsuarios'=>$usuarios]);
    }
    public function perfilJogador($id) {
        $dataJogo1 = date('2020/01/01');
        $dataJogo2 = date('Y/m/d');
        $anoAtual = date('Y');
        $usuario = User:: select()->where('id',$id)->one();
        $jogos = Escalacao:: select()->where('iduser',$id)->where('data','>=',$dataJogo1)->where('data','<=',$dataJogo2)->orderby('data')->get();
        $notas = Nota:: select()->where('userid',$id)->one();
        $jogosPorAno[0] = [
            'ano'=>date('Y',strtotime($jogos[0]['data'])),
            'gol'=>$jogos[0]['gol'],
            'ass'=>$jogos[0]['assistencia'],
            'nota'=>$jogos[0]['nota'],
            'jogos'=>1
        ];        
        $jogosFeitos = count($jogos);
        $ano1 = date('Y',strtotime($jogos[0]['data']));
        $cont = 0;
       
        for ($i=1; $i <count($jogos) ; $i++) { 
            if(date('Y',strtotime($jogos[$i]['data']))==$ano1){
                $jogosPorAno[$cont]['ano'] = date('Y',strtotime($jogos[$i]['data']));
                $jogosPorAno[$cont]['gol'] = $jogosPorAno[$cont]['gol'] + $jogos[$i]['gol'];
                $jogosPorAno[$cont]['ass'] = $jogosPorAno[$cont]['ass'] + $jogos[$i]['assistencia'];
                $jogosPorAno[$cont]['nota'] = $jogosPorAno[$cont]['nota'] + $jogos[$i]['nota'];
                $jogosPorAno[$cont]['jogos'] = $jogosPorAno[$cont]['jogos'] + 1;
            }
            else{
                $cont++;
                $jogosPorAno[$cont]['ano'] = date('Y',strtotime($jogos[$i]['data']));
                $jogosPorAno[$cont]['gol'] =  $jogos[$i]['gol'];
                $jogosPorAno[$cont]['ass'] =  $jogos[$i]['assistencia'];
                $jogosPorAno[$cont]['nota'] =  $jogos[$i]['nota'];
                $jogosPorAno[$cont]['jogos'] =  1;
                $ano1 = date('Y',strtotime($jogos[$i]['data']));
            }
        }
        $golsTotal = 0;
        $assTotal = 0;
        $notaTotal = 0;
        foreach ($jogosPorAno as $key => $value) {
            $jogosPorAno[$key]['nota'] = $value['nota']/$value['jogos'];
            $notaTotal = $notaTotal + $jogosPorAno[$key]['nota'];
            $golsTotal = $golsTotal + $value['gol'];
            $assTotal = $assTotal + $value['ass'];
        }
        $notaTotal = $notaTotal / count($jogosPorAno);
        $this->render('perfilJogador',['notas'=>$notas, 'notaTotal'=>$notaTotal,'jogos'=>$jogosPorAno, 'loggedUser'=>$this->loggedUser,'usuario'=>$usuario,'jogosFeito'=>$jogosFeitos,'golsTotal'=>$golsTotal,'assTotal'=>$assTotal]);
    }
    public function notasJogador(){
        $id = (int)$_POST['jogadores'];
        $posicionamento = (int)filter_input(INPUT_POST,'posicionamento',FILTER_SANITIZE_NUMBER_INT);
        $defesa = (int)filter_input(INPUT_POST,'defesa',FILTER_SANITIZE_NUMBER_INT);
        $fisico = (int)filter_input(INPUT_POST,'fisico',FILTER_SANITIZE_NUMBER_INT);
        $inteligencia = (int)filter_input(INPUT_POST,'inteligencia',FILTER_SANITIZE_NUMBER_INT);
        $tecnica = (int)filter_input(INPUT_POST,'tecnica',FILTER_SANITIZE_NUMBER_INT);
        $finalizacao = (int)filter_input(INPUT_POST,'finalizacao',FILTER_SANITIZE_NUMBER_INT);
        if($id && $posicionamento && $defesa && $fisico && $inteligencia && $tecnica && $finalizacao){
            Nota:: insert([
                'userid'=>$id,
                'posicionamento'=>$posicionamento,
                'defesa'=>$defesa,
                'fisico'=>$fisico,
                'inteligencia'=>$inteligencia,
                'tecnica'=>$tecnica,
                'finalizacao'=>$finalizacao
            ])->execute();
        }
        else{
            $_SESSION['flash'] = 'Não foi possível salvar as notas.';
        }
        $this->redirect('/paineldecontrole');
   }
    
}