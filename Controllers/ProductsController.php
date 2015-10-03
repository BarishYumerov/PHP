<?php

namespace Controllers;

use Models\Order;
use Repositories\CartRepository;
use Repositories\CategoriesRepository;
use Repositories\ProductRepository;
use Models\Product;

class ProductsController extends BaseController
{
    private $productRepository;

    protected function onLoad(){
        if(!isset($_SESSION['username'])){
            $this->redirect('users', 'login');
        }
        $this->productRepository = ProductRepository::create();
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

    public function available(){
        $_SESSION['products'] = $this->productRepository->available();
        if(isset($_POST['buy'])){
            $productId = intval(array_shift($_POST));
            $this->redirect('products', 'buy', [$productId]);
        }
    }

    public function category(){
        $_SESSION['products'] = [];
        $_SESSION['categories'] = CategoriesRepository::create()->getAll();

        if(count($this->parameters) > 0){
            $_SESSION['products'] = $this->productRepository->categoryList($this->parameters[0]);
        }

        if(isset($_POST['search'])){
            $categoryId = intval($_POST['category']);
            if($categoryId == -1){
                $this->redirect('products', 'category');
            }
            $this->redirect('products', 'category', [$categoryId]);
        }

        if(isset($_POST['buy'])){
            $productId = intval(array_shift($_POST));
            $this->redirect('products', 'buy', [$productId]);
        }
    }

    public function add(){
        if($_SESSION['roleId'] < 2){
            $this->redirect('users', 'usersHome');
        }
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
            $this->redirect('home', 'editorHome');

        }
    }

    public function edit(){
        if($_SESSION['roleId'] < 2){
            $this->redirect('users', 'usersHome');
        }
        $_SESSION['categories'] = CategoriesRepository::create()->getAll();
        $_SESSION['product'] = $this->productRepository->getProduct($this->parameters[0]);

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
            $product = new Product($name, $categoryId, $price, $quantity, $editorID, $id);
            ProductRepository::create()->edit($product);

            $this->redirect('home', 'editorHome');
        }
    }

    public function myProducts(){
        $_SESSION['products'] = $this->productRepository->getMyProducts($_SESSION['userId']);
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

    public function buy(){
        $product = $this->productRepository->getProduct($this->parameters[0]);
        $_SESSION['product'] = $product;
        $cart = CartRepository::create()->getUserCard($_SESSION['userId']);
        if(isset($_POST['buy'])){
            $quantity = floatval($_POST['quantity']);
            $price = floatval($product['price']);
            if($quantity < 1){
                echo 'Invalid quantity!';
                die;
            }
            if($quantity > $product['quantity']){
                echo 'Do not have enough available quantities!';
                die;
            }

            if($quantity * floatval($product['price']) + floatval($cart['value']) > $_SESSION['cash']){
                echo 'You will not have enough money to checkout the cart remove some products!';
                die;
            }
            $order = new Order(intval($product['id']), intval($cart[0]), $quantity, $price);
            $this->productRepository->buy($order);
            $this->redirect('products', 'category');
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