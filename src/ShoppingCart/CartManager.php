<?php


namespace App\ShoppingCart;

use App\Entity\Order;
use App\ShoppingCart\OrderFactory;
use App\ShoppingCart\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;


class CartManager
{
    private $cartSessionStorage;

    private $cartFactory;

    private $entityManager;


    public function __construct(
        CartSessionStorage $cartStorage,
        OrderFactory $orderFactory,
        EntityManagerInterface $entityManager
    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->cartFactory = $orderFactory;
        $this->entityManager = $entityManager;
    }

    public function getCurrentCart(): Order
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create();
        }

        return $cart;
    }

    public function save(Order $cart): void
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        $this->cartSessionStorage->setCart($cart);
    }

}