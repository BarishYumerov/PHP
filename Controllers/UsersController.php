<?php

namespace Controllers;

use Models\User;
use Repositories\UserRepository;

class UsersController extends BaseController
{
    protected function onLoad(){
        if(isset($_SESSION['username'])){
            $this->redirect('home', 'userHome');
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
                exit;
            }

            if($email == null){
                echo 'Enter email!';
                exit;
            }

            if($password == null){
                echo 'Enter password!';
                exit;
            }

            if($confirm == null){
                echo 'Confirm password!';
                exit;
            }

            if($_POST['password'] != $_POST['confirm']){
                echo 'Confirm password and password are not the same!';
                exit;
            }

            $user = new User($username, $password, $email);

            $user->save();
            echo 'registered!!';
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

                $this->redirect('home', 'userHome');
            }
            echo 'Invalid details';
        }
    }

    public function logout(){
        session_destroy();
        die;
    }

}