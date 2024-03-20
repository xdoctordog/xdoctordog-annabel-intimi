<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Plugin\Block\Product\Renderer\Listing\Configurable;

//use Magento\Swatches\Block\Product\Renderer\Listing\Configurable;
use Magento\ConfigurableProduct\Block\Product\View\Type\Configurable;
use DoctorDogg\RewardPoints\Model\Utility\Controller\AddPreparedArrayToRegistry as AddPreparedArrayToRegistryController;

/**
 * The plugin that will save information about the json config in the registry in order to use it to switch the values
 * of bonus points on the product card. This applies to the category page /men.html and three other pages
 * that display the same product cards.
 */
class Plugin
{
    /**
     * @var AddPreparedArrayToRegistryController
     */
    private $controller;

    /**
     * @param AddPreparedArrayToRegistryController $controller
     */
    public function __construct(
        AddPreparedArrayToRegistryController $controller
    ) {
        $this->controller = $controller;
    }

    /**
     * @param Configurable $subject
     * @param string $result
     * @return string
     */
    public function afterGetJsonConfig(
        Configurable $subject,
        string $result
    ) {
        $this->controller->execute((int)$subject->getProduct()->getEntityId(), $result);
        return $result;
    }
}
