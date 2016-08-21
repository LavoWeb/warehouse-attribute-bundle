<?php

namespace Lavoweb\Bundle\WarehouseAttributeBundle\Provider\Field;

use Pim\Bundle\EnrichBundle\Provider\Field\FieldProviderInterface;
use Pim\Bundle\EnrichBundle\Provider\Field\RuntimeException;

/**
 * WarehouseProvider
 *
 * @author    Aurélien Lavorel <aurelien@lavoweb.net>
 */
class WarehouseProvider implements FieldProviderInterface
{

    public function getField($element)
    {
       return 'lavoweb-warehouse';
    }

    /**
     * Does the Field provider support the element
     *
     * @param mixed $element
     *
     * @return bool
     */
    public function supports($element)
    {
        return true;
    }
}
