<?php

namespace Controllers;

use Repositories\UserRepository;

class HomeController extends BaseController
{
    private $loggedUser = null;

    protected function onLoad(){
        $token = time();
        $_SESSION['token'] = $token;
        echo '<form method="post"><input id="token" type="hidden" name="token" value="' . $token . '"></form>';

        $uriParts = explode('/', $_SERVER['REQUEST_URI']);
        $action = $uriParts[count($uriParts) - 1];
        if(!isset($_SESSION['userId']) && $action != 'guestHome'){
            $this->redirect('home', 'guestHome');
            exit;
        }

        if(isset($_SESSION['userId'])){
            if ($this->loggedUser == null ) {
                $this->loggedUser =
                    UserRepository::create()
                        ->getOne($_SESSION['userId']);
            }
        }
    }

    public function userHome(){
        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
            exit;
        }

        if(isset($_POST['logout'])){
            session_destroy();
            $this->redirect('home', 'guestHome');
        }
        $this->view->partial('authHeader');
    }

    public function editorHome(){

        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
            exit;
        }

        if(isset($_POST['logout'])){
            session_destroy();
            $this->redirect('home', 'guestHome');
        }
        $this->view->partial('editorHeader');
    }

    public function guestHome(){
        if(isset($_SESSION['username'])){
            $this->redirect('home', 'userHome');
            exit;
        }
        $this->view->partial('guestHeader');
    }

}