<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\ViewModel\Product\View\Type\Grouped\Js;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use DoctorDogg\RewardPoints\Model\Registry\Product\Grouped\Simple\Registry as SimpleProductsOfGroupedRegistry;

/**
 * View model.
 */
class RewardPoints implements ArgumentInterface
{
    /**
     * @var SimpleProductsOfGroupedRegistry
     */
    private $simpleProductsOfGroupedRegistry;

    /**
     * @param SimpleProductsOfGroupedRegistry $simpleProductsOfGroupedRegistry
     */
    public function __construct(
        SimpleProductsOfGroupedRegistry $simpleProductsOfGroupedRegistry
    ) {
        $this->simpleProductsOfGroupedRegistry = $simpleProductsOfGroupedRegistry;
    }

    /**
     * A method that is essentially a decorator for the registry that gives us the configuration
     * for simple products that are part of a group product.
     *
     * @return string
     */
    public function getSimpleProductsConfig()
    {
        return $this->simpleProductsOfGroupedRegistry->getAllJson();
    }
}
