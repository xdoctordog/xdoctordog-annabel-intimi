<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Model\Product\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validator\FloatUtils;
use Magento\Framework\Validator\UniversalFactory;

/**
 * Class that represents the backend model for the EAV field, the value of which should be a percentage value.
 *
 * @package DoctorDogg\RewardPoints\Model\Product\Attribute\Backend
 */
class Procent extends AbstractBackend
{
    /**
     * @var UniversalFactory
     */
    private $universalFactory;

    /**
     * @param UniversalFactory $universalFactory
     */
    public function __construct(
        UniversalFactory $universalFactory
    ) {
        $this->universalFactory = $universalFactory;
    }

    /**
     * Validate
     *
     * @param ???? $object
     * @throws LocalizedException
     * @return bool
     */
    public function validate($object): bool
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (empty($value)) {
            return parent::validate($object);
        }

        if (!FloatUtils::isValid($value)) {
            /** @var \Magento\Eav\Model\Entity\Attribute\Exception $e */
            $e = $this->universalFactory->create(
                LocalizedException::class,
                ['phrase' => __('Please enter an integer or float number in this field.')]
            );
            throw $e;
        }

        return true;
    }
}
