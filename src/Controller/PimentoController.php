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

#[Route('/pimento')]
class PimentoController extends AbstractController
{
    #[Route('/', name: 'pimento_index', methods: ['GET'])]
    public function index(PimentoRepository $pimentoRepository): Response
    {
        return $this->render('pimento/index.html.twig', [
            'pimentos' => $pimentoRepository->findAll(),
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
