<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Api;

interface ProductRegistryInterface
{
    /**
     * Put array product config to static variable.
     *
     * @param int $productId
     * @param array $config
     */
    public function put(int $productId, array $config);

    /**
     * Get array product's config for all products.
     *
     * @return string
     */
    public function getAllJson(): string;
}
