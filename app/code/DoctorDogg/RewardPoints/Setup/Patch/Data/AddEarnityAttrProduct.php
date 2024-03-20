<?php

declare(strict_types=1);

namespace DoctorDogg\RewardPoints\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type as ProductType;
use Magento\Downloadable\Model\Product\Type as DownloadableProductType;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use DoctorDogg\RewardPoints\Block\Adminhtml\Product\Helper\Form\Type as FormType;
use DoctorDogg\RewardPoints\Model\Product\Attribute\Backend\Procent;

/**
 * Installation class adds a new attribute to the product that is responsible
 * for the number of points that can be earned if you purchase this product.
 */
class AddEarnityAttrProduct implements DataPatchInterface
{
    /**
     * @var SchemaSetupInterface
     */
    private $schemaSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param SchemaSetupInterface $schemaSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        SchemaSetupInterface $schemaSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->schemaSetup = $schemaSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $attribute = 'doctordogg_rewardpoints_points';
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(Product::ENTITY, $attribute);
        $productTypes = [
            ProductType::TYPE_SIMPLE,
            ProductType::TYPE_VIRTUAL,
            DownloadableProductType::TYPE_DOWNLOADABLE
        ];
        $productTypes = join(',', $productTypes);
        $eavSetup->addAttribute(
            Product::ENTITY,
            $attribute,
            [
                'group' => 'Doctor Dogg Order Reward Points Settings',
                'backend' => '',
                'frontend' => '',
                'label' => 'Reward points (number)',
                'type' => 'decimal',
                'input' => 'text',
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'apply_to' => $productTypes,

                //@todo: One day we will find out what and where this field is used for, when we catch the error.
                'input_renderer' => FormType::class,
                'frontend_input_renderer' => FormType::class,

                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
