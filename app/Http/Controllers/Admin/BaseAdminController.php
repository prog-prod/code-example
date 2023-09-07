<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\ProductTrait;
use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    use ProductTrait;
}
