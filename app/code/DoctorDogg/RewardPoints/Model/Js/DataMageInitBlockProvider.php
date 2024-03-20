<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Js;

use DoctorDogg\RewardPoints\Api\ProductRegistryInterface;
use DoctorDogg\RewardPoints\Model\Registry\Product\Simple\Registry as SimpleProductRegistry;

/**
 * A class that gives a piece of html that will serve to initialize js functionality on the front.
 */
class DataMageInitBlockProvider
{
    /**
     * @var ProductRegistryInterface
     */
    private $productRegistry;

    /**
     * @var SimpleProductRegistry
     */
    private $simpleProductRegistry;

    /**
     * @param ProductRegistryInterface $productRegistry
     * @param SimpleProductRegistry $simpleProductRegistry
     */
    public function __construct(
        ProductRegistryInterface $productRegistry,
        SimpleProductRegistry $simpleProductRegistry
    ) {
        $this->productRegistry = $productRegistry;
        $this->simpleProductRegistry = $simpleProductRegistry;
    }

    /**
     * Add js functionality to handle clicks on the product attribute on the product card on the frontend.
     * Since we need our own access to the product attributes.
     * So we cannot process everything inside the swatch-renderer-mixin.
     *
     * @return string
     */
    public function getDataMageInitBlock()
    {
        $attributeConfig = $this->productRegistry->getAllJson();
        $rewardPointsConfig = $this->simpleProductRegistry->getAllJson();
        $jsMageInitBlock = <<<JS_MAGE_INIT_BLOCK
            <div class="doctordogg-reward-points-product-block-info"
            data-mage-init='{"DoctorDogg_RewardPoints/js/product-reward-points":{"attributeConfig": $attributeConfig, "rewardPointsConfig": $rewardPointsConfig }}'></div>
        JS_MAGE_INIT_BLOCK;

        return $jsMageInitBlock;
    }
}
