<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    public function home()
    {
        return $this->render('home.html.twig');
    }

    public function cinema()
    {
        return $this->render('pages/cinema.html.twig');
    }

    public function adaptationCinema(){
        return $this->render('pages/adaptation_cinema.html.twig');
    }

    public function bandeDessinee(){
        return $this->render('pages/bande_dessinee.html.twig');
    }

    public function ecrits(){
        return $this->render('pages/ecrits.html.twig');
    }

    public function enseignements(){
        return $this->render('pages/enseignement.html.twig');
    }

    public function livresObjets(){
        return $this->render('pages/livres-objets.html.twig');
    }

    public function miseEnScene(){
        return $this->render('pages/mise_en_scene.html.twig');
    }

    public function peinture(){
        return $this->render('pages/peinture.html.twig');
    }

    public function sculptures(){
        return $this->render('pages/sculptures.html.twig');
    }

    public function theatre(){
        return $this->render('pages/theatre.html.twig');
    }
}
