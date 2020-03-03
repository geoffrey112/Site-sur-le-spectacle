<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Notification;
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


    public function home(Request $request, Notification $notification)
    {

        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $this->addFlash('success', 'Votre email est arrivé à bon port, Merci');
        }

         return $this->render('home.html.twig', ['contact' => $form->createView()]);
    }

}
