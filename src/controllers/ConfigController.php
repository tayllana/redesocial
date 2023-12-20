<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandlers;

class ConfigController extends Controller {

    private $loggedUser;

    public function __construct(){
        UserHandlers::checkLogin();
        $this->loggedUser = $_SESSION['usuario'];
        if(!$this->loggedUser){
            $this->redirect('/login');
        }
    }

    public function index() {
        $usuario = UserHandlers::getUsuario($this->loggedUser['id']);

        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('configuracoes', [
            'loggedUser' => $this->loggedUser,
            'usuario' => $usuario,
            'flash' => $flash
        ]);
    }

    public function save() {
        $nome = filter_input(INPUT_POST, 'nome');
        $aniversario = filter_input(INPUT_POST, 'aniversario');
        $email = filter_input(INPUT_POST, 'email');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $emprego = filter_input(INPUT_POST, 'emprego');
        $senha = filter_input(INPUT_POST, 'senha');
        $senhaConfirm = filter_input(INPUT_POST, 'senhaConfirm');

        if($nome && $email) {
            $inputs = [];
            $usuario = UserHandlers::getUsuario($this->loggedUser['id']);

            // E-MAIL
            if($usuario->email != $email) {
                if(!UserHandlers::emailExists($email)) {
                    $inputs['email'] = $email;
                } else {
                    $_SESSION['flash'] = 'E-mail já existe!';
                    $this->redirect('/configuracoes');
                }
            }

            // BIRTHDATE
            $aniversario = explode('/', $aniversario);
            if(count($aniversario) != 3) {
                $_SESSION['flash'] = 'Data de nascimento inválida!';
                $this->redirect('/configuracoes');
            }
            $aniversario = $aniversario[2].'-'.$aniversario[1].'-'.$aniversario[0];
            if(strtotime($aniversario) === false) {
                $_SESSION['flash'] = 'Data de nascimento inválida!';
                $this->redirect('/configuracoes');
            }
            $inputs['aniversario'] = $aniversario;

            // PASSWORD
            if(!empty($senha)) {
                if($senha === $senhaConfirm) {
                    $inputs['senha'] = $senha;
                } else {
                    $_SESSION['flash'] = 'As senhas não batem.';
                    $this->redirect('/configuracoes');
                }
            }
            $inputs['nome'] = $nome;
            $inputs['cidade'] = $cidade;
            $inputs['emprego'] = $emprego;

            // // AVATAR
            // if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['tmp_name'])) {
            //     $newAvatar = $_FILES['avatar'];

            //     if(in_array($newAvatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            //         $avatarName = $this->cutImage($newAvatar, 200, 200, 'media/avatars');
            //         $inputs['avatar'] = $avatarName;
            //     }
            // }

            // // COVER
            // if(isset($_FILES['cover']) && !empty($_FILES['cover']['tmp_name'])) {
            //     $newCover = $_FILES['cover'];

            //     if(in_array($newCover['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            //         $coverName = $this->cutImage($newCover, 850, 310, 'media/covers');
            //         $inputs['cover'] = $coverName;
            //     }
            // }

            UserHandlers::updateUser($inputs, $this->loggedUser['id']);

        }
        
        $this->redirect('/configuracoes');
    }

    private function cutImage($file, $w, $h, $folder) {
        list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
        $ratio = $widthOrig / $heightOrig;

        $newWidth = $w;
        $newHeight = $newWidth / $ratio;

        if($newHeight < $h) {
            $newHeight = $h;
            $newWidth = $newHeight * $ratio;
        }

        $x = $w - $newWidth;
        $y = $h - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;

        $finalImage = imagecreatetruecolor($w, $h);
        switch($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
            break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
            break;
        }

        imagecopyresampled(
            $finalImage, $image,
            $x, $y, 0, 0,
            $newWidth, $newHeight, $widthOrig, $heightOrig
        );

        $fileName = md5(time().rand(0,9999)).'.jpg';

        imagejpeg($finalImage, $folder.'/'.$fileName);

        return $fileName;
    }

}