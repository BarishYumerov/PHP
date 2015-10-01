<?php

namespace Controllers;

use Repositories\CategoriesRepository;

class CategoriesController extends BaseController
{
    protected function onLoad(){
        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }

        if($_SESSION['roleId'] < 2){
            $this->redirect('users', 'usersHome');
        }
    }

    function edit(){
        if(isset($_POST['changeName'])){
            if($_POST['categoryName'] == null){
                echo 'Enter name!';
                die;
            }

            CategoriesRepository::create()->edit($this->parameters[0], $_POST['categoryName']);
        }
    }
}