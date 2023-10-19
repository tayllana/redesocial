<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandlers;
use \src\handlers\PostHandlers;

class HomeController extends Controller {
    private $loggedUser; 

    public function __construct(){
        LoginHandlers::checkLogin();
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