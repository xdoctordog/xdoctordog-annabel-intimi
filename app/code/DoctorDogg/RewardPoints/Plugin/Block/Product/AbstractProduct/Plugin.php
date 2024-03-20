<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Block\Product\AbstractProduct;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Model\Product\Type as ProductType;
use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableType;
use Magento\Downloadable\Model\Product\Type as DownloadableProductType;
use Magento\Framework\View\Asset\Repository as AssetRepository;

/**
 * A plugin that adds information about how many bonus points you can get if you buy this product
 * to the block with the output of a product review.
 * The plugin is used for example on the category view page /mens.html
 */
class Plugin
{
    /**
     * @var AssetRepository
     */
    private $assetRepo;

    /**
     * @param AssetRepository $assetRepo
     */
    public function __construct(
        AssetRepository $assetRepo
    ) {
        $this->assetRepo = $assetRepo;
    }

    /**
     * @param AbstractProduct $subject
     * @param string $result
     * @param Product $product
     * @param false $templateType
     * @param false $displayIfNoReviews
     * @return string
     */
    public function afterGetReviewsSummaryHtml(
        AbstractProduct $subject,
        string $result,
        Product $product,
        $templateType = false,
        $displayIfNoReviews = false
    ) {
        /**
         * Variable is not used. We have added image using less only
         * @var string
         */
        $url = $this->assetRepo->getUrl('DoctorDogg_RewardPoints::images/coins.png');

        if((ProductType::TYPE_SIMPLE === $product->getTypeId()
             || ProductType::TYPE_VIRTUAL === $product->getTypeId()
             || DownloadableProductType::TYPE_DOWNLOADABLE === $product->getTypeId()
            )
            && $product->getDoctordoggRewardpointsPoints()
        ) {
            $result = $this->getRewardPointsHtml($product->getDoctordoggRewardpointsPoints()) . $result;
        }

        return $result;
    }

    /**
     * Add to the block with the output of the product on the page /men.html a piece of html
     * that will add information about how many bonus points you can get by purchasing this product.
     *
     * @param float|int $points
     * @return string
     */
    public function getRewardPointsHtml($points)
    {
        /**
         * We are planning to update this element using js for configurable products.
         */
        $html =
            '<span class="doctordogg-reward-points product-page">' .
                '<div class="coins-small"></div>' .
                '<span class="product-span">'
                    . __('Earn ')
                    . '<span class="points">' . __($points) . '</span>'
                    . __(' points buying this')
                . '</span>'
            . '</span>';

        return $html;
    }
}
