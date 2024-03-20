<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Block\Product\ProductsList;

use Magento\CatalogWidget\Block\Product\ProductsList;
use DoctorDogg\RewardPoints\Model\Js\DataMageInitBlockProvider;

/**
 * The plugin adds a js to the page that will process the user's clicks on the product attributes
 * on the product cards and save the clicked options in localStorage
 * as well as show the number of bonus points on the card for the configurable product.
 */
class Plugin
{
    /**
     * @var DataMageInitBlockProvider
     */
    private $dataMageInitBlockProvider;

    /**
     * @param DataMageInitBlockProvider $dataMageInitBlockProvider
     */
    public function __construct(
        DataMageInitBlockProvider $dataMageInitBlockProvider
    ) {
        $this->dataMageInitBlockProvider = $dataMageInitBlockProvider;
    }

    /**
     * Plugin method.
     *
     * @param ProductsList $subject
     * @param string $result
     * @return string
     */
    public function afterGetPagerHtml(
        ProductsList $subject,
        string $result
    ) {
        return $result . $this->dataMageInitBlockProvider->getDataMageInitBlock();
    }
}
