<?php

namespace Controllers;


class CartController extends BaseController
{
    protected function onLoad(){
        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }
    }

    public function manage(){

        $this->view->partial('authHeader');
    }
}