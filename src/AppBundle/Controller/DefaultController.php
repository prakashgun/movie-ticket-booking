<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $user = $this->getUser();

        if($user instanceof User){

            if(in_array('ROLE_ADMIN', $user->getRoles())){
               dump("yes")         ;
            }else{
                dump("no");
            }

        }else{
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/book", name="book")
     */
    public function bookAction(Request $request)
    {
        $user = $this->getUser();

        if($user instanceof User){
            dump("Start bookinh")            ;

            return $this->render('default/index.html.twig');

        }else{
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }
}
