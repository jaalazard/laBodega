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
#[Route('/admin/pimento', name: 'admin_pimento_')]
class AdminPimentoController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PimentoRepository $pimentoRepository): Response
    {
        return $this->render('adminPimento/index.html.twig', [
            'pimentos' => $pimentoRepository->findAll(),
        ]);
    }
}
