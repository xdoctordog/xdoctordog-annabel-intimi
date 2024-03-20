<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\ViewModel\Product\View\Type\Bundle\Js;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use DoctorDogg\RewardPoints\Model\Registry\Product\Bundle\Simple\Registry as SimpleProductsOfBundleRegistry;
use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * View model.
 */
class RewardPoints implements ArgumentInterface
{
    /**
     * @var SomeTemp
     */
    private $someTemp;

    /**
     * @var SimpleProductsOfBundleRegistry
     */
    private $simpleProductsOfBundleRegistry;

    /**
     * @param SimpleProductsOfBundleRegistry $simpleProductsOfBundleRegistry
     */
    public function __construct(
        SimpleProductsOfBundleRegistry $simpleProductsOfBundleRegistry,
        SomeTemp $someTemp
    ) {
        $this->simpleProductsOfBundleRegistry = $simpleProductsOfBundleRegistry;
        $this->someTemp = $someTemp;
    }

    /**
     * A method that is essentially a decorator for the registry that gives us the configuration
     * for simple products that are part of a group product.
     *
     * @return string
     */
    public function getSimpleProductsConfig()
    {
//        $result = $this->someTemp->getArray('caller');
        return $this->simpleProductsOfBundleRegistry->getAllJson();
    }
}
