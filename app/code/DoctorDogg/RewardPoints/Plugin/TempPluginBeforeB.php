<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginBeforeB
{
    public function beforeGetArray(
        SomeTemp $subject,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginBeforeB(order:40)';
        $itemKey .= '(before-b)';

        return [$itemKey];
    }
}
