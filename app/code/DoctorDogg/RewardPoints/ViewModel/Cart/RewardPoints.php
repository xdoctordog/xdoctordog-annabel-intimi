<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\ViewModel\Cart;

use Magento\Bundle\Model\Product\Type as BundleProductType;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Type as ProductType;
use Magento\Checkout\Model\Session;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableProductType;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\GroupedProduct\Model\Product\Type\Grouped as GroupedProductType;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * View model.
 */
class RewardPoints implements ArgumentInterface
{
    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param Session $checkoutSession
     * @param LoggerInterface $logger
     * @param StoreManagerInterface $storeManager
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Session $checkoutSession,
        LoggerInterface $logger,
        StoreManagerInterface $storeManager,
        ProductRepositoryInterface $productRepository
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->storeManager = $storeManager;
        $this->productRepository = $productRepository;
    }

    public function calculateRewardPoints($product, $quoteItem)
    {
        $result = null;
        $rewardPoints = (float)$product->getDoctordoggRewardpointsPoints();
        $qty = $quoteItem->getQty();
        if(!!$rewardPoints && !!$qty) {
            $result += ($rewardPoints * $qty);
        }

        return $result;
    }

    /**
     * Get the total number of reward points for the current shopping cart.
     */
    public function getQuoteTotalRewardPoints()
    {
        $totalRewardPoints = null;
        try{
            /**
             * @var $quoteItem \Magento\Quote\Model\Quote\Item
             */
            foreach ($this->checkoutSession->getQuote()->getAllItems() as $quoteItem) {
                $product = $quoteItem->getProduct();

                switch($product->getTypeId()) {
                    case ProductType::TYPE_SIMPLE:
                        $totalRewardPoints += (float)$this->calculateRewardPoints($product, $quoteItem);
                        break;

                    case ConfigurableProductType::TYPE_CODE:
                        $storeId = $this->storeManager->getStore()->getId();
                        foreach ($quoteItem->getQtyOptions() as $option) {
                            $simpleProduct = $option->getProduct();
                            $productId = $simpleProduct->getEntityId();
                            $productItem = null;
                            try {
                                $productItem = $this->productRepository->getById($productId, false, $storeId);
                            } catch (\Throwable $throwable) {
                                $this->logger->warning($throwable->getMessage());
                            }
                            if($productItem) {
                                $totalRewardPoints += (float)$this->calculateRewardPoints($productItem, $quoteItem);
                            }
                        }
                        break;

                    case BundleProductType::TYPE_CODE:
                    case ProductType::TYPE_BUNDLE:

                    case GroupedProductType::TYPE_CODE:
                    default:
                        break;
                }
            }
        } catch (\Throwable $throwable) {
            $this->logger->warning($throwable->getMessage());
        }
        return $totalRewardPoints;
    }
}
