<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\BaseController;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Blog/Post');
    }

}
