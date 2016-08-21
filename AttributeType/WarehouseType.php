<?php

namespace Lavoweb\Bundle\WarehouseAttributeBundle\AttributeType;

use Pim\Bundle\CatalogBundle\AttributeType\AbstractAttributeType;
use Pim\Component\Catalog\Model\AttributeInterface;

/**
 * Warehouse attribute type
 *
 * @author    Aurélien Lavorel <aurelien@lavoweb.net>
 */
class WarehouseType extends AbstractAttributeType
{
    /**
     * {@inheritdoc}
     */
    protected function defineCustomAttributeProperties(AttributeInterface $attribute)
    {
        $properties = parent::defineCustomAttributeProperties($attribute);
        $properties['autoOptionSorting'] = [
            'name'      => 'autoOptionSorting',
            'fieldType' => 'hidden',
            'options' => [
                'property_path' => 'properties[autoOptionSorting]',
            ]
        ];

        $properties['unique']['options']['disabled']  = true;
        $properties['unique']['options']['read_only'] = true;

        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'lavoweb_warehouse';
    }
}
