<?php

namespace App\Controller;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LoginController extends AbstractController
{
    // /**
    //  * @Route("/login", name="login")
    //  */
    // public function index()
    // {
    //     return $this->render('login/index.html.twig', [
    //         'controller_name' => 'LoginController',
    //     ]);
    // }


    /**
     * @Route("/", name="home")
     */
    public function homepage(){
        return $this->render('login/index.html.twig');
    }

    /**
     * @Route("/registration", name="registerHere")
     * @Method({"GET", "POST"})
     */
    public function register(Request $request){
        $user = new Users;
        $form = $this->createFormBuilder($user)->add('FirstName', TextType::class, array('attr' => array('class' => 'form-control')))->add('LastName', TextType::class, array( 'required'=> false,'attr' => array('class' => 'form-control')))
        ->add('Username', TextType::class, array('attr' => array('class' => 'form-control')))->add('Password', TextType::class, array('attr' => array('class' => 'form-control')))->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }


        return $this->render('register.html.twig', array('form' => $form->createView() ));
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils){
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('login/login.html.twig', ['error' => $error, 'last_Username'=> $lastUsername]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(){
        return $this->render('profile.html.twig');
    }
}
