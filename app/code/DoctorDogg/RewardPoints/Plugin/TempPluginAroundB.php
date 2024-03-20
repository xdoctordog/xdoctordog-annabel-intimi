<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginAroundB
{
    public function aroundGetArray(
        SomeTemp $subject,

        callable $proceed,

        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginAroundB(before)(order:70)';
        $itemKey .= '(around-b)';
        $result = $proceed($itemKey);
        $subject->influences[] = 'TempPluginAroundB(after)(order:70)';

        return $result;
    }
}
