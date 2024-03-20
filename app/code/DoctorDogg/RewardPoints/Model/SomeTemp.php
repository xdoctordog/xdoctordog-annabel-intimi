<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model;

class SomeTemp
{
    public  $influences = ['SomeTemp(init value)'];

    public function getArray(string $itemKey) {
        $itemKey .= '(getArray)';
        $this->influences[] = '(getArray)';
        return [$itemKey];
    }
}
