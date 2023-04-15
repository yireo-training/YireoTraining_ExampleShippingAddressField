<?php declare(strict_types=1);

namespace YireoTraining\ExampleShippingAddressField\Plugin;

use Magento\Quote\Model\Quote\Address\CustomAttributeListInterface;

class AddCustomAttribute
{
    public function afterGetAttributes(CustomAttributeListInterface $customAttributeList, array $attributes = []): array
    {
        $attributes[] = 'example2';
        return $attributes;
    }
}