<?php


namespace App\Command;

use App\Entity\Responsable;
use App\Entity\Seminario;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegenerateSlugs extends Command
{
    private $doctrine;

    protected static $defaultName = "app:regenerate-slugs";

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct();

        $this->doctrine = $doctrine;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Regenerate the slugs for all Foo and Bar entities.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $manager = $this->doctrine->getManager();

        // Change the next line by your classes
        foreach ([Seminario::class] as $class) {
            foreach ($manager->getRepository($class)->findAll() as $entity) {
                $entity->setSlug(null);
                //$entity->slug = null; // If you use public properties
            }

            $manager->flush();
            $manager->clear();

            $output->writeln("Slugs of \"$class\" updated.");
        }
    }
}