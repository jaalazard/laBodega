<?php

namespace App\Controller;

use App\Entity\Pimento;
use App\Repository\PimentoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/cart', name: 'cart_', methods: ['GET'])]
class CartController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(SessionInterface $sessionInterface, PimentoRepository $pimentoRepository): Response
    {
        $cart = $sessionInterface->get('cart', []);
        $dataCart = [];
        $total = 0;

        foreach ($cart as $id => $quantity) {
            $pimento = $pimentoRepository->find($id);
            $dataCart[] = [
                'pimento' => $pimento,
                'quantity' => $quantity
            ];
            $total += $pimento->getPrice() * $quantity;
        }
        return $this->render('cart/index.html.twig', compact('dataCart', 'total'));
        
    }

    #[Route('/add/{id}', name: 'add', methods: ['GET'])]
    public function add(Pimento $pimento, SessionInterface $sessionInterface): Response
    {
        $cart = $sessionInterface->get('cart', []);
        $id = $pimento->getId();
        if (empty($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }
        $sessionInterface->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/remove/{id}', name: 'remove', methods: ['GET'])]
    public function remove(Pimento $pimento, SessionInterface $sessionInterface): Response
    {
        $cart = $sessionInterface->get('cart', []);
        $id = $pimento->getId();
        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }
        $sessionInterface->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Pimento $pimento, SessionInterface $sessionInterface): Response
    {
        $cart = $sessionInterface->get('cart', []);
        $id = $pimento->getId();
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $sessionInterface->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/delete', name: 'delete_all', methods: ['GET'])]
    public function deleteAll(SessionInterface $sessionInterface): Response
    {
        $sessionInterface->remove("cart");

        return $this->redirectToRoute('cart_index');
    }

    #[Route('/livraison', name: 'delivery', methods: ['GET'])]
    public function delivery(): Response
    {
        return $this->render('delivery/index.html.twig');
    }

    #[Route('/paiement', name: 'payment', methods: ['GET'])]
    public function pay(SessionInterface $sessionInterface): Response
    {
        $sessionInterface->remove("cart");
        return $this->render('payment/index.html.twig');
    }
}
