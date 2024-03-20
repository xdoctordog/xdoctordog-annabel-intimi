<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Block\Cart;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * A block that displays a plate on the cart page with information about
 * how many reward points you can get if you place an order for this cart.
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
