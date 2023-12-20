<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandlers;
use \src\handlers\PostHandlers;

class SearchController extends Controller {
    private $loggedUser; 

    public function __construct(){
        UserHandlers::checkLogin();
        $this->loggedUser = $_SESSION['usuario'];
        if(!$this->loggedUser){
            $this->redirect('/login');
        }
    }
    public function index($atts = []) {
        $searchStr = filter_input(INPUT_GET, 's');
        if(empty($searchStr)){
            $this->redirect('/');
        } 
        $usuarios = UserHandlers::searchUser($searchStr);
        $this->render('search', [
            'loggedUser' => $this->loggedUser,
            'searchStr' => $searchStr,
            'usuarios' => $usuarios
        ]);
    }
}