<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginBeforeA
{
    public function beforeGetArray(
        SomeTemp $subject,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginBeforeA(order:30)';
        $itemKey .= '(before-a)';

        return [$itemKey];
    }
}
