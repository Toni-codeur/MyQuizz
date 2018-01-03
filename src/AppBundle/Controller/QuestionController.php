<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Question;
use AppBundle\Entity\Reponse;
use AppBundle\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    /**
     * @Route("/question", name="questions.index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 1;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Question');
        $questions = $repository->findAllWithCategories();
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->add('Creer', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('questions.index');
        }
        return $this->render('questions/index.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'questions' => $questions,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/question_p_cat/{id}", name="questions.index_p_cat")
     * @Method({"GET", "POST"})
     */
    public function index_p_catAction($id, Request $request)
    {
        $repositor = $this->getDoctrine()->getRepository('AppBundle:Reponse');
        $reponses = $repositor->findAllWithQuestion();

        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 1;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Question');
        $questions = $repository->findAllWithOneCategories($id);
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->add('Creer', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('questions.index');
        }
        return $this->render('questions/index.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'questions' => $questions,
            'reponses' => $reponses,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/question/{id}", name="questions.edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Question $question)
    {
        $utilisateur = $this->getUser();
        $form = $this->createForm(QuestionType::class, $question);
        $form->add('Modifier', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('questions.index');
        }
        return $this->render('questions/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
            'question' => $question
        ]);
    }
}