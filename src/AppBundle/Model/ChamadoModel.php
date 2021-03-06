<?php

namespace AppBundle\Model;


use AppBundle\Model\Model;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Chamado;

use Doctrine\ORM\Tools\Pagination\Paginator;

class ChamadoModel extends Model
{
	public function newChamado( $cliente, $pedido, $inputs )
	{
		$chamado = new Chamado();
        $chamado->setTitulo($inputs['chamado_titulo']);
        $chamado->setObservacao($inputs['chamado_observacao']);
        $chamado->setCliente($cliente);
        $chamado->setPedido($pedido);
		
		return $this->persist("save", $chamado );
	}


	public function search($page, $tipo, $valor )
	{
		$repository = $this->driver->getRepository("AppBundle:Chamado");
		$query = $repository->createQueryBuilder('c');
		
		if ( $tipo == 'email' ) {
			$query->innerJoin('c.cliente', 'cliente');
			$query->where('cliente.email = :email');
			$query->setParameter('email', $valor);	
		}

		if ( $tipo == 'pedido' ) {
			$query->innerJoin('c.pedido', 'pedido');
			$query->where('pedido.id = :id');
			$query->setParameter('id', $valor);	
		}

		$query = $query->getQuery();

		$paginator = $this->paginate($query, $page);
		return $paginator;
	}

	public function paginate($dql, $page = 1, $limit = 5)
	{
	    $paginator = new Paginator($dql);

	    $paginator->getQuery()
	        ->setFirstResult($limit * ($page - 1)) // Offset
	        ->setMaxResults($limit); // Limit

	    return $paginator;
	}
}