<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class RelatorioController extends Controller
{
	/**
     * @Route("/relatorio", name="getRelatorio")
     * @Method("GET")
     */
    public function getChamadoAction(Request $request)
    {
    	$page = ($request->query->get('page')) ? $request->query->get('page') : 1;

        $chamados = $this->get('ChamadoModel')->search(
            $page,
            $request->query->get('tipo'),
            $request->query->get('valor')
        );

        $limit = 5;
	    $maxPages = ceil($chamados->count() / $limit);
	    $thisPage = $page;

        return $this->render('chamado/relatorio.html.twig', [
        	'chamados'=>$chamados,
        	'limit' => $limit,
        	'maxPages' => $maxPages,
        	'thisPage' => $thisPage,
        ]);	
    }
}