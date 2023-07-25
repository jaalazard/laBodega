<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
#[Route('/ventes', name: 'sales_')]
class SalesController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('sale/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }
}
