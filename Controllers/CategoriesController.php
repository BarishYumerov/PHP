<?php

namespace Controllers;

use Repositories\CategoriesRepository;
use Models\Category;

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
            $category = new Category($_POST['categoryName'], $this->parameters[0]);
            CategoriesRepository::create()->edit($category);
        }
    }
}