<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Controller\Grouped\Product;

use DoctorDogg\RewardPoints\Model\Registry\Product\Grouped\Simple\Registry as SimpleProductRegistry;
use DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Grouped\Simple\Preparator as SimpleProductPreparator;

/**
 * The controller class that collects information about the reward points that are awarded for the purchase
 * of simple products included in the group product for further use of this information
 * on the category page for cards with configurable goods.
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
     * @param int $groupedProductId
     * @param array $products
     */
    public function execute(int $groupedProductId, array $products)
    {
        !$this->registry->has($groupedProductId) ? $this->registry->put($groupedProductId, $this->preparator->prepare($products)) : null;
    }
}
