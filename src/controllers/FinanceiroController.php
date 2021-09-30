<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\UserHandler;
use \src\Handlers\FinanceiroHandler;
use \src\models\Financeiro;
use \src\models\User;
use \src\Handlers\CalendarioHandler;

class FinanceiroController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
            $this->redirect('/login');
        }
        else{
            if( $this->loggedUser->email !='kkgobbo@gmail.com' && $this->loggedUser->email!='ppp@gmail.com'&& $this->loggedUser->email!='gustainde@hotmail.com'){
                $this->redirect('/');
            }
        }
    }
    public function index() {
        $data1 = date('Y/m/01');
        $ultimoDia = date('t');
        if($ultimoDia==31){
            $data2 = date('Y/m/30');
        }
        else if($ultimoDia==29){
            $data = date('Y/m/29');
        }
        else if($ultimoDia==28){
            $data2 = date('Y/m/28');
        }
        else{
            $data2 = date('Y/m/30');
        }
        $numeroMes = date('m');
        $mes = CalendarioHandler:: numeroParaNome($numeroMes);
       
        $pagamentos = FinanceiroHandler:: procurar($data1,$data2);
        foreach ($pagamentos as $key => $value) {
            array_push($pagamentos[$key],"mesreferenciaNome");
            $pagamentos[$key]['mesreferenciaNome']=CalendarioHandler::numeroParaNome($value['mesreferencia']);
        }
        $this->render('financeiro',['loggedUser'=> $this->loggedUser, 'mes'=>$mes,'ano'=>date('Y'),'pagamentos'=>$pagamentos]);
    }
    public function lancar(){
        $userid = (int)$_POST['jogadores'];
        $mesReferencia = (int)filter_input(INPUT_POST,'meses',FILTER_SANITIZE_NUMBER_INT);
        $data = filter_input(INPUT_POST,'data');
        $valor = (float)filter_input(INPUT_POST,'valor');
       
        if($userid && $mesReferencia && $data && $valor){
            Financeiro:: insert([
                'userid'=>$userid,
                'data'=>$data,
                'valor'=>$valor,
                'mesreferencia'=>$mesReferencia,
                'status'=>1
            ])->execute();
        }
        else{
            $_SESSION['flash'] = 'Não foi possível lançar o pagamento.';
        }
        $this->redirect('/paineldecontrole');
    }
    public function perfilFinanceiro($id) {
        $data1 = date('2020/01/01');
        //$data2 = date('Y/m/d');
        $data2 = date('2021/12/31');
        $anoAtual = date('Y');
        $usuario = User:: select()->where('id',$id)->one();
        $financeiro = Financeiro:: select()->where('userid',$id)->where('data','>=',$data1)->where('data','<=',$data2)->orderby('data')->get();
        foreach ($financeiro as $key => $value) {
            array_push($financeiro[$key],"mesreferenciaNome");
            $financeiro[$key]['mesreferenciaNome']=CalendarioHandler::numeroParaNome($value['mesreferencia']);
        }
        $this->render('financeiroPerfil',['pagamentos'=>$financeiro, 'loggedUser'=>$this->loggedUser,'usuario'=>$usuario]);
    }
    public function financeiroAlterar(){
        $id = (int)filter_input(INPUT_POST,'idEditar');
        $userid = (int)filter_input(INPUT_POST,'usuarioIdEditar');
        $mesReferencia = (int)filter_input(INPUT_POST,'mesesEditar',FILTER_SANITIZE_NUMBER_INT);
        $data = filter_input(INPUT_POST,'dataPagamentoEditar');
        $valor = (float)filter_input(INPUT_POST,'valorEditar');
        if($userid && $mesReferencia && $data && $valor){
            FinanceiroHandler:: atualizar($id,$valor,$data,$mesReferencia,$userid);
            $data1 = date('Y/m/01');
            $ultimoDia = date('t');
            if($ultimoDia==31){
                $data2 = date('Y/m/30');
            }
            else if($ultimoDia==29){
                $data = date('Y/m/29');
            }
            else if($ultimoDia==28){
                $data2 = date('Y/m/28');
            }
            else{
                $data2 = date('Y/m/30');
            }
            $numeroMes = date('m');
            $mes = CalendarioHandler:: numeroParaNome($numeroMes);
            $pagamentos = FinanceiroHandler:: procurar($data1,$data2);
            foreach ($pagamentos as $key => $value) {
                array_push($pagamentos[$key],"mesreferenciaNome");
                $pagamentos[$key]['mesreferenciaNome']=CalendarioHandler::numeroParaNome($value['mesreferencia']);
            }
            $this->render('/financeiro',['loggedUser'=>$this->loggedUser,'mes'=>$mes,'ano'=>date('Y'),'pagamentos'=>$pagamentos]);
        }
        $this->redirect('/financeiro');
    }
    public function deletar($id){
        FinanceiroHandler::deletar($id);
        $data1 = date('Y/m/01');
        $ultimoDia = date('t');
        if($ultimoDia==31){
            $data2 = date('Y/m/30');
        }
        else if($ultimoDia==29){
            $data = date('Y/m/29');
        }
        else if($ultimoDia==28){
            $data2 = date('Y/m/28');
        }
        else{
            $data2 = date('Y/m/30');
        }
        $numeroMes = date('m');
        $mes = CalendarioHandler:: numeroParaNome($numeroMes);
        $pagamentos = FinanceiroHandler:: procurar($data1,$data2);
        foreach ($pagamentos as $key => $value) {
            array_push($pagamentos[$key],"mesreferenciaNome");
            $pagamentos[$key]['mesreferenciaNome']=CalendarioHandler::numeroParaNome($value['mesreferencia']);
        }
        $this->render('/financeiro',['loggedUser'=>$this->loggedUser,'mes'=>$mes,'ano'=>date('Y'),'pagamentos'=>$pagamentos]);
    }
}