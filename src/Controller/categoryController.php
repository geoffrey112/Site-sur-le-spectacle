<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;

use App\Entity\Article;
use App\Entity\Category;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class categoryController extends AbstractController
{
    private $articleRepo;
    private $categoryRepo;

    public function __construct ( ArticleRepository $articleRepository, CategoryRepository $categoryRepository )
    {
        $this->articleRepo = $articleRepository;
        $this->categoryRepo = $categoryRepository;
    }

    public function categoryAction($name) {

        $categories = $this->categoryRepository->findOneBy(["name" => $name]);
        $articles = $this->countryRepository->findAll();

        return $this->render('pages/category.html.twig', ["article" => $articles, "name" => $name, "category" => $categories]);

    }

    

    public function category(Request $request, Security $security, PaginatorInterface $paginator){
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

        return $this->render('pages/category.html.twig', [
            "article" => $articles, 
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }
}