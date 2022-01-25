<?php

namespace App\Command;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SyncCitiesCommand extends Command
{
    protected const DEFAULT_FILENAME = 'public/datas/cities.json';

    protected static $defaultName = 'app:sync:cities';
    protected static $defaultDescription = 'Synchronize cities from json file';

    protected CityRepository $cityRepository;
    protected CountryRepository $countryRepository;
    protected EntityManagerInterface $entityManager;
    protected function configure(): void
    {
        $this->addArgument('file', InputArgument::OPTIONAL, 'json city file');
    }

    /**
     * @param CityRepository $cityRepository
     * @param CountryRepository $countryRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CityRepository $cityRepository, CountryRepository $countryRepository, EntityManagerInterface $entityManager)
    {
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
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
        $country = $this->countryRepository->findOneBy(['code'=>'FR']);
        $citiesData = json_decode(file_get_contents($filePath));
        foreach ($citiesData as $cityData) {
            $city = $this->createCityEntity($cityData->nom, $cityData->code, $country, $cityData->codesPostaux, $cityData->codeDepartement, $cityData->codeRegion);
            $this->save($city);
            unset($city);
        }

        $io->success('Countries synchronized.');

        return Command::SUCCESS;
    }

    /**
     * Get or create city entity
     *
     * @param string $name
     * @param string $code
     * @param Country $country
     * @param array $postcode
     * @param string $department
     * @param string $region
     * @return City
     */
    private function createCityEntity(string $name, string $code, Country $country, array $postcode= [], string $department = '', string $region = '') : City
    {
        $city = $this->cityRepository->findOneBy(['code' => $code]);
        if (is_null($city)) {
            $city = new City();
        }
        $city->setName($name);
        $city->setCode($code);
        $city->setCountry($country);
        $city->setPostcode($postcode);
        $city->setDepartment($department);
        $city->setRegion($region);

        return $city;
    }

    /**
     * Save country
     *
     * @param City $city
     */
    private function save(City $city) : void
    {
        $this->entityManager->persist($city);
        $this->entityManager->flush();
    }
}
