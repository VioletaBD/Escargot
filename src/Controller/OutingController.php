<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Repository\UserRepository;
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

    #[Route('/outing/inscription/{id}/', name: 'app_inscription')]
    public function addInscription(Outing $outing)
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        if ($user->getInscription($outing)) {
            $user->removeInscription($outing);
        } else {
            $user->addInscription($outing);
        }
    }
}

// #[Route('/', name: 'app_index')]
// public function show(
//     Outing $outing,
//     OutingRepository $outingRepository,
//     UserRepository $userRepository
// ): Response {
    // $inscription = $outing->getUsers()->contains($this->getUser());
    // if (!$quizzDone) {
    //     $form = $this->createForm(InscriptionType::class, $inscription);
    //     $form->handleRequest($request);
    // $outing = $outingRepository->findAll();
    // if ($inscription->isSubmitted() && $form->isValid()) {
    //     /** @var User */
    //     $user = $this->getUser();
    //     $outingId = $userId['inscription'];
    //     $isInscrire = $this->checkInscrire->checkInscription($inscription);
    // } else {
    //     ($isInscrire);
    //     $inscription->addUser($user);
    // }
//     return $this->redirectToRoute(
//         'app_index',
//         [
//             // 'user' => $user->getId(),
//             'outing' => $outing->getId()
//         ]
//     );
// }
