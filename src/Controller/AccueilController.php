<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/", name="accueil_")
 * Class AccueilController
 * @package App\Controller
 */
class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            "page" => "Accueil",
            "message" => "Bonjour E-Commerce"
        ]);
    }
}
