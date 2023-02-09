<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Outing;
use App\Repository\UserRepository;
use App\Repository\OutingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/evenement/show/{id}', name: 'app_evenement', methods: ['GET', 'POST'])]
    public function evenement(Outing $outing, OutingRepository $outingRepository):Response
    {
        $outing->addInscription($this->getUser());
        $outingRepository->save($outing, true);
        return $this->render('home/index.html.twig');
    }
    //     Request $request,
    //     User $user,
    //     UserRepository $userRepository,
    //     Outing $outing
    // ): Response {
    //     $form = $this->createForm(InscriptionType::class);
    //     $form->handleRequest($request);
    //     /** @var User */
    //     $user = $this->getUser('inscription');

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $userRepository->save($user, true);
    //         $this->addFlash('success', 'Vous vous êtes ajouté avec succès comme participant à cet événement.');
    //         return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->renderForm('index/event_form.html.twig', [
    //         'user' => $user,
    //         'form' => $form,
    //     ]);
}