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

class CategoryController extends AbstractController
{
    private $articleRepo;
    private $categoryRepo;

    public function __construct ( ArticleRepository $articleRepository, CategoryRepository $categoryRepository )
    {
        $this->articleRepo = $articleRepository;
        $this->categoryRepo = $categoryRepository;
    }

    public function categoryAction($name, Request $request, Security $security, PaginatorInterface $paginator) {

        $page = $request->query->get("page");
        if ($page == 0) {
            $page++;
        }

        $articles = $this->articleRepo->findAll();

        $pageFuture = $paginator->paginate(
            $articles,
            ($request->query->getInt('page', 1)+1),
            8
        );

        $articles = $this->articleRepo->findPaginatedArticles($page); 
        $categories = $this->categoryRepo->findOneBy(["name" => $name]); 

        return $this->render('pages/category.html.twig', [
            "articles" => $articles, 
            "categories" => $categories,
            "name" => $name,
            "from" => $page,
            "pageFuture" => $pageFuture]);
    }
}