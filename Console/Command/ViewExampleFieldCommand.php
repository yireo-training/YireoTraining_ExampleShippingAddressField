<?php declare(strict_types=1);

namespace YireoTraining\ExampleShippingAddressField\Console\Command;

use Magento\Quote\Api\Data\AddressInterfaceFactory as QuoteAddressFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewExampleFieldCommand extends Command
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
        $this->setName('yireo_training_example_shipping_address_field:view');
        $this->setDescription('View shipping address field');
        $this->addArgument('quote_address_id', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $quoteAddressId = $input->getArgument('quote_address_id');
        $collection = $this->addressFactory->create()->getCollection();
        $collection->addFilter('main_table.address_id', $quoteAddressId);

        /** @var \Magento\Quote\Model\Quote\Address $quoteAddress
         */
        $quoteAddress = $collection->getFirstItem();
        $output->writeln('example2 = '.$quoteAddress->getExtensionAttributes()->getExample2());
    }
}
