<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WebController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('folder/list.html.twig');
    }
}
