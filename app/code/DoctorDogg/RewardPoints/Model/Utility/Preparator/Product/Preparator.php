<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Preparator\Product;

use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;

class Preparator
{
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
     * Prepare array for using for extension functionality on the frontend product card.
     *
     * @param string $jsonConfig
     * @return string
     */
    public function prepare(string $jsonConfig)
    {
        $attributesConfig = $this->jsonSerializer->serialize([]);
        try {
            $config = $this->jsonSerializer->unserialize($jsonConfig);
            $attributesConfig = $config['attributes'] ?? [];
        } catch (\InvalidArgumentException $exception) {
            $this->logger->warning($exception->getMessage());
        }

        return $attributesConfig;
    }
}
