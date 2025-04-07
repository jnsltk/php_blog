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
        $posts = $this->model->getAllPosts();
        $this->view('blog/index', ['title' => 'János\' blog', 'posts' => $posts]);
    }

    // TODO: Get post by id
}