<?php
namespace src\controllers;

use \core\Controller;

class LoginController extends Controller {
    
    public function singin() {
        $this->render('login');
    }
    public function signup() {
        $this->render('home', ['nome' => 'Bonieky']);
    }


}