<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Request;



class AdminController extends AbstractController
{
    private $arcticleRepo;
    private $categoryRepo;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository)
    {
        $this->articleRepo = $articleRepository;
        $this->categoryRepo = $categoryRepository;
    }

    public function adminHome(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/admin_home.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminBandeDessinee(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/bande_dessinee.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminCinema(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/cinema.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminEcrits(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/ecrits.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminEnseignement(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/enseignement.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminLivresObjets(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/livres_objets.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminMiseEnScene(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/mise_en_scene.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminPeinture(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/peinture.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminSculptures(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/sculptures.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }

    public function adminTheatre(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
         return $this->render("admin/theatre.html.twig", [ "articles" => $articles, "categories" => $categories]);    
    }



    public function createArticle(Request $request){
        $slugger = new AsciiSlugger();
        $article = new Article();
        $formArticle = $this->createForm(ArticleForm::class, $article);

        $formAnnonce->handleRequest($request);

        if ($formArticle->isSubmitted()) {
            $article = $formArticle->getData();
            $actualTitle = $article->getTitle();
            $slug = strtolower($slugger->slug($actualTitle));
            $article->setSlug($slug);

            $photo = $form['photo']->getData();
            if($photo){
                $originalFileName = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $newUniqueFileName = $originalFileName."-".uniqid().'.'.$photo->guessExtension();
                $photo->move($this->getParameter('uploaded-images'), $newUniqueFileName);
                $article->setPhoto($newUniqueFileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute("admin_home");
        }
        return $this->render("admin/create_article.html.twig", [
            "articleForm" => $form->createView()     
        ]);
    }



    public function createCategory(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryForm::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $category = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute("admin_home");
        }
        return $this->render("admin/create_category.html.twig", ["categoryForm" => $form->createView()]);
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
