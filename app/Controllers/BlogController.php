<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\BlogPost;

class BlogController extends Controller
{
    private BlogPost $model;

    public function __construct()
    {
        $this->model = new BlogPost();
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
        $post = $this->model->getByID($id)[0];
        $this->view('blog/posts', ['title' => 'János\' blog', 'post' => $post]);
    }

    // TODO: Get post by id
}