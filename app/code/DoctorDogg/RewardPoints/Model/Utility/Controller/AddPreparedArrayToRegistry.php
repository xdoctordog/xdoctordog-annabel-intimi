<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Controller;

use DoctorDogg\RewardPoints\Api\ProductRegistryInterface;
use DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Preparator as ProductPreparator;

/**
 * The controller that sends the core Magento data for preparation to the preparator,
 * and then puts the received data into the registry for later use as a config on the frontend.
 */
class AddPreparedArrayToRegistry
{
    /**
     * @var ProductPreparator
     */
    private $preparator;

    /**
     * @var ProductRegistryInterface
     */
    private $registry;

    /**
     * @param ProductRegistryInterface $registry
     * @param ProductPreparator $preparator
     */
    public function __construct(
        ProductRegistryInterface $registry,
        ProductPreparator $preparator
    ) {
        $this->registry = $registry;
        $this->preparator = $preparator;
    }

    /**
     * Run controller action.
     *
     * @param int $productId
     * @param string $jsonConfig
     */
    public function execute(int $productId, string $jsonConfig)
    {
        //@todo: add check if already exists
        $this->registry->put($productId, $this->preparator->prepare($jsonConfig));
    }
}
