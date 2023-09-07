<?php

namespace App\Services;

use App\Contracts\MenuRepositoryInterface;
use App\DTO\Filter\PriceFilterDTO;
use App\DTO\SiteSettingsDTO;
use App\Enums\SortEnum;
use App\Facades\CartServiceFacade;
use App\Facades\ComparisonsFacade;
use App\Facades\CurrencyFacade;
use App\Facades\LayoutFacade;
use App\Facades\WishlistFacade;
use App\Http\Resources\LayoutResource;
use App\Http\Resources\MenuResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CommonService
{
    /**
     * @var MenuRepositoryInterface
     */
    protected MenuRepositoryInterface $menuRepository;
    protected InstagramService $instagramService;
    protected FacebookService $facebookService;
    protected ViberService $viberService;
    private TelegramService $telegramService;

    /**
     * CommonService constructor.
     *
     */
    public function __construct()
    {
        $this->menuRepository = app(MenuRepositoryInterface::class);
        $this->instagramService = app(InstagramService::class);
        $this->facebookService = app(FacebookService::class);
        $this->viberService = app(ViberService::class);
        $this->telegramService = app(TelegramService::class);
    }

    /**
     * Get the main menu.
     *
     * @return MenuResource|null
     */
    public function getMenu(): ?MenuResource
    {
        $menu = $this->menuRepository->getMainMenu();
        return $menu ? new MenuResource($menu) : null;
    }

    /**
     * Get the site settings.
     *
     * @return SiteSettingsDTO
     */
    public function getSiteSettings(): SiteSettingsDTO
    {
        $minPriceForFilterPriceRange = CurrencyFacade::getMinPriceLimitForFilter();
        $maxPriceForFilterPriceRange = CurrencyFacade::getMaxPriceLimitForFilter();

        return new SiteSettingsDTO(
            locales: LaravelLocalization::getSupportedLanguagesKeys(),
            locale: LaravelLocalization::getCurrentLocale(),
            currencies: CurrencyFacade::getCurrenciesObjects(),
            currency: CurrencyFacade::getCurrency()->value,
            social_networks: $this->getSocialNetworks(),
            sortBy: SortEnum::asObject(),
            filter: new PriceFilterDTO(minPrice: $minPriceForFilterPriceRange, maxPrice: $maxPriceForFilterPriceRange),
            countItemsInCart: CartServiceFacade::countItems(),
            countItemsWishlist: WishlistFacade::getWishlistItemsCount(),
            countItemsComparisons: ComparisonsFacade::getComparisonsItemsCount(),
            layout: new LayoutResource(LayoutFacade::getSettings())
        );
    }

    public function getSocialNetworks(): array
    {
        return [
            'facebook' => $this->facebookService->getParams(),
            'instagram' => $this->instagramService->getParams(),
            'viber' => $this->viberService->getParams(),
            'telegram' => $this->telegramService->getParams()
        ];
    }
}
