<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\PimentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user', name: 'user_', methods: ['GET', 'POST'])]
class UserController extends AbstractController
{
    #[Route('/{id}/profil', name: 'profile', methods: ['GET', 'POST'])]
    public function profile(User $user, UserRepository $userRepository, Request $request): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();
        $orders = $user->getOrders();
        return $this->render('user/profile.html.twig', [
            'user' => $user, 'orders' => $orders,
        ]);
    }


    #[Route('/{id}/profil/modifier', name: 'profile_edit', methods: ['GET', 'POST'])]
    public function profile_edit(User $user, UserRepository $userRepository, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('home');
        }
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
