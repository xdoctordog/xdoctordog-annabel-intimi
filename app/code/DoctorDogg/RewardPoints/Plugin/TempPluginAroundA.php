<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin;

use DoctorDogg\RewardPoints\Model\SomeTemp;

/**
 * For educational purposes, these plugins are created to test how they work.
 */
class TempPluginAroundA
{
    public function aroundGetArray(
        SomeTemp $subject,
        callable $proceed,
        string $itemKey
    ) {
        $subject->influences[] = 'TempPluginAroundA(before)(order:50)';
        $itemKey .= '(around-a)';
//        $result = $proceed($itemKey);
        $subject->influences[] = 'TempPluginAroundA(after)(order:50)';

        $result = ['some-fake-data']; //@todo: i don't know what it should be if we are not calling the the next objects in the chain
        return $result;
    }
}
