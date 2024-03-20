<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Registry\Product;

use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use DoctorDogg\RewardPoints\Api\ProductRegistryInterface;

/**
 * The class registry which stores data saved by plugin.
 */
class Registry implements ProductRegistryInterface
{
    /**
     * [ [product_id => product_attribute_config], ]
     *
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
     * Put array product config to static variable.
     *
     * @param int $productId
     * @param array $productConfig
     */
    public function put(int $productId, array $productConfig)
    {
        $key = key($productConfig);
        if($key && isset(self::$productConfig[$key])) {
            return;
        }
        self::$productConfig[$productId] = $productConfig;
    }

    /**
     * Get array product config.
     *
     * @param int $productId
     * @return array
     */
    public function get(int $productId): array
    {
        return self::$productConfig[$productId] ?? [];
    }

    /**
     * Get array product's config for all products.
     *
     * @return array
     */
    public function getAll(): array
    {
        return self::$productConfig ?? [];
    }

    /**
     * Get array product's config for all products.
     *
     * @return string
     */
    public function getAllJson(): string
    {
        try {
            $productJsonConfig = $this->jsonSerializer->serialize(
                self::$productConfig ?? []
            );
        } catch (\Exception $exception) {
            $productJsonConfig = $this->jsonSerializer->serialize([]);
            $this->logger->warning($exception->getMessage());
        }

        return $productJsonConfig;
    }
}
