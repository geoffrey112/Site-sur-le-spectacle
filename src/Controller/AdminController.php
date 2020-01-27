<?php

namespace App\Controller;
use App\Entity\Article;

use App\Repository\ArticleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class AdminController extends AbstractController
{
    private $arcticleRepo;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepo = $articleRepository;
    }

    public function admin_Home(Request $request){
       
        $article = $this->articleRepo->findAll();
         return $this->render("admin/pages/admin_home.html.twig", [ "articles" => $articles,]);    
    }

   
}
