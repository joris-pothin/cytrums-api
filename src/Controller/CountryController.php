<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    protected CountryRepository $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @Route("/api/countries/code/{code}",
     *     name="get_country_by_code",
     *     methods={"GET"},
     * )
     */
    public function getCountryByCode(string $code): Response
    {
        $result = $this->countryRepository->findOneBy(['code' => $code]);

        return $this->json($result);
    }
}
