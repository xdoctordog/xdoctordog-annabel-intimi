<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Block\Product\View\Type\Configurable;

use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Block\Product\View\Type\Configurable as ConfigurableBlock;
use DoctorDogg\RewardPoints\Model\Utility\Controller\AddSimpleProductsInfoToRegistry;

/**
 * The plugin that will catch simple products linked to config products and save information from them
 * in the registry in order to later use it for js functionality in order to add to the product card information
 * about the number of bonus points that you can get if you purchase this product.
 */
class Plugin
{
    /**
     * @var AddSimpleProductsInfoToRegistry
     */
    private $addSimpleProductsInfoToRegistry;

    /**
     * @param AddSimpleProductsInfoToRegistry $addSimpleProductsInfoToRegistry
     */
    public function __construct(
        AddSimpleProductsInfoToRegistry $addSimpleProductsInfoToRegistry
    ) {
        $this->addSimpleProductsInfoToRegistry = $addSimpleProductsInfoToRegistry;
    }

    /**
     * @param ConfigurableBlock $subject
     * @param $result
     * @return Product[]
     */
    public function afterGetAllowProducts(
        ConfigurableBlock $subject,
        $result
    ){
        $this->addSimpleProductsInfoToRegistry->execute($result);
        return $result;
    }
}
