<?php


namespace App\Controller;



use App\Model\Blog;
use http\Env\Response;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends AbstractController
{


    public function index(): string
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('blog.html');
        $user = $this->getUser();
        $posts = NULL;

        if ($user!= NULL) {
            $posts = Blog::all();

        }

        return $template->render(['user' => $user,'active_page' => 'blog','posts' => $posts]);
    }

    public function deletePost(): void
    {
        if ($this->getUser()->isAdmin()){
            if (isset($_POST['id_blog'])){
                Blog::where('id',$_POST['id_blog'])->delete();
            }
        }

        $this->redirect('/blogController');
    }

    public function addPost(): string
    {
        $loader = new \Twig\Loader\FilesystemLoader('App\View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('blog.html');
        $posts = NULL;
        $user = $this->getUser();
        if ($user!= NULL) {
            $posts = Blog::all();
        }

        if (isset($_POST['name']) && isset($_POST['text'])) {

            if ($_POST['name'] != "" && $_POST['text'] != "") {
                $name = htmlspecialchars($_POST['name']);
                $text = htmlspecialchars($_POST['text']);
                $image = NULL;
                if (file_exists($_FILES["image"]["tmp_name"])) {
                    // Директория куда будут загружаться файлы.
                    $path = DIRECTORY_SEPARATOR;
                    $path .= '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
                    $path .= 'uploads' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
                    // Проверим директорию для загрузки.

                    if (!is_dir(__DIR__ . $path)) {
                        mkdir(__DIR__ . $path, 0777, true);
                    }

                    $target_file = $path . md5(microtime() . rand(0, 9999)) . ".";
                    $target_file .= basename($_FILES["image"]["type"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Check if image file is a actual image or fake image

                    if (isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["image"]["tmp_name"]);

                        if (!getimagesize($_FILES["image"]["tmp_name"])) {

                            return $template->render([
                                'user' => $user,
                                'active_page' => 'blog',
                                'posts' => $posts,
                                'msg_error_post_form' => "File is not an image."
                            ]);
                        }
                        // Check if file already exists
                        while (file_exists($target_file)) {
                            $target_file = $path . md5(microtime() . rand(0, 9999)) . ".";
                            $target_file .= basename($_FILES["image"]["type"]);
                        }
                        // Check file size
                        if ($_FILES["image"]["size"] > 500000) {

                            return $template->render([
                                'user' => $user,
                                'active_page' => 'blog',
                                'posts' => $posts,
                                'msg_error_post_form' => "Sorry, your file is too large."
                            ]);
                        }
                        move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__ . $target_file);

                        // open an image file
                        $img = Image::make(__DIR__ . $target_file);
                        // now you are able to resize the instance
                        $img->resize(200, 100);
                        // and insert a watermark for example
                        $img->insert(__DIR__ . $path . 'watermark.png');
                        // finally we save the image as a file
                        $img->save(__DIR__ . $target_file);

                        $image = $target_file;
                    }
                }

                $user = $this->getUser();
                $blogNew = new Blog([
                    'name' => $name,
                    'text' => $text,
                    'image' => $image,
                    'user_id' => $user->id
                ]);
                $blogNew->save();
                $this->redirect('/blogController');
            } else {

                return $template->render([
                    'user' => $user,
                    'active_page' => 'blog',
                    'posts' => $posts,
                    'msg_error_post_form' => 'Заполните поля'
                ]);
            }
        }

        return $template->render([
            'user' => $user,
            'active_page' => 'blog',
            'posts' => $posts,
            'msg_error_post_form' => 'Ошибка добавления'
        ]);
    }

    //http://localhost/blog/getMsgByUser?user_id=61
    public function getMsgByUser()
    {
        if (isset($_GET['user_id'])){
            header('Content-Type: application/json; charset=utf-8');
            $data = ['response' => "HTTP/1.1 200 success"];
            $data[] = Blog::getMsgByUser(intval($_GET['user_id']));
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