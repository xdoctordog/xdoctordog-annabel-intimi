<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Registry\Product\Simple;

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
     * Put array product config to static variable.
     *
     * @param array $productConfig
     */
    public function put(array $productConfig)
    {
        $key = key($productConfig);
        if($key && isset(self::$productConfig[$key])) {
           return;
        }
        self::$productConfig = \array_replace(self::$productConfig, $productConfig);
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
