<?php

namespace App\Controllers;

use App\Core\Controller;

class AboutController extends Controller
{
    /**
     * Render the home page 
     *
     * @return void
     */
    public function index(): void 
    {
        $this->view('about/index', ["title" => "About | János Litkei"]);
    }
}
