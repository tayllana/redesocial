<?php
namespace src\handlers;

use \src\models\Comentario;
use \src\models\Post;
use \src\models\Like;
use \src\models\Usuario;
use \src\models\Relacionamento;

class PostHandlers {

    public function _postListToObject($listPosts, $usuario){
        $posts = [];
        foreach ($listPosts as $key => $post) {
            $newPost = new Post();
            $newPost->id = $post['id'];
            $newPost->type = $post['type'];
            $newPost->data = $post['data'];
            $newPost->conteudo = $post['conteudo'];
            $newPost->meu = $post['usuario_id'] == $usuario;

           
            
            $newUsuario = Usuario::select()->where('id', $post['usuario_id'])->one();
            $newPost->usuario = new Usuario();
            $newPost->usuario->id = $newUsuario['id'];
            $newPost->usuario->nome = $newUsuario['nome'];
            $newPost->usuario->avatar = $newUsuario['avatar'];

            $newPost->likes = count(Like::select()->where('post_id', $post['id'])->get());
            $newPost->liked = self::isLiked($post['id'], $usuario);

          
            $newPost->comentarios = Comentario::select()->where('post_id', $post['id'])->get();
            foreach($newPost->comentarios as $key => $comentario) {
                $newPost->comentarios[$key]['usuario'] = Usuario::select()->where('id', $comentario['usuario_id'])->one();
            }
            
            $posts[] = $newPost;
        }
        return $posts;
    }
    public static function getUserFeed($usuario, $pagina, $loggedUser){

        $listPosts = Post::select()->where('usuario_id', $usuario)->orderBy('data', 'desc')->page($pagina, 3)->get();
        $totalPosts = Post::select()->where('usuario_id', $usuario)->count();
        $qtdPaginas = ceil($totalPosts / 2); //2 é quantidade de posts por pagina
        $posts = $posts = self::_postListToObject($listPosts, $loggedUser);
        return ['posts' => $posts, 'qtdPaginas' => $qtdPaginas, 'paginaAtual' => $pagina];
    }
    public static function getHomeFeed($id, $pagina){
        $listAmigos = Relacionamento::select()->where('de', $id)->get();
        $amizades = [];
        foreach ($listAmigos as $key => $amigo) {
            $amizades[] = $amigo['para'];
        }
        $amizades[] = $id;
        $listPosts = Post::select()->where('usuario_id', 'in', $amizades)->orderBy('data', 'desc')->page($pagina, 3)->get();
        $totalPosts = Post::select()->where('usuario_id', 'in', $amizades)->count();
        $qtdPaginas = ceil($totalPosts / 2); //2 é quantidade de posts por pagina
        $posts = self::_postListToObject($listPosts, $id);
        return ['posts' => $posts, 'qtdPaginas' => $qtdPaginas, 'paginaAtual' => $pagina];
    }

    public static function addPost($usuario, $tipo, $conteudo){
        try {
            if(!empty($usuario)){
                Post::insert([
                    'usuario_id' => $usuario, 
                    'type' => $tipo, 
                    'conteudo' => $conteudo
                ])->execute();
            }
            return 'Sucesso!';
        } catch (\Exception $e) {
            return "Erro ao inserir os dados: " . $e->getMessage();
        }
    }
    public function getFotos($usuario){
        $response = Post::select()->where('usuario_id', $usuario)->where('type', 'photo')->get();
        $fotos = [];
        foreach ($response as $key => $foto) {
            $newPost = new Post();
            $newPost->id = $foto['id'];
            $newPost->type = $foto['type'];
            $newPost->data = $foto['data'];
            $newPost->conteudo = $foto['conteudo'];
            $fotos[] = $newPost;
        }
        return $fotos;
    }

    public static function isLiked($id, $loggedUserId) {
        return count(Like::select()->where('post_id', $id)->where('usuario_id', $loggedUserId)->get()) > 0? true: false;
    }

    public static function deleteLike($id, $loggedUserId) {
        Like::delete()
            ->where('post_id', $id)
            ->where('usuario_id', $loggedUserId)
        ->execute();
    }

    public static function addLike($id, $loggedUserId) {
        Like::insert([
            'post_id' => $id,
            'usuario_id' => $loggedUserId,
            'data' => date('Y-m-d H:i:s')
        ])->execute();
    }

    public static function addComment($id, $txt, $loggedUserId) {
        Comentario::insert([
            'post_id' => $id,
            'usuario_id' => $loggedUserId,
            'data' => date('Y-m-d H:i:s'),
            'conteudo' => $txt
        ])->execute();
    }

    public static function delete($id, $loggedUserId) {
        $post = Post::select()
            ->where('id', $id)
            ->where('usuario_id', $loggedUserId)
        ->get();

        if(count($post) > 0) {
            $post = $post[0];

            Like::delete()->where('post_id', $id)->execute();
            Comentario::delete()->where('post_id', $id)->execute();

            if($post['type'] === 'photo') {
                $img = __DIR__.'/../../public/media/uploads/'.$post['body'];
                if(file_exists($img)) {
                    unlink($img);
                }
            }
            Post::delete()->where('id', $id)->execute();
        }
    }
    
}