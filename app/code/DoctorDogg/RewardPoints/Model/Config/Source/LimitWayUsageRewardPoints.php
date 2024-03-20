<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * The class that provides a setting that allows you to choose a way to limit the use of reward points for an order.
 *
 * @package DoctorDogg\RewardPoints\Model\Config\Source
 */
class LimitWayUsageRewardPoints implements OptionSourceInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'n_points', 'label' => __('No more than N points per order.')],
            ['value' => 'n_percents', 'label' => __('No more than N percent of the order price.')],
            ['value' => 'unlimited', 'label' => __('Unlimited')]
        ];
    }
}
