<?php

namespace App\Controller;

use App\Model\Message;
use http\Env\Response;

class Blog extends AbstractController
{


    public function index(): string
    {
        $msg = [
            'user' => NULL,
            'posts' => NULL,
            'msg_error_post_form' => NULL,
        ];

        $user = $this->getUser();

        if ($user!= NULL) {
            $msg['user'] = $user;
            $msg['posts'] = Message::getAll();
        }

        return $this->view->render('blog.phtml', $msg);
    }

    public function deletePost(): void
    {
        if ($this->getUser()->isAdmin()){
            if (isset($_POST['id_blog'])){
                Message::deleteMsg($_POST['id_blog']);
            }
        }
        $this->redirect('/blog');
    }

    public function addPost(): string
    {
        $msg = [
            'user' => $this->getUser(),
            'posts' => Message::getAll(),
            'msg_error_post_form' => NULL,
        ];

        if (isset($_POST['name']) && isset($_POST['text'])) {

            if ($_POST['name'] != "" && $_POST['text'] != "") {
                $name = htmlspecialchars($_POST['name']);
                $text = htmlspecialchars($_POST['text']);
                $image = NULL;
                // Директория куда будут загружаться файлы.
                $path = DIRECTORY_SEPARATOR;
                $path .='..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR ;
                $path .= 'uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
                // Проверим директорию для загрузки.
                if (!is_dir(__DIR__ . $path)) {
                    mkdir(__DIR__ . $path, 0777, true);
                }

                $target_file = $path . md5(microtime() . rand(0, 9999)) . "." ;
                $target_file .= basename($_FILES["image"]["type"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);

                    if(!getimagesize($_FILES["image"]["tmp_name"])) {
                        $msg['msg_error_post_form'] =  "File is not an image.";

                        return $this->view->render('blog.phtml', $msg);
                    }
                    // Check if file already exists
                    while (file_exists($target_file)) {
                        $target_file = $path . md5(microtime() . rand(0, 9999)) . ".";
                        $target_file .= basename($_FILES["image"]["type"]);
                    }
                    // Check file size
                    if ($_FILES["image"]["size"] > 500000) {
                        $msg['msg_error_post_form'] =  "Sorry, your file is too large.";

                        return $this->view->render('blog.phtml', $msg);
                    }
                    move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . $target_file);
                    $image = $target_file;
                }

                $user = $this->getUser();
                $blogNew = new Message($user->getId(), $name, $text, $image);
                $blogNew->save();
                $this->redirect('/blog');
            } else {
                $msg['msg_error_post_form'] = 'Заполните поля';

                return $this->view->render('blog.phtml', $msg);
            }
        }
        $msg['msg_error_post_form'] = 'Ошибка добавления';

        return $this->view->render('blog.phtml', $msg);
    }

    //http://localhost/blog/getMsgByUser?user_id=61
    public function getMsgByUser()
    {
        if (isset($_GET['user_id'])){
            header('Content-Type: application/json; charset=utf-8');
            $data = ['response' => "HTTP/1.1 200 success"];
            $data[] = Message::getMsgByUser(intval($_GET['user_id']));
            json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
            print_r($data);
        }
        //?user_id=61
        else {
            $data = ['response' => "HTTP/1.1 550 user_id not implemented"];/** whatever you're serializing **/;
            //header('Content-Type: application/json; charset=utf-8');
            header('Content-Type: application/json; charset=utf-8');
            print_r(json_encode($data,JSON_PRETTY_PRINT));
        }
    }
}