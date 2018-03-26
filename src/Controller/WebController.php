<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WebController extends Controller
{
    public function index()
    {
        return $this->render('folder/list.html.twig');
    }
}
