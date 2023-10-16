<?php
namespace src\handlers;
use \src\models\Post;
use \src\models\Usuario;
use \src\models\Relacionamento;

class PostHandlers {

    public static function getHomeFeed($usuario){
        $listAmigos = Relacionamento::select()->where('de', $usuario)->get();
        $amizades = [];
        foreach ($listAmigos as $key => $amigo) {
            $amizades = $amigo['para'];
        }
        $amizades[] = $usuario;

        $listPosts = Post::select()->where('id_usuario', $usuario)->orderBy('data', 'desc')->get();
        $posts = [];
        foreach ($listPosts as $key => $post) {
            $newPost = new Post();
            $newPost->id = $post['id'];
            $newPost->type = $post['type'];
            $newPost->data = $post['data'];
            $newPost->conteudo = $post['conteudo'];
            
            $newUsuario = Usuario::select()->where('id', $post['id_usuario'])->one();
            $newPost->usuario = new Usuario();
            $newPost->usuario->id = $newUsuario['id'];
            $newPost->usuario->nome = $newUsuario['nome'];
            $newPost->usuario->avatar = $newUsuario['avatar'];

            $posts[] = $newPost;
        }
        return $posts;
    }

    public static function addPost($usuario, $tipo, $conteudo){
        try {
            if(!empty($usuario)){
                Post::insert([
                    'id_usuario' => $usuario, 
                    'type' => $tipo, 
                    'conteudo' => $conteudo
                ])->execute();
            }
            return 'Sucesso!';
        } catch (\Exception $e) {
            return "Erro ao inserir os dados: " . $e->getMessage();
        }
    }
    
}