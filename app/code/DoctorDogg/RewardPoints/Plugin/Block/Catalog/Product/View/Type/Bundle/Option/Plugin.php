<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Block\Catalog\Product\View\Type\Bundle\Option;

use Magento\Bundle\Block\Catalog\Product\View\Type\Bundle\Option as BundleOption;
use Magento\Bundle\Model\Option;
use DoctorDogg\RewardPoints\Model\Utility\Controller\Bundle\Product\AddSimpleProductsInfoToRegistry;

/**
 * A plugin that will run for a block that runs for each option inside the bundle product
 * when it is displayed on the bundle product page on the frontend.
 *
 * We will try to use this information in order to get information about how many bonus points
 * are given for their purchase from simple products and display it on the frontend page of bundle product.
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
     * @param BundleOption $subject
     * @param callable $proceed
     * @param $method
     * @param array $arguments
     * @return Option
     */
    public function around__call(
        BundleOption $subject,
        callable $proceed,
        $method,
        array $arguments
    ) {
        /**
         * @var Option $result
         */
        $result = $proceed($method, $arguments);
        if($method === 'getOption') {
            $this->addSimpleProductsInfoToRegistry->execute($result);
        }
        return $result;
    }
}
