<?php
namespace Produto\Entity;
use Doctrine\ORM\EntityRepository;

class PagamentoControleestoqueRepository extends EntityRepository {
    
    
    public function findByIdproduto($idproduto){
        $qb =  $this->createQueryBuilder('e');
        $qb->select('e');
        $qb->where("e.produtoproduto = :id");
        $qb->setParameter('id', $idproduto);
        $query = $qb->getQuery();
        #echo "<pre>", print($query->getDQL()), "</pre>";
        $results = $query->getOneOrNullResult();
        return $results;
    }
    
    
}