<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddToCartFormType;
use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use App\ShoppingCart\CartManager;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET","POST"})
     */
    public function show(Product $product, Request $request, CartManager $cartManager): Response
    {
        $form = $this->createForm(AddToCartFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($product);
            $cart = $cartManager->getCurrentCart();
            $cart->addItem($item);
            $cartManager->save($cart);

            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        }

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
