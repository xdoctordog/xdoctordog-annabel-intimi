<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginAfterB
{
    public function afterGetArray(
        SomeTemp $subject,

        array $result,

        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginAfterB(order:100)';
        $itemKey .= '(after-b)';// @todo: no effect
        $newItemKey = '(after-b)';

        return \array_merge($result, [$newItemKey]);
    }
}
