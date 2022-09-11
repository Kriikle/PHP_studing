<?php

namespace App\Controller;

use App\Model\User;

class UserController extends AbstractController
{


    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('main.html');

        return $template->render(['user' => $this->getUser(),'active_page' => 'main']);
    }

    public function registerUser()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('main.html');
        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['password2']) &&
            isset($_POST['login']) &&
            isset($_POST['city'])
        ) {
            $email = (string) $_POST['email'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){

                return $template->render(['active_page' => 'main','msg_error_register' => 'Email указан не верно']);
            }

            if ($_POST['password'] !== $_POST['password2']){

                return $template->render([
                    'active_page' => 'main',
                    'msg_error_register' => 'Password1 and Password2 not confirmed'
                ]);
            }
            $password = $_POST['password'];
            $login = htmlspecialchars($_POST['login']);
            $city = htmlspecialchars($_POST['city']);

        } else {


            return $template->render([
                'active_page' => 'main',
                'msg_error_register' => 'Заполните поля'
            ]);
        }
        if (User::getByEmail($email) != NULL){

            return $template->render([
                'active_page' => 'main',
                'msg_error_register' => 'email  уже занят'
            ]);
        }

        $user = new User($email,$login,$password,$city);
        $user->save();
        $this->session->authUser(session_id(),$user->getId());
        $this->redirect('/');
    }

    public function login()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('main.html');

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = (string) $_POST['email'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){

                return $template->render([
                    'active_page' => 'main',
                    'msg_error_login' => 'Email указан не верно'
                ]);
            }
            $password = $_POST['password'];
        } else {

            return $template->render([
                'active_page' => 'main',
                'msg_error_login' => 'Заполните поля'
            ]);
        }
        $user = User::getByEmail($_POST['email']);

        if ($user == NULL){

            return $template->render([
                'active_page' => 'main',
                'msg_error_login' => 'Логин или пароль неверный'
            ]);
        }

        if (password_verify($password, $user->getPassword())) {
            $this->session->authUser(session_id(),$user->getId());
            $this->redirect('/');
        } else {

            return $template->render([
                'active_page' => 'main',
                'msg_error_login' => 'Логин или пароль неверный'
            ]);
        }
    }

    public function logout()
    {
        $this->session->logout();
        $this->redirect('/');
    }
}