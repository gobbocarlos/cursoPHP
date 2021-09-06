<?php
namespace src\handlers;
use \src\models\User;
use \src\handlers\PostHandler;
class UserHandler {
    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            $data = USer::select()->where('token',$token)->one();
            if($data){
                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->name = $data['nome'];
                $loggedUser->email = $data['email'];
                $loggedUser->avatar = $data['avatar'];
                return $loggedUser;
            }
            
        }
       return false;
    }
    public static function verifyLogin($email,$password){
        $user = User::select()->where('email',$email)->one();
        if($user){
            if(password_verify($password,$user['senha'])){
                $token =md5(time().rand(0,9999).time());
                User::update()
                    ->set('token',$token)
                    ->where('email',$email)
                ->execute();

                return $token;
            }
        }
    }
    public static function emailExists($email){
        $user = User::select()->where('email',$email)->one();
        return $user ? true : false;
    }
    public static function idExists($id){
        $user = User::select()->where('id',$id)->one();
        return $user ? true : false;
    }
    public static function getUser($id, $full = false){
        $data = User::select()->where('id',$id)->one();
        if($data){
            $user = new User();
            $user->id = $data['id'];
            $user->name = $data['nome'];
            $user->birthdate = $data['aniversario'];
            $user->avatar = $data['avatar'];
            $user->email = $data['email'];
            
            return $user;
        }
        return false;
    }
    public static function addUser($name,$email,$password,$birthdate){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $token =md5(time().rand(0,9999).time());
        User::insert([
            'email'=>$email,
            'senha'=>$hash,
            'nome'=>$name,
            'aniversario'=>$birthdate,
            'token'=>$token
        ])->execute();
        return $token;
    }
   
    public static function searchUser($term){
        $users = [];
        $data = User::select()->where('nome','like','%'.$term.'%')->get();
        if($data){
            foreach($data as $user){
                $newUser = new User();
                $newUser->id = $user['id'];
                $newUser->name = $user['nome'];
                $newUser->avatar = $user['avatar'];
                $users[] = $newUser; 
            }
        }
        return $users;
    }
   
    public static function updateUser($fields, $idUser) {
        if(count($fields) > 0) {

            $update = User::update();

            foreach($fields as $fieldName => $fieldValue) {
                if($fieldName == 'senha') {
                    $fieldValue = password_hash($fieldValue, PASSWORD_DEFAULT);
                }

                $update->set($fieldName, $fieldValue);
            }

            $update->where('id', $idUser)->execute();

        }
    }
    public static function listUsers(){
        $users=[];
        $data = User::select()->get();
        if($data){
            foreach($data as $user){
                $newUser = new User();
                $newUser->id = $user['id'];
                $newUser->name = $user['nome'];
                $newUser->avatar = $user['avatar'];
                $users[] = $newUser; 
            }
        }
        return $users;
    }
}