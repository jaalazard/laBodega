<?php

namespace App\Controller;

use App\Entity\Pimento;
use App\Form\PimentoType;
use App\Repository\PimentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PimentoRepository $pimentoRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'pimentos' => $pimentoRepository->findAll(),
        ]);
    }

    #[Route('/piment/ajouter', name: 'pimento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PimentoRepository $pimentoRepository): Response
    {
        $pimento = new Pimento();
        $form = $this->createForm(PimentoType::class, $pimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pimentoRepository->save($pimento, true);

            return $this->redirectToRoute('admin_pimento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminPimento/new.html.twig', [
            'pimento' => $pimento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'pimento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pimento $pimento, PimentoRepository $pimentoRepository): Response
    {
        $form = $this->createForm(PimentoType::class, $pimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pimentoRepository->save($pimento, true);

            return $this->redirectToRoute('admin_pimento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminPimento/edit.html.twig', [
            'pimento' => $pimento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pimento_delete', methods: ['POST'])]
    public function delete(Request $request, Pimento $pimento, PimentoRepository $pimentoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pimento->getId(), $request->request->get('_token'))) {
            $pimentoRepository->remove($pimento, true);
        }

        return $this->redirectToRoute('admin_pimento_index', [], Response::HTTP_SEE_OTHER);
    }
}