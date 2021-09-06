<?php
namespace src\handlers;
use \src\Models\Jogo;

class JogoHandler{
    public static function jogoAdd($adversario,$dataJogo,$golsPro,$golsContra,$local,$quadro){
      
        $jogo = Jogo::insert([
            'adversario'=>$adversario,
            'data'=>$dataJogo,
            'golspro'=>$golsPro,
            'golscontra'=>$golsContra,
            'local'=>$local,
            'quadro'=>$quadro
        ])->execute();
        
        return $jogo->id;
    }
    public static function procurarPorQuadro($quadro,$dataJogo1,$dataJogo2){
        $jogos= Jogo::select()->where('quadro',$quadro)->where('data','>=',$dataJogo1)->where('data','<=',$dataJogo2)->get();
        return $jogos;
    }
   
}