<?php

namespace AppBundle\Model;

use Doctrine\ORM\EntityManager;
use AppBundle\Services\Security;
use Doctrine\ORM\Tools\Pagination\Paginator;

class Model
{
	protected $driver;
	protected $entity;
	protected $security;
	protected $paginator;

	public function __construct( EntityManager $database=null, Paginator $paginator=null )
	{
		$this->driver = $database;

		$this->paginator = $paginator;
	}

	public function getEntity()
	{
		return $this->entity;
	}


	protected function persist($option="save", $object=null)
	{
		$object = ($object) ? $object : $this->entity;

		try {
			if ( $option == "save" ) {
				$this->driver->persist( $object );
			}

			if ( $option == "delete" ) {
				$this->driver->remove( $object );
			}

			$this->driver->flush();
			$result = $object;

		} catch (Exception $e) {
			throw new Exception("ERROR 00 [Doctrine persist] : ".$e->getMessage(), 1);
			$result = false;
		}

		return $result;
	}

}