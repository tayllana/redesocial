<?php
namespace src\handlers;
use \src\models\Post;

class PostHandlers {

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