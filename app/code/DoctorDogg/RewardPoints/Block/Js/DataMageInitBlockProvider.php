<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Block\Js;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use DoctorDogg\RewardPoints\Model\Js\DataMageInitBlockProvider as Provider;

/**
 * A class that is essentially a block and a decorator for an object that gives html
 * that initializes the js functionality of the module on the front.
 */
class DataMageInitBlockProvider extends Template implements BlockInterface
{
    /**
     * @var Provider
     */
    private $dataMageInitBlockProvider;

    /**
     * @param Template\Context $context
     * @param Provider $dataMageInitBlockProvider
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Provider $dataMageInitBlockProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->dataMageInitBlockProvider = $dataMageInitBlockProvider;
    }

    /**
     * Get the html string that initializes our plugin on the front.
     *
     * @return string
     */
    public function getDataMageInitBlock(): string {
        return $this->dataMageInitBlockProvider->getDataMageInitBlock();
    }

    /**
     * Get block cache life time
     *
     * @return int
     */
    protected function getCacheLifetime()
    {
        return 3600;
    }
}
