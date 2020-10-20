<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Tag;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/products")
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
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $tags = explode(',', $form->get('tags')->getData());

            if (count($tags)) {
                foreach ($tags as $name) {
                    // find if it is exist
                    $t = $entityManager->getRepository(Tag::class)->findOneBy(['name' => strtolower($name)]);
                    if (!$t) {
                        $tag = new Tag();
                        $tag->setName(strtolower($name));
                        $tag->addProduct($product);
                        $product->addTag($tag);
                        $entityManager->persist($tag);
                    }
                }
            }

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $tags = array_map(function ($tag){ return $tag->getName(); }, $product->getTags()->toArray());

        $form = $this->createForm(ProductType::class, $product, ['tags' => $tags]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $tags = explode(',', $form->get('tags')->getData());

            if (count($tags)) {
                foreach ($tags as $name) {
                    // find if it is exist
                    $t = $entityManager->getRepository(Tag::class)->findOneBy(['name' => strtolower($name)]);
                    if (!$t) {
                        $tag = new Tag();
                        $tag->setName(strtolower($name));
                        $tag->addProduct($product);
                        $product->addTag($tag);
                        $entityManager->persist($tag);
                    }
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
