<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginAroundZero
{
    public function aroundGetArray(
        SomeTemp $subject,

        callable $proceed,

        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginAroundZero(before)(order:20)';
        $itemKey .= '(around-zero)';
        $result = $proceed($itemKey);
        $subject->influences[] = 'TempPluginAroundZero(after)(order:20)';

        return $result;
    }
}
