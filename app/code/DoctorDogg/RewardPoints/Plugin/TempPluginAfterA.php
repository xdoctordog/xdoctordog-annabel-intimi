<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginAfterA
{
    public function afterGetArray(
        SomeTemp $subject,

        array $result,

        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginAfterA(order:90)';
        $itemKey .= '(after-a)';// @todo: no effect
        $newItemKey = '(after-a)';

        return \array_merge($result, [$newItemKey]);
    }
}
