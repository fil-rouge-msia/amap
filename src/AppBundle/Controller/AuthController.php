<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        return new Response('', 401);
    }

    /**
     * @Route("/lost-pass", name="lostPass")
     */
    public function lostPassAction(Request $request)
    {
    	return new Response('', 200);
    }
}
