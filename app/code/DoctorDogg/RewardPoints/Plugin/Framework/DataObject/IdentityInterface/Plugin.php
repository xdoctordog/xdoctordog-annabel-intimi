<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Framework\DataObject\IdentityInterface;

use Magento\Framework\DataObject\IdentityInterface;

/**
 * The plugin demonstrates the possibility of adding this very plugin to the interface.
 */
class Plugin
{
    public function afterGetIdentities(
        IdentityInterface $subject,
        array $result
    ) {
        return $result;
    }
}
