<?php declare(strict_types=1);

namespace YireoTraining\ExampleShippingAddressField\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Pragmatic\JsLayoutParser\Api\ComponentInterface;
use Pragmatic\JsLayoutParser\Api\ComponentInterfaceFactory;
use Pragmatic\JsLayoutParser\Model\JsLayoutParser;

class AddExampleShippingAddressField implements LayoutProcessorInterface
{
    public function __construct(
        private JsLayoutParser $jsLayoutParser,
        private ComponentInterfaceFactory $componentFactory
    ) {
    }

    public function process($jsLayout)
    {
        /** @var ComponentInterface $component */
        $component = $this->jsLayoutParser->parse($jsLayout, 'checkout');

        if ($shippingAddress = $component->getNestedChild('steps.shipping-step.shippingAddress.shipping-address-fieldset')) {

            $exampleComponent = $this->componentFactory->create([
                'componentName' => 'example2',
                'data' => [
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'label' => 'Example component',
                    'provider' => 'checkoutProvider',
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'dataScope' => 'shippingAddress.custom_attributes.example2',
                ]
            ]);

            $shippingAddress->addChild($exampleComponent);
        }

        $jsLayout['components']['checkout'] = $component->asArray();

        return $jsLayout;
    }
}