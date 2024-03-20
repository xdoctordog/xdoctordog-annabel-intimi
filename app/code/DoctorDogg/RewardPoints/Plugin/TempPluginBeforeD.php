<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginBeforeD
{
    public function beforeGetArray(
        SomeTemp $subject,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginBeforeD(order:80)';
        $itemKey .= '(before-d)';

        return [$itemKey];
    }
}
