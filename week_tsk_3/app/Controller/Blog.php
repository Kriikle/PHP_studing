<?php

namespace App\Controller;

use App\Model\Message;

class Blog extends AbstractController
{
    public function index(): string
    {

        if ($this->getUser() != NULL) {
            $arr = [
                'user' => $this->getUser(),
                'posts' => Message::getAll(),
                'msg_error_post_form' => NULL,
            ];
        } else {
            $arr = [
                'user' => $this->getUser(),
                'posts' => NULL,
                'msg_error_post_form' => NULL,
            ];
        }

        return $this->view->render('blog.phtml',$arr);
    }

    public function addPost(): void
    {
        if (isset($_POST['name']) && isset($_POST['text']) && isset($_POST['image'])) {
            $name = (string) $_POST['name'];
            $text = (string) $_POST['text'];
            $image =  $_POST['image'];
        }
        $user = $this->getUser();
        $blogNew = new Message($user->getId(), $name, $text);
        $blogNew->save();
        $this->redirect('/blog');
    }
}