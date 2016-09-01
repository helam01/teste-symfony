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
        $chamados = $this->get('ChamadoModel')->search(
            $request->query->get('tipo'),
            $request->query->get('valor')
        );

        return $this->render('chamado/relatorio.html.twig', ['chamados'=>$chamados]);
    }
}