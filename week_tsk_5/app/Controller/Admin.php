<?php

namespace App\Controller;

use App\Model\Blog;
use App\Model\User;

class Admin extends AbstractController
{
    public function index(): string
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');
        $user = $this->getUser();
        $posts = NULL;
        $users = NULL;

        if ($user->isAdmin()) {
            $users = User::all();

        }

        return $template->render(['user_auth' => $user,'active_page' => 'admin','users' => $users]);
    }

    public function registerUser()
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('main.html');
        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['login'])
        ) {
            $email = (string) $_POST['email'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){

                return $template->render(['active_page' => 'main','msg_error_register' => 'Email указан не верно']);
            }

            $password = $_POST['password'];
            $login = htmlspecialchars($_POST['login']);

        } else {


            return $template->render([
                'active_page' => 'main',
                'msg_error_register' => 'Заполните поля'
            ]);
        }

        if (User::where('email', 'like', $email)->first() != NULL){
            //var_dump($user);
            return $template->render([
                'active_page' => 'main',
                'msg_error_register' => 'email  уже занят'
            ]);
        }
        $user = User::Create([
            'login' => $login,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        $user->save();
        $this->session->authUser(session_id(),$user->id);
        $this->redirect('/');
    }
}