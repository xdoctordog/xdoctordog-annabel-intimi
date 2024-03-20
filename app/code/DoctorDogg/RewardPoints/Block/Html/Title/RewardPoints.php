<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Block\Html\Title;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * A class that is essentially a block.
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
}
