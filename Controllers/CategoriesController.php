<?php

namespace Controllers;

use Repositories\CategoriesRepository;
use Models\Category;

class CategoriesController extends BaseController
{
    protected function onLoad(){
        $token = time();
        $_SESSION['token'] = $token;
        echo '<form method="post"><input id="token" type="hidden" name="token" value="' . $token . '"></form>';

        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }

        if($_SESSION['roleId'] < 2){
            $this->redirect('users', 'usersHome');
        }
    }

    function edit(){
        $this->checkToken();
        if(isset($_POST['changeName'])){
            if($_POST['categoryName'] == null){
                echo 'Enter name!';
                die;
            }
            $category = new Category($_POST['categoryName'], $this->parameters[0]);
            CategoriesRepository::create()->edit($category);
            $this->redirect('home', 'userHome');

        }
    }

    function add(){
        $this->checkToken();
        if(isset($_POST['add'])){
            if($_POST['categoryName'] == null){
                echo 'Enter name!';
                die;
            }

            $category = new Category($_POST['categoryName']);
            CategoriesRepository::create()->add($category);
            $this->redirect('home', 'userHome');
        }
    }
}