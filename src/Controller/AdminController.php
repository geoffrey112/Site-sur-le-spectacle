<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

use App\Form\CategoryFormType;
use App\Form\ArticleFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Request;



class AdminController extends AbstractController
{
    private $arcticleRepo;
    private $categoryRepo;
    private $userRepo;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->articleRepo = $articleRepository;
        $this->categoryRepo = $categoryRepository;
        $this->userRepo = $userRepository;
    }

    public function adminHome(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
        $user =$this->userRepo->findAll();
         return $this->render("admin/admin_home.html.twig", [ "articles" => $article, "categories" => $category, "users" =>$user]);    
    }

    public function adminBandeDessinee(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/bande_dessinee.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminCinema(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/cinema.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminEcrits(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/ecrits.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminEnseignement(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/enseignement.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminLivresObjets(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/livres_objets.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminMiseEnScene(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/mise_en_scene.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminPeinture(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/peinture.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminSculptures(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/sculptures.html.twig", [ "articles" => $article, "categories" => $category]);    
    }

    public function adminTheatre(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/page/theatre.html.twig", [ "articles" => $article, "categories" => $category]);    
    }



    public function createArticle(Request $request){
        $slugger = new AsciiSlugger();
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $article = $form->getData();

            $actualTitle = $article->getTitle();
            $slug = strtolower($slugger->slug($actualTitle));
            $article->setSlug($slug);

            $user = $this->userRepo->findOneBy(['email' => $security->getUser()->getUsername()]);
            $article->setUser($user);

            $photo = $form['photo']->getData();
            if($photo){
                $originalFileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $newUniqueFileName = $originalFileName."-".uniqid().'.'.$photo->guessExtension();
                $photo->move($this->getParameter('uploaded-images'), $newUniqueFileName);
                $article->setPhoto($newUniqueFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute("admin_home");
        }
        return $this->render("admin/page/create_article.html.twig", [
            "articleForm" => $form->createView()     
        ]);
    }



    public function updateArticle(Request $request, $id)
    {
        $slugger = new AsciiSlugger();
        $article = $this->articleRepo->find($id);
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $article = $form->getData();

            $actualTitle = $article->getTitle();
            $slug = strtolower($slugger->slug($actualTitle));
            $article->setSlug($slug);
           
            $user = $this->userRepo->findOneBy(['email' => $security->getUser()->getUsername()]);
            $article->setUser($user);


            $photo = $form['photo']->getData();
            if($photo){
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $newUniqueFileName = $originalFileName."-".uniqid().'.'.$photo->guessExtension();
                $photo->move($this->getParameter('uploaded-images'), $newUniqueFileName);
                $article->setImage($newUniqueFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute("admin_home");
        }

        return $this->render('admin/page/update_article.html.twig', ["articleForm" => $form->createView()]);

    }



    public function createCategory(Request $request)
    {
        $slugger = new AsciiSlugger();
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $category = $form->getData();

            $actualName = $category->getName();
            $slug = strtolower($slugger->slug($actualName));
            $category->setSlug($slug);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute("admin_home");
        }
        return $this->render("admin/page/create_category.html.twig", ["categoryForm" => $form->createView()]);
    }



    public function deleteArticle($idArticle)
    {
        $article = $this->articleRepo->findOneById($idArticle);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        return $this->redirectToRoute("admin_home");
    }

   
}
