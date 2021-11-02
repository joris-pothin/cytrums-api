<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("api/default", name="default", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json([
                "content" => "Hello World",
            ]
        );
    }
}
