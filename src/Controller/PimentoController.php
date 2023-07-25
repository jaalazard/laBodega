<?php

namespace App\Controller;

use App\Entity\Pimento;
use App\Entity\PimentoSearch;
use App\Form\PimentoSearchType;
use App\Repository\PimentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pimento')]
class PimentoController extends AbstractController
{
    #[Route('/', name: 'pimento_index')]
    public function index(PimentoRepository $pimentoRepository, Request $request): Response
    {
        $pimentoSearch = new PimentoSearch();
        $form = $this->createForm(PimentoSearchType::class, $pimentoSearch);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pimentos = $pimentoRepository->searchPimento($pimentoSearch);
        } else {
            $pimentos = $pimentoRepository->findAll();
        }
        return $this->render('pimento/index.html.twig', [
            'pimentos' => $pimentos,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pimento_show', methods: ['GET'])]
    public function show(Pimento $pimento): Response
    {
        return $this->render('pimento/show.html.twig', [
            'pimento' => $pimento,
        ]);
    }
}
