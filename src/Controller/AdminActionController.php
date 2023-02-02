<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Form\Outing1Type;
use App\Repository\OutingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/action')]
class AdminActionController extends AbstractController
{
    #[Route('/', name: 'app_admin_action_index', methods: ['GET'])]
    public function index(OutingRepository $outingRepository): Response
    {
        return $this->render('admin_action/index.html.twig', [
            'outings' => $outingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_action_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OutingRepository $outingRepository): Response
    {
        $outing = new Outing();
        $form = $this->createForm(Outing1Type::class, $outing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outingRepository->save($outing, true);

            return $this->redirectToRoute('app_admin_action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_action/new.html.twig', [
            'outing' => $outing,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_action_show', methods: ['GET'])]
    public function show(Outing $outing): Response
    {
        return $this->render('admin_action/show.html.twig', [
            'outing' => $outing,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_action_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Outing $outing, OutingRepository $outingRepository): Response
    {
        $form = $this->createForm(Outing1Type::class, $outing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outingRepository->save($outing, true);

            return $this->redirectToRoute('app_admin_action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_action/edit.html.twig', [
            'outing' => $outing,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_action_delete', methods: ['POST'])]
    public function delete(Request $request, Outing $outing, OutingRepository $outingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outing->getId(), $request->request->get('_token'))) {
            $outingRepository->remove($outing, true);
        }

        return $this->redirectToRoute('app_admin_action_index', [], Response::HTTP_SEE_OTHER);
    }
}
