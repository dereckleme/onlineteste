<?php
namespace Produto\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Subcategoria extends AbstractService
{
    protected $categoriaReferenc; //Set Categoria
    
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Produto\Entity\ProdutoSubcategoria";
    }
    public function insert(array $data)
    {
        $this->setTargetEntity("Produto\Entity\ProdutoCategorias");
        $this->setCampo("setCategorias");
        $this->setActionReference($data['eventCategoria']);
        parent::insert($data);
    }	
}