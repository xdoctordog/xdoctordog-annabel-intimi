<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Controller\Bundle\Product;

use Magento\Bundle\Model\Option;
use DoctorDogg\RewardPoints\Model\Registry\Product\Bundle\Simple\Registry as SimpleProductRegistry;
use DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Bundle\Simple\Preparator as SimpleProductPreparator;

/**
 * The controller that works according to the plugin at the moment when we need to save information
 * about the simple products associated with the bundle product in the registry.
 */
class AddSimpleProductsInfoToRegistry
{
    /**
     * @var SimpleProductPreparator
     */
    private $preparator;

    /**
     * @var SimpleProductRegistry
     */
    private $registry;

    /**
     * @param SimpleProductRegistry $registry
     * @param SimpleProductPreparator $preparator
     */
    public function __construct(
        SimpleProductRegistry $registry,
        SimpleProductPreparator $preparator
    ) {
        $this->registry = $registry;
        $this->preparator = $preparator;
    }

    /**
     * Run controller action.
     *
     * @param Option $products
     */
    public function execute(Option $option)
    {
        $this->registry->put($this->preparator->prepare($option));
    }
}
