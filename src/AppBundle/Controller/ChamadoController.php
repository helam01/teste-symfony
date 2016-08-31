<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ChamadoController extends Controller
{
    /**
     * @Route("/chamado", name="getChamado")
     * @Method("GET")
     */
    public function getChamadoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('chamado/cadastro.html.twig');
    }


    /**
     * @Route("/chamado", name="postChamado")
     * @Method("POST")
     */
    public function postChamadoAction(Request $request)
    {
        $inputs = $request->request->all();

        dump($inputs); die();
        // replace this example code with whatever you need
        return $this->render('chamado/cadastro.html.twig');
    }
}