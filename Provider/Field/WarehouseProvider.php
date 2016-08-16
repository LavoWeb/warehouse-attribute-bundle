<?php

namespace Lavoweb\Bundle\WarehouseAttributeBundle\Provider\Field;

use Pim\Bundle\EnrichBundle\Provider\Field\FieldProviderInterface;
use Pim\Bundle\EnrichBundle\Provider\Field\RuntimeException;

/**
 * WarehouseProvider
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
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
        return $element instanceof AttributeInterface;
    }
}
