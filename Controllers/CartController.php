<?php

namespace Controllers;

use Repositories\CartRepository;
use Repositories\CategoriesRepository;

class CartController extends BaseController
{
    protected function onLoad(){
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
        if(isset($_POST['checkout'])){
            CartRepository::create()->checkout();
            $this->redirect('cart', 'manage');
        }
    }
}