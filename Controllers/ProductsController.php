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
            var_dump($product);
            ProductRepository::create()->add($product);
            $this->redirect('home', 'userHome');

        }
    }

    public function edit(){
        $_SESSION['categories'] = CategoriesRepository::create()->getAll();
        $_SESSION['product'] = ProductRepository::create()->getProduct($this->parameters[0]);

        if($_SESSION['userId'] != $_SESSION['product']['editorId']){
            echo 'You are not the editor of the product!';
            die;
        }

        if(isset($_POST['edit'])){

            $name = $_POST['name'];
            $price = floatval($_POST['price']);
            $quantity = floatval($_POST['quantity']);
            $categoryId = intval($_POST['category']);
            $editorID = intval($_SESSION['userId']);
            $id = $_SESSION['product']['id'];
            $this->checkIfExist($name);
            $product = new Product($name, $categoryId, $price, $quantity, $editorID, $id);
            ProductRepository::create()->edit($product);

            $this->redirect('home', 'userHome');
        }
    }

    public function myProducts(){
        $_SESSION['products'] = ProductRepository::create()->getMyProducts($_SESSION['userId']);
        $_SESSION['categories'] = CategoriesRepository::create()->getAll();
        if(isset($_POST['edit'])){
            reset($_POST);
            $productId = key($_POST);
            $this->redirect('products', 'edit', [$productId]);
        }

        if(isset($_POST['delete'])){
            reset($_POST);
            $productId = key($_POST);
            ProductRepository::create()->delete($productId);
            header('Refresh:0');
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