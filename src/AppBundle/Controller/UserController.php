<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Entity\Categorie;
use AppBundle\Form\CategorieType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Entity\Question;
use AppBundle\Form\QuestionType;
use AppBundle\Entity\Reponse;
use AppBundle\Form\ReponseType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/edit/{id}", name="users.index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request, User $user, UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
            return $this->redirectToRoute('homepage');
        }
        $status_page = 0;
        $id_utilisateur = $utilisateur->getId();
        $id_utilisateur_url_cheat = explode('/', $_SERVER['REQUEST_URI'])[6];
        if($id_utilisateur == $id_utilisateur_url_cheat) {
            $form = $this->createForm(UserType::class, $user);

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('homepage');
            }
            return $this->render('users/index.html.twig', [
                'status_page' => $status_page,
                'utilisateur' => $utilisateur,
                'form' => $form->createView(),
                'user' => $user
            ]);
        } else {
            $this->addFlash("success", "Votre compte a bien été validée.");
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/create_quizz", name="users.create_quizz")
     * @Method({"GET", "POST"})
     */
    public function create_quizzAction()
    {
        $utilisateur = $this->getUser();
        if ($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 0;
        if($utilisateur) {
            $id_utilisateur = $utilisateur->getId();
        } else {
            return $this->redirectToRoute('homepage');
        }
        if ($id_utilisateur !== null) {
            $repository = $this->getDoctrine()->getRepository('AppBundle:Categorie');

            $categories = $repository->findAll();
            //$formCexistante = $this->createForm(CategorieType::class, $categories);
            //$formCexistante->add('Select Categorie', SubmitType::class);

            $categorie = new Categorie();


            $formCexistante = $this->createForm(CategorieType::class, $categorie);
            $formCexistante->add('name', CheckboxType::class);



            $formC = $this->createForm(CategorieType::class, $categorie);
            $formC->add('Creer Categorie', SubmitType::class);

            $question = new Question();
            $formQ = $this->createForm(QuestionType::class, $question);
            $formQ->add('Creer Question', SubmitType::class);

            $reponse = new Reponse();
            $formR = $this->createForm(ReponseType::class, $reponse);
            $formR->add('Creer Reponse', SubmitType::class);

            /*if($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($reponse);
                $em->flush();
                return $this->redirectToRoute('reponses.index');
            }*/
        }
        return $this->render('users/create_quizz.html.twig', [
            'categories' => $categories,
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'formCexistante' => $formCexistante->createView(),
            'formC' => $formC->createView(),
            'formQ' => $formQ->createView(),
            'formR' => $formR->createView()
        ]);
    }
    /**
     * @Route("/validate/{token}", name="users.validate")
     * @Method("GET")
     */
    public function validateAction($token)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findBy([
            'statusCompte' => $token
        ]);
        if($user) {
            $status_compte = $user[0]->getStatusCompte();
            if($status_compte == $token) {
                $user[0]->setStatusCompte(1);
                $em->flush();
                var_dump($status_compte);
            }
        } else {
            return $this->redirectToRoute('homepage');
        }
        $status_page = 0;
        return $this->redirectToRoute('login');
    }


}