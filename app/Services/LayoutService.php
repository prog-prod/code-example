<?php

namespace App\Services;

use App\Contracts\LayoutRepositoryInterface;

class LayoutService
{
    /**
     * The layout repository instance.
     *
     * @var LayoutRepositoryInterface
     */
    private LayoutRepositoryInterface $layoutRepository;

    /**
     * Create a new LayoutService instance.
     *
     * @param LayoutRepositoryInterface $layoutRepository The layout repository implementation.
     */
    public function __construct(LayoutRepositoryInterface $layoutRepository)
    {
        $this->layoutRepository = $layoutRepository;
    }

    /**
     * Get the main layout settings.
     *
     * @return mixed
     */
    public function getSettings(): mixed
    {
        return $this->layoutRepository->getMain();
    }
}
