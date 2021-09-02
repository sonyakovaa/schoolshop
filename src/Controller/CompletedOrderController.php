<?php


namespace App\Controller;


use App\Entity\Order;
use App\ShoppingCart\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompletedOrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(CartManager $cartManager, Request $request): Response
    {
        $cart = $cartManager->getOrder();
        $cart->setStatus('order');
        $cart->setUserOrder($this->getUser());
        $cartManager->save($cart);

        return $this->render('order/index.html.twig', [
            'cart' => $cart,
        ]);
    }

}