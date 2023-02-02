<?php

namespace App\Controller;

use App\Repository\OutingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OutingController extends AbstractController
{
    #[Route('/sortie', name: 'app_outing')]
    public function index(OutingRepository $outingRepository): Response
    {
        $outings = $outingRepository->findAll();
        return $this->render(
            'home/outing.html.twig',
            ['outings' => $outings]
        );
    }
}
