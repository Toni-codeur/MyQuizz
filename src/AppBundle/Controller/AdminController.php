<?php

namespace AppBundle\Controller;

use AppBundle\AppJonathan;
use AppBundle\Entity\User;
use AppBundle\Entity\InfosUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin_gestion_membres", name="admins.index")
     */
    public function indexAction()
    {
        $jonathan = new AppJonathan();
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 0;
        if($utilisateur) {
            $id_utilisateur = $utilisateur->getId();
        } else {
            return $this->redirectToRoute('homepage');
        }
        if($id_utilisateur == 1) {
            $em = $this->getDoctrine()->getManager();
            $infos_user = $em->getRepository(InfosUser::class)->findBy([
                'idUser' => 1
            ]);
            foreach($infos_user as $u) {
                $em->remove($u);
                $em->flush();
            }
            $infoInscrit = $em->getRepository(InfosUser::class)->findBy([
                'inscrit' => 1
            ]);
            $infoVisiteur = $em->getRepository(InfosUser::class)->findBy([
                'visiteur' => 1
            ]);
            $nb_inscrit24 = [];
            $nb_visiteur24 = [];
            $nb_inscritM = [];
            $nb_visiteurM = [];
            $nb_inscritY = [];
            $nb_visiteurY = [];
            foreach($infoInscrit as $inscrit) {
                $jonathan->comparDate($inscrit->getCreatedAt());
                if($jonathan->compar_dif_mois == 0 && $jonathan->compar_dif_year == 0) {
                    array_push($nb_inscrit24, $inscrit);
                }
                if($jonathan->compar_dif_year == 0 && $jonathan->compar_dif_mois <= 1) {
                    array_push($nb_inscritM, $inscrit);
                }
                if($jonathan->compar_dif_year <= 1) {
                    array_push($nb_inscritY, $inscrit);
                }
            }
            foreach($infoVisiteur as $visiteur) {
                $jonathan->comparDate($visiteur->getCreatedAt());
                if($jonathan->compar_dif_mois == 0 && $jonathan->compar_dif_year == 0) {
                    array_push($nb_visiteur24, $visiteur);
                }
                if($jonathan->compar_dif_year == 0 && $jonathan->compar_dif_mois <= 1) {
                    array_push($nb_visiteurM, $visiteur);
                }
                if($jonathan->compar_dif_year <= 1) {
                    array_push($nb_visiteurY, $visiteur);
                }
            }
            $pieChart = $jonathan->graphCircle(
                'Nombre de visiteur 24H',
                400,
                400,
                '#076000',
                25,
                'Inscrit',
                'Visiteur',
                $nb_inscrit24,
                $nb_visiteur24);

            $pieChartM = $jonathan->graphCircle(
                'Nombre de visiteur dernier mois',
                400,
                400,
                '#076000',
                25,
                'Inscrit',
                'Visiteur',
                $nb_inscritM,
                $nb_visiteurM);
            $pieChartY = $jonathan->graphCircle(
                'Nombre de visiteur derniere année',
                400,
                400,
                '#076000',
                25,
                'Inscrit',
                'Visiteur',
                $nb_inscritY,
                $nb_visiteurY);

            $repository = $this->getDoctrine()->getRepository('AppBundle:User');
            $users = $repository->findAll();
            foreach($users as $user) {
                if($user->getDateConnexion() != null) {
                    $jonathan->comparDate($user->getDateConnexion());
                    $nbmonth = $jonathan->compar_dif_mois;
                    if($nbmonth >= 1) {
                        $em = $this->getDoctrine()->getManager();
                        $product = $em->getRepository(User::class)->find($user->getId());
                        $product->setMois($nbmonth);
                        $em->flush();
                    }
                }
            }
            return $this->render('admins/index.html.twig', [
                'piechart' => $pieChart,
                'piechartM' => $pieChartM,
                'piechartY' => $pieChartY,
                'status_page' => $status_page,
                'utilisateur' => $utilisateur,
                'users' => $users,
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/admins_email_co/{id}", name="admins.email_co")
     * @Method("GET")
     */
    public function email_coAction($id, \Swift_Mailer $mailer)
    {
        $jonathan = new AppJonathan();
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $id_utilisateur = $utilisateur->getId();
        if($id_utilisateur == 1) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $name_user = $user->getUsername();
            $email_user = $user->getEmail();
            $nbmonth = $user->getMois();
            $jonathan->sendMail(
                $mailer,
                "Vous nous manquez $name_user",
                $email_user,
                'Quizz@quizzy.com',
                "Hello cela fait plus de $nbmonth Mois que vous vous ete pas connecter. 
                Vous nous manquez, de nouveau quizz son present."
            );
        } else {
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('admins.index');
    }

    /**
     * @Route("/admins_email_rappel_validation_compte/{id}", name="admins.email_rappel_validation_compte")
     * @Method("GET")
     */
    public function email_rappel_validation_compteAction($id, \Swift_Mailer $mailer)
    {
        $jonathan = new AppJonathan();
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $id_utilisateur = $utilisateur->getId();
        if($id_utilisateur == 1) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $name_user = $user->getUsername();
            $email_user = $user->getEmail();
            $token = $user->getStatusCompte();
            $jonathan->sendMail(
                $mailer,
                "Validée votre compte $name_user",
                $email_user,
                'Quizz@quizzy.com',
                "Vous vous ete inscrit il y à peut mais vous n'avez toujours pas validée votre compte. <br/>
                <a href=\"http://localhost/PHP_Avance_my_quiz/symfony_my_quiz/web/app_dev.php/validate/$token\">Valider votre compte</a>"
            );
        } else {
            return $this->redirectToRoute('homepage');
        }
        return $this->redirectToRoute('admins.index');
    }

    /**
     * @Route("/admins_info_user/{id}", name="admins.email")
     * @Method("GET")
     */
    public function emailAction($id, \Swift_Mailer $mailer)
    {
        $jonathan = new AppJonathan();
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $id_utilisateur = $utilisateur->getId();
        $status_page = 0;
        if($id_utilisateur == 1) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $name_user = $user->getUsername();
            $email_user = $user->getEmail();
            $jonathan->comparDate($user->getDateConnexion());
            return $this->render('admins/email.html.twig', [
                'infosInnactif' => $jonathan->compar_infos_precise,
                'status_page' => $status_page,
                'utilisateur' => $utilisateur,
                'user' => $user
            ]);
        } else {
            return $this->redirectToRoute('homepage');
        }

        return $this->redirectToRoute('admins.index');
    }

    /**
     * @Route("/admins_delete/{id}", name="admins.delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        $em = $this->getDoctrine()->getManager();
        $infos_user = $em->getRepository(InfosUser::class)->findBy([ 'idUser' => $id ]);
        foreach($infos_user as $u) {
            $em->remove($u);
            $em->flush();
        }
       /* $jonathan = new AppJonathan();
        $jonathan->deleteInfosUser($id);
        $jonathan->deleteMembre($id); */
        return $this->redirectToRoute('admins.index');
    }
}