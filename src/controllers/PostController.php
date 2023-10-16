<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandlers;
use \src\handlers\PostHandlers;

class PostController extends Controller {
    private $loggedUser; 

    public function __construct(){
        LoginHandlers::checkLogin();
        $this->loggedUser = $_SESSION['usuario'];
        if(!$this->loggedUser){
            $this->redirect('/login');
        }
    }
    public function new() {
        $body = filter_input(INPUT_POST, 'body');
        if($body){
            PostHandlers::addPost(
                $this->loggedUser['id'], 
                'text',
                $body
            );
        }
        $this->redirect('/');
    }

}