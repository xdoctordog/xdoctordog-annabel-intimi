<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginBeforeC
{
    public function beforeGetArray(
        SomeTemp $subject,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginBeforeC(order:60)';
        $itemKey .= '(before-c)';

        return [$itemKey];
    }
}
