<?php
namespace src\handlers;
use \src\models\Post;
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
            $newPost->meu = false;

            if($post['id'] == $usuario){
                $newPost->meu = true;
            }
            
            $newUsuario = Usuario::select()->where('id', $post['id_usuario'])->one();
            $newPost->usuario = new Usuario();
            $newPost->usuario->id = $newUsuario['id'];
            $newPost->usuario->nome = $newUsuario['nome'];
            $newPost->usuario->avatar = $newUsuario['avatar'];

            $newPost->likes = 0;
            $newPost->liked = false;
            $newPost->comentarios = [];
            
            $posts[] = $newPost;
        }
        return $posts;
    }
    public static function getUserFeed($usuario, $pagina, $loggedUser){

        $listPosts = Post::select()->where('id_usuario', $usuario)->orderBy('data', 'desc')->page($pagina, 2)->get();
        $totalPosts = Post::select()->where('id_usuario', $usuario)->count();
        $qtdPaginas = ceil($totalPosts / 2); //2 é quantidade de posts por pagina
        $posts = $posts = self::_postListToObject($listPosts, $loggedUser);
        return ['posts' => $posts, 'qtdPaginas' => $qtdPaginas, 'paginaAtual' => $pagina];
    }
    public static function getHomeFeed($id, $pagina){
        $listAmigos = Relacionamento::select()->where('de', $id)->get();
        $amizades = [];
        foreach ($listAmigos as $key => $amigo) {
            $amizades = $amigo['para'];
        }
        $amizades[] = $id;
        $listPosts = Post::select()->where('id_usuario', 'in', $amizades)->orderBy('data', 'desc')->page($pagina, 2)->get();
        $totalPosts = Post::select()->where('id_usuario', 'in', $amizades)->count();
        $qtdPaginas = ceil($totalPosts / 2); //2 é quantidade de posts por pagina
        $posts = self::_postListToObject($listPosts, $id);
        return ['posts' => $posts, 'qtdPaginas' => $qtdPaginas, 'paginaAtual' => $pagina];
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
    public function getFotos($usuario){
        $response = Post::select()->where('id_usuario', $usuario)->where('type', 'photo')->get();
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

    
}