<?php
namespace src\controllers;
use \core\Controller;
use \src\handlers\UserHandler;
use \src\handlers\PostHandler;
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
        $id = filter_input(INPUT_POST,'id');
        $quadro = filter_input(INPUT_POST,'quadro');
        $adversario = filter_input(INPUT_POST,'adversario');
        $data = filter_input(INPUT_POST,'dataJogo');
        $golsPro = filter_input(INPUT_POST,'gp');
        $golsContra = filter_input(INPUT_POST,'gc');
        $local = filter_input(INPUT_POST,'local');
        Jogo::update(
            'quadro'=>$quadro,
            'adversario'=>$adversario,
            'data'=>$data,
            'golspro'=>$golsPro,
            'golsContra'=>$golsContra,
            'local'=>$local
        )->where('id',$id)->execute();
        header("Content-Type: application/json");
        $array['id']= $id;
        $array['quadro']=$quadro;
        $array['adversario']=$adversario;
        $array['data']=$data;
        $array['golsPro']=$golsPro;
        $array['golsContra']=$golsContra;
        $array['local']=$local;
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
  /* public function upload(){
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
}