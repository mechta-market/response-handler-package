<?php


namespace Mechta\ResponseHandler\Filter;


use Spiral\Models\ValueInterface;

/**
 * Trait DeepArrayTrait
 */
trait DeepArrayTrait
{
    public function getDeepValue()
    {
        $result = [];
        foreach ($this->getFields() as $field => $value) {
            if ($value instanceof ValueInterface) {
                $result[$field] = method_exists($value,'getDeepValue') ? $value->getDeepValue() : $value->getValue();
            } else if (is_array($value)) {
                $subArray = [];
                foreach ($value as $subField => $subValue) {
                    if ($subValue instanceof ValueInterface) {
                        $subArray[$subField] = method_exists($subValue,'getDeepValue') ? $subValue->getDeepValue() : $subValue->getValue();
                    }
                    else {
                        $subArray[$subField] = $subValue;
                    }
                }

                $result[$field] = $subArray;
            }
            else {
                $result[$field] = $value;
            }
        }

        return $result;
    }

    public function toDeepArray(): array
    {
        return $this->getDeepValue();
    }
}
