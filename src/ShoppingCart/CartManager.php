<?php


namespace App\ShoppingCart;

use App\Entity\Order;
use App\ShoppingCart\OrderFactory;
use App\ShoppingCart\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;


class CartManager
{
    private \App\ShoppingCart\CartSessionStorage $cartSessionStorage;

    private \App\ShoppingCart\OrderFactory $cartFactory;

    private EntityManagerInterface $entityManager;


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

    public function getOrder(): Order
    {
        return $this->cartSessionStorage->getCart();
    }

    public function save(Order $cart): void
    {
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        $this->cartSessionStorage->setCart($cart);
    }

}