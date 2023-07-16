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

class ScovilleController extends AbstractController
{
    #[Route('/scoville', name: 'scoville_index', methods: ['GET'])]
    public function accueil(PimentoRepository $pimentoRepository): Response
    {
        return $this->render('scoville/index.html.twig', [
        ]);
    }
}