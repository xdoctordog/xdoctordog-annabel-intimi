<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Block\Product\View\Type\Grouped;

use Magento\GroupedProduct\Block\Product\View\Type\Grouped as GroupedProduct;
use DoctorDogg\RewardPoints\Model\Utility\Controller\Grouped\Product\AddSimpleProductsInfoToRegistry;

/**
 * A plugin that will intercept simple products from a group product and get their value of bonus points
 * that you can get if you buy this product.
 */
class Plugin
{
    /**
     * @var AddSimpleProductsInfoToRegistry
     */
    private $addSimpleProductsInfoToRegistryController;

    /**
     * @param AddSimpleProductsInfoToRegistry $addSimpleProductsInfoToRegistryController
     */
    public function __construct(
        AddSimpleProductsInfoToRegistry $addSimpleProductsInfoToRegistryController
    ) {
        $this->addSimpleProductsInfoToRegistryController = $addSimpleProductsInfoToRegistryController;
    }

    /**
     * @param GroupedProduct $subject
     * @param array $response
     * @return array
     */
    public function afterGetAssociatedProducts(
        GroupedProduct $subject,
        array $response
    ) {
        $productId = (int)$subject->getProduct()->getEntityId();
        if($productId) {
            $this->addSimpleProductsInfoToRegistryController->execute($productId, $response);
        }
        return $response;
    }
}
