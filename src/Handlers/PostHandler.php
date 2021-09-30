<?php
namespace src\handlers;
use \src\models\Post;
use \src\models\PostComment;
use \src\models\User;

class PostHandler {

    public static function addPost($idUser,$idJogo,$body){
        $body = trim($body);
        if(!empty($idUser) && !empty($body)){
            Post::insert([
                'iduser'=>$idUser,
                'datacriacao'=>date('Y-m-d H:i:s'),
                'body'=>$body,
                'idjogo'=>$idJogo
            ])->execute();
        }
    }
    public static function _postListToObject($postList,$loggedUserId){
        $posts = [];
        foreach($postList as $postItem){
            $newPost = new Post();
            $newPost->id = $postItem['id'];
            $newPost->createdat = $postItem['datacriacao'];
            $newPost->body = $postItem['body'];
            $newUser = User::select()->where('id',$postItem['iduser'])->one();
            $newPost->user = new User();
            $newPost->user->id = $newUser['id'];
            $newPost->user->name = $newUser['nome'];
            $newPost->user->avatar = $newUser['avatar'];
            $newPost->comments = PostComment::select()->where('idpost',$postItem['id'])->get();
           foreach($newPost->comments as $key=>$comment){
               $newPost->comments[$key]['user'] = USer::select()->where('id',$comment['iduser'])->one();
           }
            $posts[] = $newPost; 
        }
        return $posts;
    }
    public static function getHomeFeed($idUser,$page,$idJogo){
        $perPage = 5;
        //1. pegar os Post da lista ordenado por data
        $postList = Post::select()->where('idjogo',$idJogo)->orderby('datacriacao','desc')->page($page,$perPage)->get();
        $total = Post::select()->where('idjogo',$idJogo)->count();
        $pageCount = ceil($total/$perPage);
        //3. Transformar o resultado em objetos do Models.
        $posts = self::_postListToObject($postList,$idUser);
        return [
            'posts'=>$posts,
            'pageCount'=>$pageCount,
            'currentPage'=>$page
        ];
    }
  
   public static function addComment($id,$txt,$loggedUserId){
        PostComment::insert([
            'idpost'=>$id,
            'iduser'=>$loggedUserId,
            'datacriacao'=>date('Y-m-d H:i:s'),
            'body'=>$txt
        ])->execute();
   }
   public static function delete($id,$loggedUserId){
        //1.Verificar se o post existe e se é do usuário logado.
        $post = Post::select()->where('id',$id)->where('iduser',$loggedUserId)->get();
        if(count($post)>0){
            $post = $post[0];
             //2.Deletar Likes e comments.
             //PostLike::delete()->where('idpost',$id)->execute();
             PostComment::delete()->where('idpost',$id)->execute();
             //3.Se o post for foto, deletar o arquivo.
           
        }
       //4.deletar o post.
       Post::delete()->where('id',$id)->execute();

        

        
   }
}