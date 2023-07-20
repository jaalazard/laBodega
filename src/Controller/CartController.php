<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Pimento;
use App\Entity\User;
use App\Entity\OrderContent;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OrderContentRepository;
use App\Repository\OrderRepository;
use App\Repository\PimentoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use DateTime;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/cart', name: 'cart_', methods: ['GET'])]
class CartController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(SessionInterface $sessionInterface, PimentoRepository $pimentoRepository): Response
    {
        $user = $this->getUser();
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
        return $this->render('cart/index.html.twig', ['user' => $user, 'dataCart' => $dataCart, 'total' => $total]);
    }

    #[Route('/add/{id}', name: 'add', methods: ['GET'])]
    public function add(Pimento $pimento, SessionInterface $sessionInterface): Response
    {
        $user = $this->getUser();
        $cart = $sessionInterface->get('cart', []);
        $id = $pimento->getId();
        if (empty($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }
        $sessionInterface->set('cart', $cart);

        return $this->redirectToRoute('pimento_index', ['user' => $user]);
    }

    #[Route('/remove/{id}', name: 'remove', methods: ['GET'])]
    public function remove(Pimento $pimento, SessionInterface $sessionInterface): Response
    {
        $user = $this->getUser();
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

        return $this->redirectToRoute('cart_index', ['user' => $user]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Pimento $pimento, SessionInterface $sessionInterface): Response
    {
        $user = $this->getUser();
        $cart = $sessionInterface->get('cart', []);
        $id = $pimento->getId();
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $sessionInterface->set('cart', $cart);

        return $this->redirectToRoute('cart_index',['user' => $user]);
    }

    #[Route('/delete', name: 'delete_all', methods: ['GET'])]
    public function deleteAll(SessionInterface $sessionInterface): Response
    {
        $user = $this->getUser();
        $sessionInterface->remove("cart");

        return $this->redirectToRoute('cart_index',['user' => $user]);
    }

    #[Route('/livraison', name: 'delivery', methods: ['GET'])]
    public function delivery(): Response
    {
        $user = $this->getUser();
        
        
        return $this->render('delivery/index.html.twig',['user' => $user]);
    }

    #[Route('/paiement', name: 'payment_index', methods: ['GET'])]
    public function pay(SessionInterface $sessionInterface): Response
    {
        $user = $this->getUser();

        return $this->render('payment/index.html.twig',['user' => $user]);
    }

    #[Route('/paiement/confirmation', name: 'payment_confirmation', methods: ['GET'])]
    public function paymentConfirmation(SessionInterface $sessionInterface,  EntityManagerInterface $entityManager, PimentoRepository $pimentoRepository, OrderRepository $orderRepository, OrderContentRepository $orderContentRepository): Response
    {
        $user = $this->getUser();
        $cart = $sessionInterface->get('cart', []);
        $orderContent = new OrderContent();
        foreach ($cart as $id => $quantity) {
        $orderContent->addProduct($pimentoRepository->find($id));
        $orderContent->setQuantity($quantity);
        $entityManager->persist($orderContent);
        $entityManager->flush($orderContent);
        }

        $date = new \DateTime('now');
        $order = new Order();
        $order->setContent($orderContent);
        $order->setUser($user);
        $order->setCreatedAt($date);
        $order->setReference($order->getUser()->getFirstName()[0] . $order->getUser()->getLastName()[0] . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
        $entityManager->persist($order);
        $entityManager->flush($order);

        foreach($orderContent->getProduct() as $product){
            $stock = $product->getStock();
             $product->setStock($stock - ($orderContent->getQuantity()));
             $entityManager->persist($product);
             $entityManager->flush($product);

        }
        

        $sessionInterface->remove('cart');
        return $this->redirectToRoute('home');
    }


}

