<?php

namespace AppBundle\Model;

use AppBundle\Model\Model;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Chamado;

class ClienteModel extends Model
{
	public function newCliente( $inputs )
	{
		$cliente = new Cliente();
        $cliente->setNome($inputs['cliente_nome']);
        $cliente->setEmail($inputs['cliente_email']);
		
		return $this->persist("save", $cliente );
	}

	public function checkCliente( $inputs )
	{
		$repository  = $this->driver->getRepository("AppBundle:Cliente");
        $cliente = $repository->findOneByEmail($inputs['cliente_email']);
        if ( !$cliente ) {
        	$cliente = $this->newCliente($inputs);
        }

        return $cliente;
	}


}