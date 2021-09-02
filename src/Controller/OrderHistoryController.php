<?php


namespace App\Controller;

use App\Entity\Order;
use App\Entity\User;
use App\ShoppingCart\CartManager;
use DateTime;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderHistoryController extends AbstractController
{
    /**
     * @Route("/order_history", name="orderHistoty")
     */
    public function index(UserRepository $userRepository, OrderRepository $orderRepository): Response
    {
        $orders = $this->getUser()->getOrders();

        return $this->render('orderHistory/index.html.twig', [
            'orders' => $orders,
        ]);
    }

}