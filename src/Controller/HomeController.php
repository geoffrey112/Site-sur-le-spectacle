<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Article;
use App\Entity\Category;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;

use Symfony\Component\Mailer\MailerInterface ;
use Symfony\Component\Mime\Email;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;


class HomeController extends AbstractController
{

    private $mailer ;
    private $articleRepo;
    private $categoryRepo;

    public function __construct ( MailerInterface $mailer, ArticleRepository $articleRepository, CategoryRepository $categoryRepository )
    {
        $this -> mailer = $mailer ;
        $this->articleRepo = $articleRepository;
        $this->categoryRepo = $categoryRepository;
    }


    public function home(Request $request, \Swift_Mailer $mailer){

        $form = $this->createFormBuilder() 
            ->add('email', EmailType::class)
            ->add('idee', TextType::class)
            ->add('message', TextAreaType::class)
            ->add('envoyer', SubmitType::class)
            ->getForm();
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $message = (new \Swift_Message())
                ->setFrom($contact['email'])
                ->setTo('florian67@neuf.fr')
                ->setSubject($contact['idee'])
                ->setBody($contact['message']);

            $mailer->send($message);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
    
        }
    
        return $this->render('home.html.twig', ['contactForm' => $form->createView()]);
    }
       
}
