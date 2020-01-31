<?php

namespace App\Controller;

// use App\Form\ContactFormType;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Symfony\Bundle\SwiftmailerBundle\Command\SendEmailCommand ; 

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{

   

    public function adaptationCinema(){
        return $this->render('pages/adaptation_cinema.html.twig');
    }

    public function bandeDessinee(){
        return $this->render('pages/bande_dessinee.html.twig');
    }

    public function cinema(){
        return $this->render('pages/cinema.html.twig');
    }

    public function ecrits(){
        return $this->render('pages/ecrits.html.twig');
    }

    public function enseignements(){
        return $this->render('pages/enseignement.html.twig');
    }

    public function livresObjets(){
        return $this->render('pages/livres-objets.html.twig');
    }

    public function miseEnScene(){
        return $this->render('pages/mise_en_scene.html.twig');
    }

    public function peinture(){
        return $this->render('pages/peinture.html.twig');
    }

    public function sculptures(){
        return $this->render('pages/sculptures.html.twig');
    }

    public function theatre(){
        return $this->render('pages/theatre.html.twig');
    }



    public function home(Request $request){

        $form = $this->createFormBuilder() 
            ->add('email', EmailType::class)
            ->add('idee', TextType::class)
            ->add('message', TextAreaType::class)
            ->add('envoyer', SubmitType::class)
            ->getForm();
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $this->sendMail($contact);
            $this->addFlash('success', 'Votre message a bien été envoyé !');
    
        }
    
        return $this->render('home.html.twig', ['contactForm' => $form->createView()]);
    }

    public function sendMail($contact) {

        $email = \Swift_Message::con()
            ->setSubject($contact)
            ->setFrom('exemple@free.fr')
            ->setTo('florian67@neuf.fr')
            ->setBody($contact);

            $this->get('mail')->send($email);
    }

    
    
}
