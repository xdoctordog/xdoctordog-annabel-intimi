<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Registry\Product\Grouped\Simple;

use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;

/**
 * The class registry which stores data provided by plugin.
 */
class Registry
{
    /**
     * @var array
     */
    private static $productConfig = [];

    /**
     * @var SerializerInterface
     */
    private $jsonSerializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param SerializerInterface $jsonSerializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        SerializerInterface $jsonSerializer,
        LoggerInterface $logger
    ) {
        $this->jsonSerializer = $jsonSerializer;
        $this->logger = $logger;
    }

    /**
     * Check if there is data collected about its simple products for such a group product.
     *
     * @param int $groupProductId
     * @return bool
     */
    public function has(int $groupProductId)
    {
        return isset(self::$productConfig[$groupProductId]);
    }

    /**
     * Put array product config to static variable.
     *
     * @param int $groupProductId
     * @param array $productConfig
     */
    public function put(int $groupProductId, array $productConfig)
    {
        self::$productConfig = \array_replace(self::$productConfig, [$groupProductId => $productConfig]);
    }

    /**
     * Get array product's config for all products.
     *
     * @return string
     */
    public function getAllJson(): string
    {
        $productJsonConfig = $this->jsonSerializer->serialize([]);
        try {
            $productJsonConfig = $this->jsonSerializer->serialize(
                self::$productConfig
            );
        } catch (\Exception $exception) {
            $this->logger->warning($exception->getMessage());
        }

        return $productJsonConfig;
    }
}
