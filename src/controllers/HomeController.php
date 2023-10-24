<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandlers;
use \src\handlers\PostHandlers;

class HomeController extends Controller {
    private $loggedUser; 

    public function __construct(){
        UserHandlers::checkLogin();
        $this->loggedUser = $_SESSION['usuario'];
        if(!$this->loggedUser){
            $this->redirect('/login');
        }
    }
    public function index() {
        $pagina = intval(filter_input(INPUT_GET, 'pagina'));
        $feed = PostHandlers::getHomeFeed($this->loggedUser['id'], $pagina);
        $this->render('home', [
            'loggedUser' => $this->loggedUser,
            'feed' => $feed
        ]);
    }

}