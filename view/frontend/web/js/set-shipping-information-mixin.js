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

            console.log('Current shipping address', shippingAddress);
            var attribute = shippingAddress.customAttributes.find(
                function (element) {
                    return element.attribute_code === 'example2';
                }
            );

            shippingAddress['extension_attributes']['example2'] = attribute.value;

            return originalAction();
        });
    };
});
