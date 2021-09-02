<?php


namespace App\Controller;


use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderHistoryController extends AbstractController
{
    /**
     * @Route("/order_history", name="orderHistoty")
     */
    public function index(UserRepository $userRepository, OrderRepository $orderRepository): Response
    {
        $userLogged = $this->getUser()->getUserIdentifier();
        $userHistory = $userRepository->findOneBy(['email' => $userLogged]);
    }

}