<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $utilisateur = $this->getUser();
        if($utilisateur == null) {
            $utilisateur = 0;
        }
        $status_page = 0;
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUserName= $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:Login:login.html.twig', array(
            'status_page' => $status_page,
            'utilisateur' => $utilisateur,
            'errors' => $errors,
            'username' => $lastUserName,
        ));
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction ()
    {

    }
}
