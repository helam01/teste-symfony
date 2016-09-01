<?php

namespace AppBundle\Model;

use AppBundle\Model\Model;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Chamado;

class PedidoModel extends Model
{
	public function getById( $inputs )
	{
		$repository  = $this->driver->getRepository("AppBundle:Pedido");
        return $repository->find($inputs['pedido_numero']);
	}



}