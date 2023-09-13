<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandlers;

class LoginController extends Controller {
    
    public function signin() {
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signin', ['flash' => $flash]);
    }
    public function login() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password){
            $token = LoginHandlers::verifyLogin($email, $password);
            if($token){ 
                $_SESSION['token'] = $token;
                $this->redirect('/');
            }else{
                $_SESSION['flash'] = 'E-mail e/ou senha não conferem!';
                $this->redirect('/login');
            } 

        }else{
            $_SESSION['flash'] = 'Digite os campos de email e/ou senha!';
            $this->redirect('/login');
        }
    }
    public function signup() {
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signup', ['flash' => $flash]);
    }
    public function cadastro() {
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $nascimento = filter_input(INPUT_POST, 'nascimento');

        if($email && $nome && $password && $nascimento){
            $nascimento = explode('/', $nascimento);
            if(count($nascimento) != 3 || strtotime($nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0]) == false){
                $_SESSION['flash'] = 'Data de nascimento inválida!';
                $this->redirect('/cadastro');
            }
            if(!LoginHandlers::emailExists($email)){
                $_SESSION['token'] = LoginHandlers::insertUser($email, $nome, $password, $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0]);
                $this->redirect('/');
            }else{
                $_SESSION['flash'] = 'E-mail já cadastrado!';
            }
        }else{
            $_SESSION['flash'] = 'Todos os campos devem ser preenchidos!';
            $this->redirect('/cadastro');
        }
    }
}