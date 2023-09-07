<?php

namespace App\Http\Controllers\About;

use App\Contracts\PageRepositoryInterface;
use App\Http\Controllers\BaseController;
use App\Http\Resources\PageResource;

class AboutController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PageRepositoryInterface $pageRepository)
    {
        $pageSettings = $pageRepository->getAboutPage();
        return $this->showView('About', [
            'page' => $pageSettings ? new PageResource($pageSettings) : null,
        ]);
    }

}
