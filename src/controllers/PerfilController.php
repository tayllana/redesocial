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

        $seguindo = false;
        if($usuario->id != $this->loggedUser['id']){
            $seguindo = UserHandlers::isFollowing($this->loggedUser['id'], $usuario->id);
        }
        $this->render('perfil', [
            'loggedUser' => $this->loggedUser,
            'usuario' => $usuario,
            'feed' => $feed,
            'seguindo' => $seguindo
        ]);
    }
    public function follow($atts) {
        $to = intval($atts['id']);
        if(UserHandlers::idExists($to)){
            if(UserHandlers::isFollowing($this->loggedUser['id'], $to)){
                UserHandlers::unfollow($this->loggedUser['id'], $to);    
            }else{
                UserHandlers::follow($this->loggedUser['id'], $to);    
            }
        }
        $this->redirect("/perfil/$to");
    }

    public function friends($atts = []) {
        $id = !empty($atts['id'])? $atts['id']: $this->loggedUser['id'];
        $usuario = UserHandlers::getUsuario($id);
        if(!$usuario){
            $this->redirect('/');
        } 
        $seguindo = false;
        if($usuario->id != $this->loggedUser['id']){
            $seguindo = UserHandlers::isFollowing($this->loggedUser['id'], $usuario->id);
        }
        $this->render('perfil_amigos', [
            'loggedUser' => $this->loggedUser,
            'usuario' => $usuario,
            'seguindo' => $seguindo
        ]);
    }

}