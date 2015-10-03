<?php

namespace Controllers;

use Repositories\CartRepository;

class CartController extends BaseController
{
    protected function onLoad(){
        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }
    }

    public function manage(){
        $_SESSION['userCart'] = CartRepository::create()->getUserCard($_SESSION['userId']);
        $this->view->partial('authHeader');
    }
}