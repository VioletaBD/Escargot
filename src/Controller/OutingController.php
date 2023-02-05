<?php

namespace App\Controller;

use App\Repository\OutingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OutingController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(int $id, OutingRepository $outingRepository): Response
    {
        $outings = $outingRepository->find($id);
        return $this->render(
            'home/index.html.twig',
            ['outings' => $outings]
        );
    }

    #[Route('/', name: 'app_index')]
    public function show(OutingRepository $outingRepository): Response
    {
        $outings = $outingRepository->findAll();
        return $this->render(
            'home/index.html.twig',
            ['outings' => $outings]
        );
    }
}
