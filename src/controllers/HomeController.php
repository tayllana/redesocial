<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandlers;

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
        $this->render('home', ['nome' => 'Bonieky']);
    }

}