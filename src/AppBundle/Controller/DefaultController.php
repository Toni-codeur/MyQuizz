<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categorie;
use AppBundle\Entity\Historique_user_quizz;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\InfosUser;
use AppBundle\AppJonathan;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $jonathan = new AppJonathan();

        $ip_user = $request->getClientIp();
        $em = $this->getDoctrine()->getManager();
        $infoDouble = $em->getRepository(InfosUser::class)->findBy([
            'ipUser' => $ip_user
        ]);
        foreach($infoDouble as $u) {
            $jonathan->comparDate($u->getCreatedAt());
            $dif_day = $jonathan->compar_dif_day;
            if($dif_day == 0) {
                $em->remove($u);
                $em->flush();
            }
        }
        $result_string = [];
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
            $infos_user = new InfosUser();
            $infos_user->setVisiteur(1);
            $infos_user->setIpUser($ip_user);
            $infos_user->setCreatedAt($jonathan->date_du_jour);
            $em->persist($infos_user);
            $em->flush();

            $infosUser = $em->getRepository(Historique_user_quizz::class)->findBy([
                'ipUser' => $request->getClientIp()
            ]);
            if(count($infosUser) > 0) {
                foreach ($infosUser as $i) {
                    $categorie = $em->getRepository(Categorie::class)->findBy([
                        'id' => $i->getCategorieQuizz()
                    ]);
                    foreach ($categorie as $c) {
                        $name = $c->getName();
                        $score = $i->getScore();
                        $date = $i->getCreatedAt()->format('Y-m-d H:i:s');
                        array_push($result_string, "$name Score: $score Le: $date");
                    }
                }
            }
        }
        $status_page = 0;

        if($this->getUser()) {
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(User::class)->find($utilisateur->getId());
            $product->setDateConnexion($jonathan->date_du_jour);
            $em->flush();

            $infos_user = new InfosUser();
            $infos_user->setInscrit(1);
            $infos_user->setIpUser($ip_user);
            $infos_user->setIdUser($utilisateur->getId());
            $infos_user->setCreatedAt($jonathan->date_du_jour);
            $em->persist($infos_user);
            $em->flush();

            $infosUser = $em->getRepository(Historique_user_quizz::class)->findBy([
                'userId' => $utilisateur->getId()
            ]);
            if(count($infosUser) > 0) {
                foreach ($infosUser as $i) {
                    $categorie = $em->getRepository(Categorie::class)->findBy([
                        'id' => $i->getCategorieQuizz()
                    ]);
                    foreach ($categorie as $c) {
                        $name = $c->getName();
                        $score = $i->getScore();
                        $date = $i->getCreatedAt()->format('Y-m-d H:i:s');
                        array_push($result_string, "$name Score: $score Le: $date");
                    }
                }
            }
        }
        return $this->render('default/index.html.twig', [
            'histo_user_quizz' => $result_string,
            'status_page' => $status_page,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'utilisateur' => $utilisateur
        ]);
    }
}
