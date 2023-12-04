<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandlers;
use \src\handlers\PostHandlers;

class PerfilController extends Controller {
    private $loggedUser; 

    public function __construct(){
        UserHandlers::checkLogin();
        $this->loggedUser = $_SESSION['usuario'];
        if(!$this->loggedUser){
            $this->redirect('/login');
        }
    }
    public function index($atts = []) {
        $id = !empty($atts['id'])? $atts['id']: $this->loggedUser['id'];
        $usuario = UserHandlers::getUsuario($id);
        if(!$usuario){
            $this->redirect('/');
        } 
        $feed = PostHandlers::getUserFeed($id, intval(filter_input(INPUT_GET, 'pagina')), $this->loggedUser['id']);
        $this->render('perfil', [
            'loggedUser' => $this->loggedUser,
            'usuario' => $usuario,
            'feed' => $feed
        ]);
    }

}