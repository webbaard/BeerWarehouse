<?php
declare(strict_types=1);

namespace Webbaard\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webbaard\BeerWarehouse\Infra\Beer\Projection\ProjectionFactory;

class ResetProjectionCommand extends Command
{
    const SUCCESS_MESSAGE = 'Projections reset';

    /** @var ProjectionFactory */
    private $projectionFactory;

    public function __construct(ProjectionFactory $projectionFactory)
    {
        $this->projectionFactory = $projectionFactory;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:projections-reset')
            ->setDescription('Reset all projection.')
            ->setHelp('This command resets and runs all the projections');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->projectionFactory->resetAll();

        $output->writeLn(self::SUCCESS_MESSAGE);
    }
}
