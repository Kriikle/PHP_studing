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
        $msg = [
            'user' => NULL,
            'msg_error_login' => NULL,
            'msg_error_register' => NULL
        ];
        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['password2']) &&
            isset($_POST['login']) &&
            isset($_POST['city'])
        ) {
            $email = (string) $_POST['email'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $msg['msg_error_register'] = 'Email указан не верно';

                return $this->view->render('main.phtml',$msg);
            }

            if ($_POST['password'] !== $_POST['password2']){
                $msg['msg_error_register'] = 'Password1 and Password2 not confirmed';

                return $this->view->render('main.phtml',$msg);
            }
            $password = $_POST['password'];
            $login = htmlspecialchars($_POST['login']);
            $city = htmlspecialchars($_POST['city']);

        } else {

            $msg['msg_error_register'] = 'Заполните поля';

            return $this->view->render('main.phtml',$msg);
        }
        if (User::getByEmail($email) != NULL){
            $msg['msg_error_register'] = 'email  уже занят';

            return $this->view->render('main.phtml',$msg);
        }

        $user = new User($email,$login,$password,$city);
        $user->save();
        $this->session->authUser(session_id(),$user->getId());
        $this->redirect('/');
    }

    public function login()
    {
        $msg = [
            'user' => NULL,
            'msg_error_login' => NULL,
            'msg_error_register' => NULL
        ];

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = (string) $_POST['email'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $msg['msg_error_login'] = 'Email указан не верно';

                return $this->view->render('main.phtml',$msg);
            }
            $password = $_POST['password'];
        } else {
            $msg['msg_error_login'] = 'Заполните поля';

            return $this->view->render('main.phtml',$msg);
        }
        $user = User::getByEmail($_POST['email']);

        if ($user == NULL){

            $msg['msg_error_login'] = 'Логин или пароль неверный';

            return $this->view->render('main.phtml',$msg);
        }

        if (password_verify($password, $user->getPassword())) {
            $this->session->authUser(session_id(),$user->getId());
            $this->redirect('/');
        } else {

            $msg['msg_error_login'] = 'Логин или пароль неверный';

            return $this->view->render('main.phtml',$msg);
        }
    }

    public function logout()
    {
        $this->session->logout();
        $this->redirect('/');
    }
}