<?php
namespace src\controllers;

use \core\Controller;
use\src\Handlers\UserHandler;
use\src\Models\User;
use\src\Models\Jogo;
use\src\Models\Escalacao;
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
        /*foreach ($jogos as $key => $jogo) {
            if(date('Y',strtotime($jogo['data']))==$ano1){
                $jogosPorAno[$cont]['ano'] = date('Y',strtotime($jogo['data']));
                $jogosPorAno[$cont]['gol'] = $jogosPorAno[$cont]['gol'] + $jogo['gol'];
                $jogosPorAno[$cont]['ass'] = $jogosPorAno[$cont]['ass'] + $jogo['assistencia'];
                $jogosPorAno[$cont]['nota'] = $jogosPorAno[$cont]['nota'] + $jogo['nota'];
                $jogosPorAno[$cont]['jogos'] = $jogosPorAno[$cont]['jogos'] + 1;
            }
            else{
                $cont++;
                $jogosPorAno[$cont]['ano'] = date('Y',strtotime($jogo['data']));
                $jogosPorAno[$cont]['gol'] =  $jogo['gol'];
                $jogosPorAno[$cont]['ass'] =  $jogo['assistencia'];
                $jogosPorAno[$cont]['nota'] =  $jogo['nota'];
                $jogosPorAno[$cont]['jogos'] =  1;
                $ano1 = date('Y',strtotime($jogo['data']));
            }
        }*/
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
        $this->render('perfilJogador',['notaTotal'=>$notaTotal,'jogos'=>$jogosPorAno, 'loggedUser'=>$this->loggedUser,'usuario'=>$usuario,'jogosFeito'=>$jogosFeitos,'golsTotal'=>$golsTotal,'assTotal'=>$assTotal]);
    }

}