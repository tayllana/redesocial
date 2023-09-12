<?php
namespace src\handlers;
use \src\models\Usuario;

class LoginHandlers {

    public static function checkLogin(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];
            $_SESSION['usuario'] = Usuario::select()->where('token',$token)->one();
            if($_SESSION['usuario'] <= 0){
                $_SESSION['usuario'] = false;
            }
            // $data = Usuario::select()->where('token',$token)->one();
            // if(count($data)>0){
            //     $_SESSION['usuario'] = new Usuario; 
            //     $_SESSION['usuario']->id = $data['id']; 
            //     $_SESSION['usuario']->email = $data['email']; 
            //     $_SESSION['usuario']->nome = $data['nome'];
            // }else{
            //     $_SESSION['usuario'] = false;
            // }
        }else{
            $_SESSION['usuario'] = false;
        }    
    }
    
}