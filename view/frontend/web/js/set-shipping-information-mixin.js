define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper,quote) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction) {

            var shippingAddress = quote.shippingAddress();
            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            var attribute = shippingAddress.customAttributes.find(
                function (element) {
                    return element.attribute_code === 'example2';
                }
            );

            if (attribute) {
                shippingAddress['extension_attributes']['example2'] = attribute.value;
            } else {
                console.warning('Unable to find custom attribute "example2" in shipping address', shippingAddress);
            }

            return originalAction();
        });
    };
});
