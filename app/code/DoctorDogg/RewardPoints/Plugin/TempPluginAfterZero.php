<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginAfterZero
{
    public function afterGetArray(
        SomeTemp $subject,

        array $result,

        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginAfterZero(order:10)';
        $itemKey .= '(after-zero)';// @todo: no effect
        $newItemKey = '(after-zero)';

        return \array_merge($result, [$newItemKey]);
    }
}
