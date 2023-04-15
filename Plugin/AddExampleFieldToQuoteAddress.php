<?php declare(strict_types=1);

namespace YireoTraining\ExampleShippingAddressField\Plugin;

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Api\Data\AddressExtensionInterface;
use Magento\Quote\Api\Data\AddressInterface;
use Magento\Quote\Api\Data\CartInterface;

class AddExampleFieldToQuoteAddress
{
    /**
     * @param AddressInterface $quoteAddress
     * @return CartInterface
     */
    public function beforeSave(AddressInterface $quoteAddress): AddressInterface
    {
        $quoteAddress->setData('example2', $quoteAddress->getExtensionAttributes()->getExample2());

        return $quoteAddress;
    }

    public function afterGetExtensionAttributes(AddressInterface $quoteAddress, AddressExtensionInterface $extensionAttributes): AddressExtensionInterface
    {
        $example2 = $extensionAttributes->getExample2();
        if (empty($example2)) {
            $extensionAttributes->setExample2($quoteAddress->getData('example2'));
        }

        return $extensionAttributes;
    }
}
