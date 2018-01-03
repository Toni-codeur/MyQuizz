<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\AppJonathan;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 0;
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $jonathan = new AppJonathan();
            $length = 33;
            $alphabet = "0123456789";
            $length = substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
            // Create the user
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $user->setStatusCompte($length);
            $name_user = $user->getUsername();
            $email_user = $user->getEmail();
            $token = $user->getStatusCompte();
            $em->persist($user);
            $em->flush();
            $jonathan->sendMail(
                $mailer,
                "Valider votre compte Quizzy",
                $email_user,
                'Quizz@quizzy.com',
                "Hello $name_user veuillez valider votre compte Quizzy <br/> 
                <a href=\"http://localhost/PHP_Avance_my_quiz/symfony_my_quiz/web/app_dev.php/validate/$token\">Valider votre compte</a>"
            );
            return $this->redirectToRoute('login');
        }
        return $this->render('AppBundle:Register:register.html.twig', array(
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
           'form' => $form->createView()
        ));
    }

}
