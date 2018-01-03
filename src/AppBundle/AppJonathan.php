<?php
namespace AppBundle;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Entity\InfosUser;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppJonathan extends Controller
{
    /********VARIABLE CALCULE DATE*********/
    public $date_du_jour;
    public $compar_infos_precise; public $compar_dif_minute; public $compar_dif_heure;
    public $compar_dif_day; public $compar_dif_mois; public $compar_dif_year; public $compar_dif_sec;
    /*********END VARIABLE CALCULE DATE****/
    /********VARIABLE DB*******************/
    function __construct()
    {
        $this->date_du_jour = date('Y-m-d H:i:s');
    }

    /*********DEBUG*********/
    public function debug($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
    /********COMPAR DATE****/
    public function comparDate($quelDate)
    {
        $start = $this->date_du_jour;
        $date_inscrit = $quelDate->format('Y-m-d H:i:s');
        $end = $date_inscrit;
        $datetime1 = new \DateTime($start);
        $datetime2 = new \DateTime($end);
        $interval = $datetime1->diff($datetime2);
        $this->compar_infos_precise = $interval->format('Année:%y Mois:%m Jours:%d Heures:%h Minutes:%i Secondes:%s'); //Ret
        $this->compar_dif_minute = $interval->format('%i');
        $this->compar_dif_heure = $interval->format('%h');
        $this->compar_dif_day = $interval->format('%d');
        $this->compar_dif_mois = $interval->format('%m');
        $this->compar_dif_year = $interval->format('%y');
        $this->compar_dif_sec = $interval->format('%i');
    }
    /*********GRAPH CIRCLE******/
    public function graphCircle($title, $height, $width, $colorTitle, $sizeTitle, $titreOne, $titreTwo, $contentOne, $contentTwo)
    {
        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable( array(
            ['Task', 'Hours per Day'],
            [$titreOne, count($contentOne)],
            [$titreTwo, count($contentTwo)],
        ));
        $pieChart->getOptions()->setTitle($title);
        $pieChart->getOptions()->setHeight($height);
        $pieChart->getOptions()->setWidth($width);
        $pieChart->getOptions()->getTitleTextStyle()->setColor($colorTitle);
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize($sizeTitle);
        return $pieChart;
    }
    /********DELETE INFOS USER******/
    public function deleteInfosUser($id)
    {
        $em = $this->getDoctrine()->getManager();
        $infos_user = $em->getRepository(InfosUser::class)->findBy([ 'idUser' => $id ]);
        foreach($infos_user as $u) {
            $this->em->remove($u);
            $this->em->flush();
        }
    }
    /*******DELETE USER*********/
    public function deleteMembre($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $this->em->remove($user);
        $this->em->flush();
    }
    /**********SEND EMAIL********/
    public function sendMail($mail, $title, $destinataire, $expediteur, $content)
    {
        $message = (new \Swift_Message($title))
            ->setFrom($destinataire)
            ->setTo($expediteur)
            ->setBody($content);
        $mail->send($message);
    }
}