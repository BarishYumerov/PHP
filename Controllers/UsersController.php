<?php

namespace Controllers;

use Models\User;
use Repositories\CartRepository;
use Repositories\UserRepository;

class UsersController extends BaseController
{
    protected function onLoad(){

        $token = time();
        $_SESSION['token'] = $token;
        echo '<form method="post"><input id="token" type="hidden" name="token" value="' . $token . '"></form>';

        if(isset($_SESSION['username'])){
            if($_SESSION['roleId'] == 1){
                $this->redirect('home', 'userHome');
            }
            if($_SESSION['roleId'] == 2){
                $this->redirect('home', 'editorHome');
            }
            if($_SESSION['roleId'] == 3){
                $this->redirect('home', 'editorHome');
            }
            exit;
        }
    }
    public function register(){

        if(isset($_POST['login'])){
            $this->redirect('users', 'login');
            exit;
        }

        if(isset($_POST['register'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

            if($username == null){
                echo 'Enter Valid Username!';
                die;
            }

            if($email == null){
                echo 'Enter email!';
                die;
            }

            if($password == null){
                echo 'Enter password!';
                die;
            }

            if($confirm == null){
                echo 'Confirm password!';
                die;
            }

            if($_POST['password'] != $_POST['confirm']){
                echo 'Confirm password and password are not the same!';
                die;
            }

            $user = new User($username, $password, $email);
            $user->save();
            $userInstance = UserRepository::create()->getByName($username);
            $newUserId = intval($userInstance['id']);
            var_dump($userInstance);
            if($userInstance){
                CartRepository::create()->newCart($newUserId);
            }
            $this->redirect('users', 'login');
        }
    }

    public function login(){

        if(isset($_POST['register'])){
            $this->redirect('users', 'register');
            exit;
        }

        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $passwordHash = md5($_POST['password']);

            $info = UserRepository::create()->loginCheck($username, $passwordHash);

            if($info){
                $_SESSION['userId'] = $info['id'];
                $_SESSION['username'] = $info['username'];
                $_SESSION['email'] = $info['email'];
                $_SESSION['roleId'] = $info['roleId'];
                $_SESSION['cash'] = $info['cash'];

                $_SESSION['userCart'] = CartRepository::create()->getUserCard($info['id']);
                if($info['roleId'] == 1){
                    $this->redirect('home', 'userHome');
                }

                if($info['roleId'] == 2){
                    $this->redirect('home', 'editorHome');
                }
                $this->redirect('home', 'editorHome');
            }
            echo 'Invalid details';
        }
    }

    public function logout(){
        session_destroy();
        die;
    }

}