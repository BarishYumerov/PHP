<?php

namespace Controllers;

use Repositories\CartRepository;
use Repositories\CategoriesRepository;

class CartController extends BaseController
{
    protected function onLoad(){
        $token = time();
        $_SESSION['token'] = $token;
        echo '<form method="post"><input id="token" type="hidden" name="token" value="' . $token . '"></form>';

        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }
        if($_SESSION['roleId'] == 1){
            $this->view->partial('authHeader');
        }
        if($_SESSION['roleId'] == 2){
            $this->view->partial('editorHeader');
        }
        if($_SESSION['roleId'] == 3){
            $this->view->partial('editorHeader');
        }
    }

    public function manage(){
        $_SESSION['userCart'] = CartRepository::create()->getUserCard($_SESSION['userId']);
        $this->checkToken();
        if(isset($_POST['checkout'])){
            CartRepository::create()->checkout();
            $this->redirect('cart', 'manage');
        }

        if(isset($_POST['empty'])){
            CartRepository::create()->emptyCart();
            $this->redirect('cart', 'manage');
        }

        if(isset($_POST['remove'])){
            CartRepository::create()->remove();
            $this->redirect('cart', 'manage');
        }
    }
}