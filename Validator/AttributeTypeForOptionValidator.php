<?php

namespace Lavoweb\Bundle\WarehouseAttributeBundle\Validator;

use Pim\Bundle\CatalogBundle\AttributeType\AttributeTypes;
use Pim\Bundle\CatalogBundle\Model\AttributeOptionInterface;
use Pim\Bundle\CatalogBundle\Validator\Constraints\AttributeTypeForOptionValidator as PimAttributeTypeForOptionValidator;
use Symfony\Component\Validator\Constraint;

/**
 * AttributeTypeForOptionValidator
 *
 * @author    Antoine Guigan <antoine@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class AttributeTypeForOptionValidator extends PimAttributeTypeForOptionValidator
{
    /**
     * @param object     $attributeOption
     * @param Constraint $constraint
     */
    public function validate($attributeOption, Constraint $constraint)
    {
        /** @var AttributeOptionInterface */
        if ($attributeOption instanceof AttributeOptionInterface) {
            $attribute       = $attributeOption->getAttribute();
            $authorizedTypes = [AttributeTypes::OPTION_SIMPLE_SELECT, AttributeTypes::OPTION_MULTI_SELECT, 'lavoweb_warehouse'];
            if (!in_array($attribute->getAttributeType(), $authorizedTypes)) {
                $this->addInvalidAttributeViolation($constraint, $attributeOption);
            }
        }
    }
}
