<?php declare(strict_types=1);

namespace YireoTraining\ExampleShippingAddressField\Console\Command;

use Magento\Quote\Api\Data\AddressInterfaceFactory as QuoteAddressFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EditExampleFieldCommand extends Command
{


    private QuoteAddressFactory $addressFactory;

    public function __construct(
        QuoteAddressFactory $addressFactory,
        string $name = null
    ) {
        parent::__construct($name);
        $this->addressFactory = $addressFactory;
    }

    protected function configure()
    {
        $this->setName('yireo_training_example_shipping_address_field:edit');
        $this->setDescription('Edit shipping address field');
        $this->addArgument('quote_address_id', InputArgument::REQUIRED);
        $this->addArgument('example2', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $quoteAddressId = $input->getArgument('quote_address_id');
        $example2 = $input->getArgument('example2');
        $collection = $this->addressFactory->create()->getCollection();
        $collection->addFilter('main_table.address_id', $quoteAddressId);
        $quoteAddress = $collection->getFirstItem();
        $quoteAddress->getExtensionAttributes()->setExample2($example2);
        $quoteAddress->save();
    }
}
