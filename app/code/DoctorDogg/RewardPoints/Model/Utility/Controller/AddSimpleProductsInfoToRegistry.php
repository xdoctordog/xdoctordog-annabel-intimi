<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Controller;

use DoctorDogg\RewardPoints\Model\Registry\Product\Simple\Registry as SimpleProductRegistry;
use DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Simple\Preparator as SimpleProductPreparator;

/**
 * The controller class that collects information about the reward points that are awarded for the purchase
 * of simple products included in the configurable product for further use of this information
 * on the category page for cards with configurable goods on the frontend /mens.html.
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
     * @param array $products
     */
    public function execute(array $products)
    {
        $this->registry->put($this->preparator->prepare($products));
    }
}
