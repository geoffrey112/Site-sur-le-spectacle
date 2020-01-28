<?php

namespace App\Controller;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



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

    public function admin_Home(){
       
        $article = $this->articleRepo->findAll();
        $category =$this->categoryRepo->findAll();
        $user =$this->userRepo->findAll();
         return $this->render("admin/pages/admin_home.html.twig", [ "articles" => $articles, "categories" => $categories, "users" => $users]);    
    }

   
}
