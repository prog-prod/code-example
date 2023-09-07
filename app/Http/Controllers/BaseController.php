<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class BaseController extends Controller
{

    protected array $vars = [];
    protected string $template;

    public function __construct()
    {
        $this->vars['error'] = session('error');
    }

    public function showView($template = '', $params = [])
    {
        return Inertia::render($template ?? $this->template, array_merge($this->vars, $params));
    }

}
