<?php

namespace Controllers;

use Repositories\CategoriesRepository;
use Repositories\ProductRepository;
use Models\Product;

class ProductsController extends BaseController
{
    protected function onLoad(){
        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }

        if($_SESSION['roleId'] < 2){
            $this->redirect('users', 'usersHome');
        }
    }

    public function add(){
        $_SESSION['categories'] = CategoriesRepository::create()->getAll();
        if(isset($_POST['create'])){
            $name = $_POST['name'];
            $price = floatval($_POST['price']);
            $quantity = floatval($_POST['quantity']);
            $categoryId = intval($_POST['category']);
            $editorID = intval($_SESSION['userId']);

            $this->checkIfExist($name);
            $product = new Product($name, $categoryId, $price, $quantity, $editorID);
            echo 'awiodjawijd';
            var_dump($product);
            ProductRepository::create()->add($product);
        }
    }

    public function checkIfExist($name){
        $products = ProductRepository::create()->getAll();
        foreach($products as $key => $value){
            if($value['name'] === $name){
                echo 'Product with this name exists!';
                die;
            }
        }
    }
}