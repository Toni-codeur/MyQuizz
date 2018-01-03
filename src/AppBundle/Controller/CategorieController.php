<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CategorieController extends Controller
{
    /**
     * @Route("/categories", name="categories.index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 1;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Categorie');
        $categories = $repository->findAll();
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->add('Creer', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categories.index');
        }
        return $this->render('categories/index.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categories.edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Categorie $categorie)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 1;
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->add('Modifier', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('categories.index');
        }
        return $this->render('categories/edit.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
            'categorie' => $categorie
        ]);
    }
}