<?php

namespace App\Command;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SyncCountriesCommand extends Command
{
    protected const DEFAULT_FILENAME = 'public/datas/countries.json';

    protected static $defaultName = 'app:sync-countries';
    protected static $defaultDescription = 'Synchronize countries from json file';

    protected CountryRepository $countryRepository;
    protected EntityManagerInterface $entityManager;

    public function __construct(CountryRepository $countryRepository, EntityManagerInterface $entityManager)
    {
        $this->countryRepository = $countryRepository;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('file', InputArgument::OPTIONAL, 'json country file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Get file
        $filePath = ($input->getArgument('file')) ? $input->getArgument('file') : self::DEFAULT_FILENAME;
        if (!file_exists($filePath)) {
            $io->error('File not exists');

            return Command::INVALID;
        }

        // use datas
        $countriesData = json_decode(file_get_contents($filePath));
        foreach ($countriesData as $countryData) {
            $country = $this->createCountryEntity($countryData->altSpellings[0], $countryData->name->common);
            $this->save($country);
            unset($country);
        }

        $io->success('Countries synchronized.');

        return Command::SUCCESS;
    }

    /**
     * Get or create Country entity
     *
     * @param string $code
     * @param string $name
     *
     * @return Country
     */
    private function createCountryEntity(string $code, string $name) : Country
    {
        $country = $this->countryRepository->findOneBy(['code' => $code]);
        if (is_null($country)) {
            $country = new Country();
        }
        $country->setCode($code);
        $country->setName($name);

        return $country;
    }

    /**
     * Save country
     *
     * @param Country $country
     */
    private function save(Country $country) : void
    {
        $this->entityManager->persist($country);
        $this->entityManager->flush();
    }
}
