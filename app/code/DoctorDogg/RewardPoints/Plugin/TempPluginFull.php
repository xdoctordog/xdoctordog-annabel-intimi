<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginFull
{
    public function beforeGetArray(
        SomeTemp $subject,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginFull(before)(order:5)';
        $itemKey .= '(full-before)';
        return [$itemKey];
    }

    public function aroundGetArray(
        SomeTemp $subject,
        callable $proceed,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginFull(around-before)(order:5)';
        $itemKey .= '(full-around)';
        $result = $proceed($itemKey);
        $subject->influences[] = 'TempPluginFull(around-after)(order:5)';

        return $result;
    }

    public function afterGetArray(
        SomeTemp $subject,
        array $result,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginFull(after)(order:5)';
        $itemKey .= '(full-after)';// @todo: no effect
        $newItemKey = '(full-after)';

        return \array_merge($result, [$newItemKey]);
    }
}
