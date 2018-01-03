<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\AppJonathan;
use AppBundle\Entity\Historique_user_quizz;
use AppBundle\Entity\Question;
use AppBundle\Entity\Reponse;
use AppBundle\Form\ReponseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ReponseController extends Controller
{
    /**
     * @Route("/reponse", name="reponses.index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 1;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Reponse');
        $reponses = $repository->findAllWithQuestion();
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->add('Creer', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('reponses.index');
        }
        return $this->render('reponses/index.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'reponses' => $reponses,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/reponse_p_quest/{id}", name="reponses.index_p_quest")
     * @Method({"GET", "POST"})
     */
    public function index_p_questAction($id, Request $request)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 1;
        $repository = $this->getDoctrine()->getRepository('AppBundle:Reponse');
        $reponses = $repository->findAllWithOneQuestion($id);
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->add('Creer', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('reponses.index');
        }
        return $this->render('reponses/index_p_quest.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'reponses' => $reponses,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/reponse/{id}", name="reponses.edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reponse $reponse)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 0;
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->add('Modifier', SubmitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('reponses.index');
        }
        return $this->render('reponses/edit.html.twig', [
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
            'reponse' => $reponse
        ]);
    }

    /**
     * @Route("/score", name="reponses.score")
     */
    public function scoreAction(Request $request)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 0;
        $post = $_POST;
        $em = $this->getDoctrine()->getManager();
        $score = 0;
        $nbr_question = 0;
        $id_cat = null;
        $valueCategorie = array_values($post);
        $categorie = $em->getRepository(Categorie::class)->findBy([
            'id' => $valueCategorie[0],
        ]);
        if(count($categorie) > 0) {
            $id_cat = $categorie[0]->getId();
            $nameCat = $categorie[0]->getName();
        }
        foreach ($post as $key => $value) {
            if(!is_string($key)) {
                $id_question_rep = $key;
                $reponse_question = $value;
                $question = $em->getRepository(Question::class)->findBy([
                    'id' => $id_question_rep,
                ]);
                foreach ($question as $q) {
                    $nbr_question++;
                    $reponse = $em->getRepository(Reponse::class)->findBy([
                        'idQuestion' => $q->getId(),
                    ]);
                }
                foreach ($reponse as $r) {
                    $result_reponse = $r->getCheckReponse();
                    if($result_reponse == 1 && $reponse_question == 1) {
                        $score++;
                    }
                }
            }
        }
        $jonathan = new AppJonathan();
        if($utilisateur) {
            $doublon = $em->getRepository(Historique_user_quizz::class)->findBy([
                'categorieQuizz' => $id_cat,
                'ipUser' => $request->getClientIp()
            ]);
            $product = new Historique_user_quizz();
            $product->setUserId($utilisateur->getId());
            $product->setCategorieQuizz($id_cat);
            $product->setIpUser($request->getClientIp());
            $product->setScore("$score/$nbr_question");
            $product->setCreatedAt($jonathan->date_du_jour);
            $em->persist($product);
            $em->flush();
        } else {
            $doublon = $em->getRepository(Historique_user_quizz::class)->findBy([
                'categorieQuizz' => $id_cat,
                'ipUser' => $request->getClientIp()
            ]);
            if(count($doublon) > 1) {
                 foreach ($doublon as $d) {
                     $start = $d->getCreatedAt()->format('Y-m-d H:i:s');
                     $date_inscrit = $jonathan->date_du_jour;
                     $end = $date_inscrit;
                     $datetime1 = new \DateTime($start);
                     $datetime2 = new \DateTime($end);
                     $interval = $datetime1->diff($datetime2);
                     $compar_dif_sec = $interval->format('%i');
                     if($compar_dif_sec < 10) {
                         $user = $em->getRepository(Historique_user_quizz::class)->findBy([
                             'id' => $d->getId(),
                         ]);
                         foreach ($user as $u) {
                             $em->remove($u);
                             $em->flush();
                         }
                     }
                 }
            }
            $product = new Historique_user_quizz();
            $product->setCategorieQuizz($id_cat);
            $product->setIpUser($request->getClientIp());
            $product->setScore("$score/$nbr_question");
            $product->setCreatedAt($jonathan->date_du_jour);
            $em->persist($product);
            $em->flush();
        }
        return $this->render('reponses/score.html.twig', [
            'nbr_question' => $nbr_question,
            'score' => $score,
            'nameCat' => $nameCat,
            'post' => $post,
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
        ]);
    }
}