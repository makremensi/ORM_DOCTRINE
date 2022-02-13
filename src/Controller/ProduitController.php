<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
Use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProduitController extends AbstractController
{
    /**
     * @Route("/listProduit", name="list_produit")
     */
    public function index(): Response
    {
        //return $this->render('produit/index.html.twig', ['controller_name' => 'ProduitController',]);
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAll();
        if (!$produits) {
            throw $this->createNotFoundException('No products in database');
        }
        else {
            return $this->render('produit/list.html.twig',['produits' => $produits]);
        }
    }

    /**
     * @Route("/createProduit", name="create_produit")
     */
    public function createProduit(ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Produit();
        $product->setLibelle('Smart Phone');
        $product->setPrix('alpha');
        $product->setDescription('Samsung M10');
        $product->setFournisseur('Samsung');

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) errors, 400);
        }
        else {
            $entityManager->persist($product);
            $entityManager->flush();
            return new Response('Produit avec id '.$product->getId().' ajouté avec succès');
        }
    }

    /**
     * @Route("/showProduit/{id}", name="show_produit")
     */
    public function showProduit($id): Response {
        $produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        if (!$produit) {
            return new Response('Produit avec id '.$id.' introuvable');
        }
        return new Response('Le produit recherché est '.$produit->getDescription());
    }

    /**
     * @Route("/editProduit/{id}", name="edit_produit")
     */
    public function editProduit($id) {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        if (!$produit) {
            throw $this->createNotFoundException('Produit introuvable');
        }
        $produit->setDescription('Iphone');
        $em->flush();
        return $this->redirectToRoute('show_produit',['id' => $produit->getId()]);
    }

    /**
     * @Route("/supprProduit/{id}", name="suppr_produit")
     */
    public function supprProduit($id) {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('list_produit');
    }

    /**
     * @Route("/find", name="find")
     */
    public function findGreat() {
        $prix = 600;
        $produits = $this->getDoctrine()->getRepository(Produit::class)->findAllGreaterThanQB($prix);
        if (!$produits) {
            return new Response('No products found');
//            throw $this->createNotFoundException('No products found');
        }
        else {
            return $this->render('produit/list.html.twig', ['produits' => $produits]);
        }
    }

}
