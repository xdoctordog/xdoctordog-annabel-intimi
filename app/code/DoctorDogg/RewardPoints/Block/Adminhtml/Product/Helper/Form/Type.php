<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Block\Adminhtml\Product\Helper\Form;

use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\Text as ElementText;
use Magento\Framework\Escaper;
use DoctorDogg\RewardPoints\Model\Config;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Msrp\Block\Adminhtml\Product\Helper\Form\Type\Price;

/**
 * The class doesn't do what I want it to do. It takes time to @todo: figure out where it should be used at all.
 *
 * Class used to prevent the display of a field when editing a product,
 * if the output is disabled in the settings
 */
class Type extends ElementText // AbstractFrontend Price
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param array $data
     */
    public function __construct(
        Config $config,
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function toHtml()
    {
        if ($this->config->isEnabled()) {
            return parent::toHtml();
        }
        return '';
    }
}
