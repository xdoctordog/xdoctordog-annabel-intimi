<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model;

use Magento\Framework\Filter\SimpleDirective\ProcessorInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * Class demonstrates the ability to create the special variable for the email templates with custom functionality.
 * Perhaps this was done to prevent running some uploaded php script.
 * Now Magento knows and runs defined code using special code.
 */
class LifetimeSpendDirective implements ProcessorInterface
{
    /**
     * @var PriceCurrencyInterface
     */
    private $priceCurrency;

    /**
     * @param PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        PriceCurrencyInterface $priceCurrency
    ) {
        $this->priceCurrency = $priceCurrency;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        /**
         * @TODO: Underscores are prohibited here.
         */
        return 'doctordogglifetimespend';
    }

    /**
     * @inheritDoc
     */
    public function process($value, array $parameters, ?string $html): string
    {
        $shouldBold = !empty($parameters['should_bold'] ?? null);
        $amount = $this->priceCurrency->getCurrencySymbol() . $this->calculateLifetimeSpend();
        return ($shouldBold ? '<strong>' . $amount . '</strong>' : $amount);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultFilters(): ?array
    {
        /**
         * Make sure newlines are converted to <br /> tags by default
         */
        return ['nl2br'];
    }

    /**
     * Calculate the total amount of money spent by all customers for all time
     *
     * @return float
     */
    private function calculateLifetimeSpend(): float
    {
        /**
         * Add code here to calculate the lifetime spend
         */
        return 123.45;
    }
}
