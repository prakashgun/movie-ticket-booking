<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Book;
use AppBundle\Form\BookType;

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
                return $this->redirect($this->generateUrl('status'));               
            }else{
                return $this->redirect($this->generateUrl('book'));
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
            $book = new Book();
            $book->setUser($user);
            $form = $this->createForm(BookType::class, $book);

                $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $book = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($book);
                $entityManager->flush();

            }

            return $this->render('default/book.html.twig', ['form' => $form->createView()]);

        }else{
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }

        /**
     * @Route("/status", name="status")
     */
    public function statusAction(Request $request)
    {

        $bookRepository = $this->getDoctrine()
        ->getRepository(Book::class);

                    $today_morning_booked = $bookRepository->status('today', 'morning');
                    $today_evening_booked = $bookRepository->status('today', 'evening');
                    $today_night_booked = $bookRepository->status('today', 'night');

                    $tomorrow_morning_booked = $bookRepository->status('tomorrow', 'morning');
                    $tomorrow_evening_booked = $bookRepository->status('tomorrow', 'evening');
                    $tomorrow_night_booked = $bookRepository->status('tomorrow', 'night');

                    $day_after_tomorrow_morning_booked = $bookRepository->status('day_after_tomorrow', 'morning');
                    $day_after_tomorrow_evening_booked = $bookRepository->status('day_after_tomorrow', 'evening');
                    $day_after_tomorrow_night_booked = $bookRepository->status('day_after_tomorrow', 'night');

        return $this->render('default/status.html.twig', 
                [
                    'today_morning_booked' => $today_morning_booked,
                    'today_evening_booked' => $today_evening_booked,
                    'today_night_booked' => $today_night_booked,

                    'tomorrow_morning_booked' => $tomorrow_morning_booked,
                    'tomorrow_evening_booked' => $tomorrow_evening_booked,
                    'tomorrow_night_booked' => $tomorrow_night_booked,

                    'day_after_tomorrow_morning_booked' => $day_after_tomorrow_morning_booked,
                    'day_after_tomorrow_evening_booked' => $day_after_tomorrow_evening_booked,
                    'day_after_tomorrow_night_booked' => $day_after_tomorrow_night_booked
                ]
                );

    }
}
