<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * The class that provides a setting that allows you to choose when to apply points.
 *
 * @package DoctorDogg\RewardPoints\Model\Config\Source
 */
class WhenApplyRewardPoints implements OptionSourceInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'before_tax', 'label' => __('Before tax')],
            ['value' => 'after_tax', 'label' => __('After tax')]
        ];
    }
}
