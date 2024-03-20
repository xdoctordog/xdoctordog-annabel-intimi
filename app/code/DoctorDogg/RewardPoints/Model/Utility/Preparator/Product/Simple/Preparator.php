<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Simple;

use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Preparator
 */
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
     * @param array $productItems
     * @return array
     */
    public function prepare(array $productItems): array
    {
        $productConfig = [];
        try {
            foreach ($productItems as $productItem) {
                $productConfig[$productItem->getparentId()][$productItem->getEntityId()] =
                    $productItem->getDoctordoggRewardpointsPoints();
            }
        } catch (\InvalidArgumentException $exception) {
            $this->logger->warning($exception->getMessage());
        }

        return $productConfig;
    }
}
