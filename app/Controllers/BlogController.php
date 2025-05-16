<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\BlogPost;

class BlogController extends Controller
{
    private BlogPost $model;

    public function __construct(Database $db)
    {
        $this->model = new BlogPost($db);
    }

    // Render the default page 
    public function index()
    {
        $posts = $this->model->getAll();
        $this->view('blog/index', ['title' => 'Home | János\' blog', 'posts' => $posts]);
    }

    // Render individual post
    public function posts(string $id)
    {
        $post = $this->model->getByID($id);
        $this->view('blog/posts', ['title' => 'János\' blog', 'post' => $post]);
    }

    // TODO: Get post by id
}
