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

    public function cinema(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedAnnonces($page);   

        return $this->render('pages/cinema.html.twig', [
            "article" => $articles, 
            "page" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function adaptationCinema(Request $request, Security $security, PaginatorInterface $paginator){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/adaptation_cinema.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }
    


    public function bandeDessinee(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/bande_dessinee.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function ecrits(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/ecrits.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function enseignements(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/enseignements.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function livresObjets(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/livres-objets.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function miseEnScene(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/mise_en_scene.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function peinture(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/peinture.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function sculptures(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/sculptures.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }



    public function theatre(){
        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            6
        );

        $articles = $this->articleRepo->findPaginatedArticles($page);   

        return $this->render('pages/theatre.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
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
