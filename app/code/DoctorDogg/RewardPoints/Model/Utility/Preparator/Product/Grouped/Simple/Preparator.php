<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Utility\Preparator\Product\Grouped\Simple;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Preparator for the simple products inside the group product.
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
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param StoreManagerInterface $storeManager
     * @param SerializerInterface $jsonSerializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        StoreManagerInterface $storeManager,
        SerializerInterface $jsonSerializer,
        LoggerInterface $logger
    ) {
        $this->jsonSerializer = $jsonSerializer;
        $this->logger = $logger;
        $this->productRepository = $productRepository;
        $this->storeManager = $storeManager;
    }

    /**
     * Prepare simple products info.
     *
     * @param array $products
     * @return array
     */
    public function prepare(array $products): array
    {
        $productConfig = [];

        $storeId = null;
        try {
            $storeId = $this->storeManager->getStore()->getId();
        } catch (\Throwable $throwable) {
            $this->logger->warning($throwable->getMessage());
        }
        if(!$storeId) {
            return $productConfig;
        }

        foreach ($products as $item) {
            $product = null;
            $productId = $item->getEntityId();
            try {
                $product = $this->productRepository->getById($productId, false, $storeId);
            } catch (\Throwable $throwable) {
                $this->logger->warning($throwable->getMessage());
            }
            if(!$product) {
                continue;
            }
            $rewardPoints = $product->getDoctordoggRewardpointsPoints();
            if (!$rewardPoints) {
                continue;
            }
            $productConfig[$productId] = $rewardPoints;
        }

        return $productConfig;
    }
}
