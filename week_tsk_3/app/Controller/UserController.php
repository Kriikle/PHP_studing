<?php

namespace App\Controller;

use App\Model\User;

class UserController extends AbstractController
{
    public function index()
    {
        return $this->view->render('main.phtml',[
            'user' => $this->getUser(),
            'msg_error_login' => NULL,
            'msg_error_register' => NULL,
        ]);
    }

    public function registerUser()
    {
        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['password2']) &&
            isset($_POST['login']) &&
            isset($_POST['city'])
        ) {
            $email = (string) $_POST['email'];
            if ($_POST['password'] !== $_POST['password2']){
                return $this->view->render('main.phtml',[
                    'user' => $this->getUser(),
                    'msg_error_login' => NULL,
                    'msg_error_register' => 'Password1 and Password2 not confirmed',
                ]);
            }
            $password = $_POST['password'];
            $login = $_POST['login'];
            $city = $_POST['city'];

        } else {

            return $this->view->render(
                'main.phtml',
                [
                    'user' => $this->getUser(),
                    'msg_error_login' => NULL,
                    'msg_error_register' => 'Заполните поля',
                ]
            );
        }
        if (User::getByEmail($email) != NULL){

                return $this->view->render('main.phtml',
                    [
                    'user' => $this->getUser(),
                    'msg_error_login' => NULL,
                    'msg_error_register' => 'email  уже занят'
                        ]
                );
        }

        $user = new User($email,$login,$password,$city);
        $user->save();
        $this->session->authUser(session_id(),$user->getId());
        $this->redirect('/');
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = (string) $_POST['email'];
            $password = $_POST['password'];
        } else {

            return $this->view->render(
                'main.phtml',
                [
                    'user' => $this->getUser(),
                    'msg_error_login' => 'Заполните поля',
                    'msg_error_register' => NULL,
                ]
            );
        }
        $user = User::getByEmail($_POST['email']);

        if ($user == NULL){

            return $this->view->render(
                'main.phtml',
                [
                    'user' => $this->getUser(),
                    'msg_error_login' => 'Логин или пароль неверный',
                    'msg_error_register' => NULL,
                    ]
            );
        }

        if (password_verify($password, $user->getPassword())) {
            $this->session->authUser(session_id(),$user->getId());
            $this->redirect('/');
        } else {

            return $this->view->render(
                'main.phtml',
                [
                    'user' => $this->getUser(),
                    'msg_error_login' => 'Логин или пароль неверный',
                    'msg_error_register' => NULL,
                ]
            );
        }
    }

    public function logout()
    {
        $this->session->logout();
        $this->redirect('/');
    }
}