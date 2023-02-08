<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\OutingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/evenement/show/{id}', name: 'app_evenement', methods: ['GET', 'POST'])]
    public function evenement(
        Request $request,
        User $user,
        UserRepository $userRepository,
        Outing $outing
    ): Response {
        /** @var User */
        $user = $this->getUser('inscription');
        $insctiption('inscription');
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscription['inscription']->setUser($user);
            $inscription['inscription']->setOuting($outing);
            $userRepository->save($user, true);
            $this->addFlash('success', 'Vous vous êtes ajouté avec succès comme participant à cet événement.');
            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('index/event_form.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}