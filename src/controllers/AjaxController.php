<?php
namespace src\controllers;
use \core\Controller;
use \src\handlers\UserHandler;
use \src\handlers\PostHandler;
use \src\Models\Jogo;
use \src\Models\Escalacao;
use \src\handlers\JogoHandler;
class AjaxController extends Controller {
    private $loggedUser;
    public function __construct(){
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser===false){
           header("Content-Type: application/json");
           echo json_encode(['error'=>'usuário não logado.']);
           exit;
        }
        
    }
   public function dadosjogo(){
        $array = ['error'=>''];   
        // $id = filter_input(INPUT_POST,'id');
        // $quadro = filter_input(INPUT_POST,'quadro');
        // $adversario = filter_input(INPUT_POST,'adversario');
        // $data = filter_input(INPUT_POST,'dataJogo');
        // $golsPro = filter_input(INPUT_POST,'gp');
        // $golsContra = filter_input(INPUT_POST,'gc');
        // $local = filter_input(INPUT_POST,'local');


        /*
            Você está enviando um json na requisição, não consegue acessar diretament por POST tem que fazer o parse, e só depois fazer as validações (Falta validar os dados, deve fazer isso depois, deixei funcionar para ver a edição funcionando)
        */
        $data_inputs = json_decode(file_get_contents('php://input'), true);
        
        /*
            Verifica se no json após o parse existe algum dado
        */
        if (is_array($data_inputs) && !empty($data_inputs)) {


            /*
                Aqui preenchemos as variaveis (Fazer validação dos dados)
            */
            $id = $data_inputs['id'];
            $quadro = $data_inputs['quadro'];
            $adversario = $data_inputs['adversario'];
            $data = $data_inputs['dataJogo'];
            $golsPro =$data_inputs['gp'];
            $golsContra = $data_inputs['gc'];
            $local = $data_inputs['local'];  

            /*
                Aqui variaveis estavam com nomes errados (Comparar com seu código)
            */
            Jogo::update([
                'quadro' => $quadro,
                'adversario'=>$adversario,
                'data'=>$data,
                'golspro'=>$golsPro,
                'golscontra'=>$golsContra,
                'local'=>$local
            ])->where('id',$id)->execute();
            
            $array['id']= $id;
            $array['quadro']=$quadro;
            $array['adversario']=$adversario;
            $array['data']=$data;
            $array['golsPro']=$golsPro;
            $array['golsContra']=$golsContra;
            $array['local']=$local;
        } else {
            $array['error'] = "Dados não enviados";
        }

        header("Content-Type: application/json");   
        echo json_encode($array);
        exit;
   }
    public function dadosjogadores(){
        $array = ['error'=>''];
        /*
            Você está enviando um json na requisição, não consegue acessar diretament por POST tem que fazer o parse, e só depois fazer as validações (Falta validar os dados, deve fazer isso depois, deixei funcionar para ver a edição funcionando)
        */
        $data_inputs = json_decode(file_get_contents('php://input'), true);
        
        /*
            Verifica se no json após o parse existe algum dado
        */
        if (is_array($data_inputs) && !empty($data_inputs)) {


            /*
                Aqui preenchemos as variaveis (Fazer validação dos dados)
            */
            $idjogo = $data_inputs['idjogo'];
            $id = $data_inputs['id'];
            $posicao = $data_inputs['posicao'];
            $nota = $data_inputs['nota'];
            $gol = $data_inputs['gol'];
            $ass =$data_inputs['ass'];
            $data = $data_inputs['data'];
            /*
                Aqui variaveis estavam com nomes errados (Comparar com seu código)
            */
            Escalacao::insert([
                'idjogo' => $idjogo,
                'iduser'=>$id,
                'posicao'=>$posicao,
                'nota'=>$nota,
                'gol'=>$gol,
                'assistencia'=>$ass,
                'data'=>$data
            ])->execute();
            $array['id']= $id;
            $array['idjogo']=$idjogo;
            $array['posicao']=$posicao;
            $array['nota']=$nota;
            $array['gol']=$gol;
            $array['ass']=$ass;
        } 
        else{
            $array['error'] = "Dados não enviados";
        }

        header("Content-Type: application/json");   
        echo json_encode($array);
        exit;
    }
    public function comment(){
        $array = ['error'=>''];   
        $id= filter_input(INPUT_POST,'id');
        $txt= filter_input(INPUT_POST,'txt');
        if($id && $txt){
                PostHandler::addComment($id,$txt,$this->loggedUser->id);
                $array['link'] = '/perfil/'.$this->loggedUser->id ;
                $array['avatar'] = '/images/avatars/'.$this->loggedUser->avatar;
                $array['name'] = $this->loggedUser->name;
                $array['body'] = $txt;
        }
        header("Content-Type: application/json");
            echo json_encode($array);
            exit;
    }
    /*public function upload(){
       $array=['error'=>''];
        if(isset($_FILES['photo'])$$ !empty($_FILES['photo']['tmp_name'])){
            $photo = $_FILES['photo'];
            $maxWidth = 800;
            $maxHeight = 800;
            if(in_array($photo['type'],['image/png,image/jpg,image/jpeg'])){
                list($widthOrig,$heightOrig) = getsizeimage($photo['tmp_name']);
                $ratio = $widthOrig/$heightOrig;
                $newWidth = $maxWidth;
                $newHeight = $maxHeight;
                $ratioMax = $maxWidth/$maxHeight;
                if($ratioMax>$ratio){
                    $newWidth = $newHeight * $ratio;
                }else{
                    $newHeight = $newWidth * $ratio;
                }
                $finalImage = imagecreatortruecolor($newWidth,$newHeight);
                switch($photo['type']){
                    case 'image/png':
                        $image = imagecreatefrompng($photo['tmp_name']);
                    break;
                    case 'image/jpg':
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($photo['tmp_name']);
                    break;
                }
                imagecopyresampled(
                    $finalImage,$image,
                    0,0,0,0,
                    $newWidth,$newHeight,$widthOrig,$heightOrig
                );
                $photoName = md5(time().tand(0,9999)).'jpg';
                imagejpeg($finalImage,'media/uploads/'.$photoName);
                PostHandler::addPost($this->loggedUSer->id,'photo',$photoName);
            }
        }else{
            $array['error']='Nenhuma imagem enviada.';
        }

       header("Content-Type: application/json");
           echo json_encode($array);
           exit;

   }*/
    public function calendarioVoltar(){
        $array = ['error'=>''];  
        $data_inputs = json_decode(file_get_contents('php://input'), true);
        if (is_array($data_inputs) && !empty($data_inputs)) {
            $ano = $data_inputs['ano'];
            $mes = $data_inputs['mes'];
            $mesNovo = AjaxController::nomeParaNumero($mes);
            $mesNovo = $mesNovo - 1;
            if($mesNovo==0){
                $mesNovo = 12;
                $ano = $ano-1;
            }
            $dataJogo1 = date($ano.'/0'.$mesNovo.'/01');
            $ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mesNovo, $ano);
            if($ultimoDia==31){
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/31');
            }
            else if($ultimoDia==29){
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/29');
            }
            else if($ultimoDia==28){
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/28');
            }
            else{
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/30');
            }
            $nomeMesNovo = AjaxController::numeroParaNome($mesNovo);
            $jogosPrimeiroQuadro = JogoHandler:: procurarPorQuadro(1,$dataJogo1,$dataJogo2);
            $jogosSegundoQuadro = JogoHandler:: procurarPorQuadro(2,$dataJogo1,$dataJogo2);
            if(count($jogosPrimeiroQuadro)==0){
                $array['jogosPrimeiroQuadro'] ='Jogo não marcado';
            }
            else{
                $array['jogosPrimeiroQuadro'] = $jogosPrimeiroQuadro;
            }
            if(count($jogosSegundoQuadro)==0){
                $array['jogosSegundoQuadro'] = 'Jogo não marcado.';
            }
            else{
                $array['jogosSegundoQuadro'] = $jogosSegundoQuadro;
            }
           $array['nomeMesNovo'] = $nomeMesNovo;
           $array['ano'] = $ano;
        }
        else {
            $array['error'] = "Dados não enviados";
        }

        header("Content-Type: application/json");   
        echo json_encode($array);
        exit;
    }
    public function calendarioAdiantar(){
        $array = ['error'=>''];  
        $data_inputs = json_decode(file_get_contents('php://input'), true);
        if (is_array($data_inputs) && !empty($data_inputs)) {
            $ano = $data_inputs['ano'];
            $mes = $data_inputs['mes'];
            $mesNovo = AjaxController::nomeParaNumero($mes);
            $mesNovo = $mesNovo + 1;
            if($mesNovo==13){
                $mesNovo=1;
                $ano = $ano + 1;
            }
            $dataJogo1 = date($ano.'/0'.$mesNovo.'/01');
            $ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mesNovo, $ano);
            if($ultimoDia==31){
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/31');
            }
            else if($ultimoDia==29){
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/29');
            }
            else if($ultimoDia==28){
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/28');
            }
            else{
                $dataJogo2 = date($ano.'/0'.$mesNovo.'/30');
            }
            $nomeMesNovo = AjaxController::numeroParaNome($mesNovo);
            $jogosPrimeiroQuadro = JogoHandler:: procurarPorQuadro(1,$dataJogo1,$dataJogo2);
            $jogosSegundoQuadro = JogoHandler:: procurarPorQuadro(2,$dataJogo1,$dataJogo2);
            if(count($jogosPrimeiroQuadro)==0){
                $array['jogosPrimeiroQuadro'] ='Jogo não marcado';
            }
            else{
                $array['jogosPrimeiroQuadro'] = $jogosPrimeiroQuadro;
            }
            if(count($jogosSegundoQuadro)==0){
                $array['jogosSegundoQuadro'] = 'Jogo não marcado.';
            }
            else{
                $array['jogosSegundoQuadro'] = $jogosSegundoQuadro;
            }
           $array['nomeMesNovo'] = $nomeMesNovo;
           $array['ano'] = $ano;
        }
        else {
            $array['error'] = "Dados não enviados";
        }

        header("Content-Type: application/json");   
        echo json_encode($array);
        exit;
    }
    public function nomeParaNumero($mes){
        switch ($mes) {
            case ("JANEIRO"):
                $mesNovo = "01";
            break;
            case ("FEVEREIRO"):
                $mesNovo = "02";
            break;
            case ("MARÇO"):
                $mesNovo = "03";
            break;
            case ("ABRIL"):
                $mesNovo = "04";
            break;
            case ("MAIO"):
                $mesNovo = "05";
            break;
            case ("JUNHO"):
                $mesNovo = "06";
            break;
            case ("JULHO"):
                $mesNovo = "07";
            break;
            case ("AGOSTO"):
                $mesNovo = "08";
            break;
            case ("SETEMBRO"):
                $mesNovo = "09";
            break;
            case ("OUTUBRO"):
                $mesNovo = "10";
            break;
            case ("NOVEMBRO"):
                $mesNovo = "11";
            break;
            case ("DEZEMBRO"):
                $mesNovo = "12";
            break;
        }
        return $mesNovo;
    }
    public function numeroParaNome($numeroMes){
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
        return $mes;
    }
}