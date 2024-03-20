<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Bundle\Simple;

use Magento\Bundle\Model\Option as Option;

/**
 * Preparator for the simple products inside the bundle product.
 */
class Preparator
{
    /**
     * Prepare simple products info.
     *
     * @param Option $radioOption
     * @return array
     */
    public function prepare(Option $radioOption): array
    {
        $productConfig = [];
        $products = $radioOption->getSelections();
        foreach ($products as $product) {
            $productId = $product->getEntityId();
            $rewardPoints = $product->getDoctordoggRewardpointsPoints();
            $productConfig[$productId] = [
                'rewardPoints' => $rewardPoints,
                'productName' => $product->getName()
            ];
        }

        return $productConfig;
    }
}
