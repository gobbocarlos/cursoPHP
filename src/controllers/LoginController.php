<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\models\User;

class LoginController extends Controller {
   
   
    public function signin() {
        $flash ='';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash']='';
        }
        $this->render('login',['flash'=>$flash]);
    }

    public function signinAction(){
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST,'password');
        if($email && $password){
            $token = UserHandler::verifyLogin($email,$password);
            if($token){
                $_SESSION['token']=$token;
                $this->redirect('/');
            }else{
                $_SESSION['flash'] = 'E-mail e/ou Senha não conferem.';
                $this->redirect('/login');
            }
        }else{
            
            $this->redirect('/login');
        }
    }
    public function signup() {
        $flash ='';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash']='';
        }
        $this->render('cadastro',['flash'=>$flash]);
    }
    public function signupAction() {
        $name = filter_input(INPUT_POST,'name');
        $birthdate = filter_input(INPUT_POST,'birthdate');
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST,'password');
        $password2 = filter_input(INPUT_POST,'password2');
        if($password!=$password2){
            $_SESSION['flash']='Senha e Confirmar senha não conferem.';
            $this->redirect("/paineldecontrole");
        }
        else{
            if($name && $birthdate && $email && $password){
                $birthdate = explode('/',$birthdate);
                if(count($birthdate)!=3){
                    $_SESSION['flash']='Data de nascimento invalida.';
                    $this->redirect('/cadastro');
                }    
                $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
                if(strtotime($birthdate)===false){
                    $_SESSION['flash']='Data de nascimento invalida.';
                    $this->redirect('/cadastro');
                }
               if(UserHandler::emailExists($email)===false){
                    if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
                        $newAvatar = $_FILES['avatar'];
                        if(in_array($newAvatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                            $avatarName = $this->cutImageAvatar($newAvatar, 200, 200, 'assets/images/avatars');
                            //$updateFields['avatar'] = $avatarName;
                        }
                    }
                    UserHandler::addUser($name,$email,$password,$birthdate,$avatarName);
                   //$_SESSION['token']=$token;
                   $_SESSION['flash']='Jogador adicionado com sucesso.';
                   $this->redirect("/paineldecontrole");
               }
               else{
                   $_SESSION['flash']='E-mail já cadastrado.';
                   $this->redirect('/paineldecontrole');
               }
            }
            else{
                $_SESSION['flash']='Erro ao adicionar jogador.';
                $this->redirect('/paineldecontrole');
            }
        }
        
    }
    public function updateAction(){
     
        $name = filter_input(INPUT_POST, 'name');
        $birthdate = filter_input(INPUT_POST, 'birthdate');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST, 'password2');
        $id = filter_input(INPUT_POST, 'jogadores');
       if($password!=$password2){
            $_SESSION['flash'] = 'Senha e Confirmar senha não conferem..';
       }
       else{
        if ($name && $birthdate && $email && $id) {
            $birthdate = explode('/', $birthdate);
            if (count($birthdate) != 3) {
                $_SESSION['flash'] = 'Data de nascimento invalida.';
            }
            $birthdate = $birthdate[2] . '-' . $birthdate[1] . '-' . $birthdate[0];
            if (strtotime($birthdate) === false) {
                $_SESSION['flash'] = 'Data de nascimento invalida.';
            }
            if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
                $newAvatar = $_FILES['avatar'];
    
                if(in_array($newAvatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                    $avatarName = $this->cutImageAvatar($newAvatar, 200, 200, 'assets/images/avatars');
                    //$updateFields['avatar'] = $avatarName;
                }
            }
            UserHandler::updateUser($name, $email, $password, $birthdate, $id,$avatarName);
            $_SESSION['flash'] = "Cadastro Atualizado com SUCESSO!";
        } else {
            $_SESSION['flash'] = 'Não foi possível alterar o cadastro.';
        }
       }
        
        $this->redirect("/cadastroAtualizar?jogadores=$id");
    }
    public function update(){
        $flash ='';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash']='';
        }
        $id = filter_input(INPUT_GET,'jogadores');
        $jogador = User::select()->where('id',$id)->one();
        $this->render('/cadastroAtualizar',['jogador'=>$jogador,'flash'=>$flash]);
    }
    public function logout(){
        $_SESSION['token']='';
        $this->redirect('/');
    }
    private function cutImageAvatar($file, $w, $h, $folder) {
        list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
        $ratio = $widthOrig / $heightOrig;

        $newWidth = $w;
        $newHeight = $newWidth / $ratio;

        if($newHeight < $h) {
            $newHeight = $h;
            $newWidth = $newHeight * $ratio;
        }

        $x = $w - $newWidth;
        $y = $h - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;

        $finalImage = imagecreatetruecolor($w, $h);
        switch($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
            break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
            break;
        }

        imagecopyresampled(
            $finalImage, $image,
            $x, $y, 0, 0,
            $newWidth, $newHeight, $widthOrig, $heightOrig
        );

        $fileName = md5(time().rand(0,9999)).'.jpg';

        imagejpeg($finalImage, $folder.'/'.$fileName);

        return $fileName;
    }
}