<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;

use App\Entity\Category;

use App\Repository\CategoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\Request;

class SidebarController extends AbstractController
{
    private $categoryRepo;

    public function __construct ( CategoryRepository $categoryRepository )
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function sidebarAction(Request $request){

        $categories = $this->categoryRepo->findAll();
    
        return $this->render('components/sidebar.html.twig', ['categories' => $categories]);
    }

    public function navbarAction(Request $request){

        $categories = $this->categoryRepo->findAll();
    
        return $this->render('components/ResponsiveNav.html.twig', ['categories' => $categories]);
    }

}
