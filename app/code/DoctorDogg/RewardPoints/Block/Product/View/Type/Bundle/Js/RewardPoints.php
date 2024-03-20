<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Block\Product\View\Type\Bundle\Js;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * A block that will be displayed on the group product page on the front and, using the js code,
 * add a plate about bonus points for each symbol of the product included in the group product.
 */
class RewardPoints extends Template implements BlockInterface
{
    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
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
