<?php

namespace App\Controller;

use App\Entity\Pimento;
use App\Form\PimentoType;
use App\Repository\PimentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class AdminPimentoController extends AbstractController
{
    #[Route('/', name: '_pimento_index', methods: ['GET'])]
    public function index(PimentoRepository $pimentoRepository): Response
    {
        return $this->render('adminPimento/index.html.twig', [
            'pimentos' => $pimentoRepository->findAll(),
        ]);
    }

    #[Route('/piment/ajouter', name: 'pimento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pimento = new Pimento();
        $form = $this->createForm(PimentoType::class, $pimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pimento);
            $entityManager->flush();

            return $this->redirectToRoute('pimento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminPimento/new.html.twig', [
            'pimento' => $pimento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'pimento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pimento $pimento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PimentoType::class, $pimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('pimento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pimento/edit.html.twig', [
            'pimento' => $pimento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pimento_delete', methods: ['POST'])]
    public function delete(Request $request, Pimento $pimento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pimento->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pimento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pimento_index', [], Response::HTTP_SEE_OTHER);
    }
}
