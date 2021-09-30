<?php
namespace src\handlers;
use \src\models\Financeiro;
use src\models\User;

class FinanceiroHandler {
    public static function procurar($data1,$data2){
        $pagamentos= Financeiro::select()->where('data','>=',$data1)->where('data','<=',$data2)->get();
        foreach ($pagamentos as $key => $pagamento) {
            $pagamentos[$key]['user']= User::select()->where('id',$pagamento['userid'])->one();
        }
        return $pagamentos;
    }
    public function atualizar($id,$valor,$data,$mesreferencia,$usuario){
        Financeiro::update()->set('valor',$valor)->set('data',$data)->set('mesreferencia',$mesreferencia)->set('userid',$usuario)->where('id',$id)->execute();
    }
    public function deletar($id){
        Financeiro::delete()->where('id',$id)->execute();
    }
}