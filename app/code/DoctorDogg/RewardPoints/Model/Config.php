<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Escaper;
use DoctorDogg\RewardPoints\Model\Config\ConfigPaths;

/**
 * Class Config
 */
class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * Check if extension is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        $store = null;
        try {
            $store = $this->storeManager->getStore()->getId();
        } catch (\Exception $exception){}

        if(!$store) {
            return false;
        }

        return $this->scopeConfig->isSetFlag(
            ConfigPaths::DISPLAY_PRODUCT_REWARD_POINTS_PATH,
            ScopeInterface::SCOPE_STORE,
            $store->getId()
        );
    }
}
