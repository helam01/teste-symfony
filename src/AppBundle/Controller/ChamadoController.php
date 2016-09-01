<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        # Verifica se o cliente com o email informado existe
        $cliente = $this->get('ClienteModel')->checkCliente($inputs);

        # Verifica se o Pedido com o numero informado existe
        $pedido =$this->get('PedidoModel')->getById($inputs);
        if ( !$pedido ) {
            $this->addFlash('error_pedido', 'Número de Pedido inválido');
            return $this->redirectToRoute('getChamado');
        }

        # Salva um novo chamado
        $chamado = $this->get('ChamadoModel')->newChamado($cliente, $pedido, $inputs);
        if ( $chamado ){
            $this->addFlash('cadastro', 'Cadastro realizado com sucesso.');
        } else {
            $this->addFlash('cadastro', 'Erro ao salvar o chamado.');
        }
        
        return $this->redirectToRoute('getChamado');
    }


    /**
     * @Route("/chamado-ajax", name="postChamadoAjax")
     * @Method("POST")
     */
    public function postChamadoAjaxAction(Request $request)
    {
        $inputs = $request->request->all();

        # Verifica se o cliente com o email informado existe
        $cliente = $this->get('ClienteModel')->checkCliente($inputs);

        # Verifica se o Pedido com o numero informado existe
        $pedido =$this->get('PedidoModel')->getById($inputs);
        if ( !$pedido ) {
            $result = ['status'=>'error', 'message'=>'Número de Pedido inválido'];
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setContent( json_encode($result) );
            return $response;
        }

        # Salva um novo chamado
        $chamado = $this->get('ChamadoModel')->newChamado($cliente, $pedido, $inputs);
        if ( $chamado ){
            $result = ['status'=>'success', 'message'=>'Cadastro realizado com sucesso.'];
        } else {
            $result = ['status'=>'error', 'message'=>'Erro ao salvar o chamado.'];
        }
        
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent( json_encode($result) );
        return $response;
    }
}