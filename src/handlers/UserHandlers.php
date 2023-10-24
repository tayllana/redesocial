<?php
namespace src\handlers;
use \src\models\Post;
use \src\models\Usuario;
use \src\models\Relacionamento;

class UserHandlers {

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            $_SESSION['usuario'] = Usuario::select()->where('token',$token)->one();
            if($_SESSION['usuario'] <= 0){
                $_SESSION['usuario'] = false;
            }
        }else{
            $_SESSION['usuario'] = false;
        }    
    }

    public static function verifyLogin($email, $password){
        $user = Usuario::select()->where('email',$email)->one();
        if($user){
            if(password_verify($password, $user['password'])){
                $token = md5(time().rand(0,9999).time());
                Usuario::update()->set('token', $token)->where('id', $user['id'])->execute();
                $_SESSION['usuario'] = $user;
                return $token; 
            }

        }
        return false;  
    }

    public static function idExists($id){
        $user = Usuario::select()->where('id',$id)->one();
        return $user? true: false;
    }

    public static function emailExists($email){
        $user = Usuario::select()->where('email',$email)->one();
        return $user? true: false;
    }

    public static function getUsuario($id){
        $response = Usuario::select()->where('id',$id)->one();
        if($response){
            $usuario = new Usuario();
            $usuario->id = $response['id'];
            $usuario->nome = $response['nome'];
            $usuario->aniversario = $response['aniversario'];
            $usuario->cidade = $response['cidade'];
            $usuario->emprego = $response['emprego'];
            $usuario->avatar = $response['avatar'];
            $usuario->capa = $response['capa'];

            $usuario->seguidores = [];
            $usuario->seguindo = [];
            $usuario->fotos = [];

            $seguidores = Relacionamento::select()->where('para', $id)->get();
            foreach ($seguidores as $key => $seguidor) {
                $dados = Usuario::select()->where('id', $seguidor['de'])->one;
                $novoUsuario = new Usuario();
                $novoUsuario->id = $dados['id'];
                $novoUsuario->nome = $dados['nome'];
                $novoUsuario->avatar = $dados['avatar'];
                $usuario->seguidores[] = $novoUsuario;
            }

            $seguindo = Relacionamento::select()->where('de', $id)->get();
            foreach ($seguindo as $key => $seguidor) {
                $dados = Usuario::select()->where('id', $seguidor['para'])->one;
                $novoUsuario = new Usuario();
                $novoUsuario->id = $dados['id'];
                $novoUsuario->nome = $dados['nome'];
                $novoUsuario->avatar = $dados['avatar'];
                $usuario->seguindo[] = $novoUsuario;
            }
            return $usuario;
        }
        return false;
    }

    public static function insertUser($email, $nome, $password, $nascimento){
        $token = md5(time().rand(0,9999).time());
        try {
            Usuario::insert([
                'email' => $email, 
                'nome' => $nome, 
                'senha' => password_hash($password, PASSWORD_DEFAULT), 
                'aniversario' => $nascimento,
                'avatar' => 'default.jpg',
                'capa' => 'cover.jpg',
                'token' => $token
            ])->execute();
            return $token;
            // $user = Usuario::select()->where('email',$email)->one();
            // return $user->email;
        } catch (\Exception $e) {
            return "Erro ao inserir os dados: " . $e->getMessage();
        }
    }
    
}