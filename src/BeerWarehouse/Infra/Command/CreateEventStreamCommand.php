<?php
declare(strict_types=1);

namespace Webbaard\BeerWarehouse\Infra\Command;

use Prooph\EventStore\EventStore;
use Prooph\EventStore\Stream;
use Prooph\EventStore\StreamName;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateEventStreamCommand extends ContainerAwareCommand
{
    const EVENT_STREAM_NAME = 'event_stream';

    protected function configure()
    {
        $this->setName('event-store:event-stream:create')
            ->setDescription('Create event_stream.')
            ->setHelp('This command creates the event_stream');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EventStore $eventStore */
        $eventStore = $this->getContainer()->get('prooph_event_store.beer_store');
        $streamName = new StreamName(self::EVENT_STREAM_NAME);
        if (!$eventStore->hasStream($streamName)) {
            $eventStore->create(new Stream($streamName, new \ArrayIterator([])));
            $output->writeln('<info>Event stream was created successfully.</info>');
        } else {
            $output->writeln('<info>Event stream was already created.</info>');
        }
    }
}
