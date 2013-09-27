<?php

namespace Produto\Entity;

use Doctrine\ORM\EntityRepository;

class ProdutoProdutosRepository extends EntityRepository {
    protected $slugProduto;
    protected $slugCategoria;
    protected $slugSubcategoria;
    protected $search; 
    protected $item;
    
    
    public function myFindAll(){
        $qb =  $this->createQueryBuilder('i');
    	$qb->select('c');
    	$qb->distinct('c.idcategorias');
    	$qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
    	$qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
    	$query = $qb->getQuery();
    	#echo "<pre>", print($query->getDQL()), "</pre>";
    	$results = $query->getResult();
    	return $results;
    } 
    
    public function detalheProduto()
    {
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->where("s.slugSubcategoria = :slugSub");
        $qb->andWhere("i.slugProduto = :slugProduto");
        $qb->setParameters(array("slugSub" => $this->slugSubcategoria, "slugProduto" => $this->slugProduto));
            $query = $qb->getQuery();
            $results = $query->getOneOrNullResult();
        return $results;
    }
    
    public function produtosRelacionados()
    {
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->where("s.slugSubcategoria = :slugSub");
        $qb->andWhere("i.slugProduto != :slugProduto");
        $qb->setParameters(array("slugSub" => $this->slugSubcategoria, "slugProduto" => $this->slugProduto));
        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }

    public function findByGetVisitados(){
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
        #$qb->where('c.slug = ?1');
        #$qb->setParameter(1, $this->slugCategoria);
        $qb->orderBy('i.acessos', 'DESC');
        $qb->setMaxResults(3);
        $query = $qb->getQuery();
        #echo "<pre>", print($query->getDQL()), "</pre>";
        $results = $query->getResult();
        return $results;
    } 
    
    public function categoriaCountRow(){
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
        $qb->where('c.slug = ?1');
        $qb->setParameter(1, $this->slugCategoria);        
        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }    
    public function productForCategory($maxLimit, $offset){
    	$qb =  $this->createQueryBuilder('i');
    	$qb->select('i');
    	$qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
    	$qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
    	$qb->where('c.slug = ?1');
    	$qb->setParameter(1, $this->slugCategoria);    	
    	$qb->setFirstResult($offset);
        $qb->setMaxResults($maxLimit);
    	$query = $qb->getQuery();
    	#echo "<pre>", print($query->getDQL()), "</pre>";
    	$results = $query->getResult();
    	return $results;
    }
    
    public function subCountRow(){
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
        $qb->where('s.slugSubcategoria = ?1');
        $qb->andWhere('c.slug = ?2');
        $qb->setParameter(1, $this->slugSubcategoria);
        $qb->setParameter(2, $this->slugCategoria);
        $query = $qb->getQuery();
        $results = $query->getResult();
        return $results;
    }
    public function productForCatAndSub($maxLimit, $offset){
    	$qb =  $this->createQueryBuilder('i');
    	$qb->select('i');
    	$qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
    	$qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
    	$qb->where('s.slugSubcategoria = ?1');
    	$qb->andWhere('c.slug = ?2');    	
    	$qb->setParameter(1, $this->slugSubcategoria);
    	$qb->setParameter(2, $this->slugCategoria); 
    	$qb->setFirstResult($offset);
    	$qb->setMaxResults($maxLimit);
    	$query = $qb->getQuery();
    	$results = $query->getResult();
    	return $results;
    }
    
    public function buscaProdutosAutoComplete(){
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i.titulo, s.nome, c.nome as categoriNome');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
        $qb->where($qb->expr()->like('s.nome', '?1'));
        $qb->orWhere($qb->expr()->like('c.nome', '?2'));
        $qb->orWhere($qb->expr()->like('i.titulo', '?3'));        
        $qb->setParameter(1, "%$this->search%");
        $qb->setParameter(2, "%$this->search%");
        $qb->setParameter(3, "%$this->search%");
        $query = $qb->getQuery();        
        $results = $query->getResult();
        #echo "<pre>", print($query->getDQL()), "</pre>";
        return $results;        
    } 

    public function resultadoBuscaRows($order=null){
    	$qb =  $this->createQueryBuilder('i');
    	$qb->select('i');
    	$qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
    	$qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
    
    	if($this->search)
    	{
        	$qb->where($qb->expr()->like('s.nome', '?1'));
        	$qb->orWhere($qb->expr()->like('c.nome', '?2'));
        	$qb->orWhere($qb->expr()->like('i.titulo', '?3'));
        	$qb->setParameter(1, "%$this->search%");
        	$qb->setParameter(2, "%$this->search%");
        	$qb->setParameter(3, "%$this->search%");
    	}
    	if($this->item)
    	{
    		$qb->where('s.slugSubcategoria = ?1');
    		$qb->orWhere('c.slug = ?2');
    		$qb->orWhere('i.slugProduto = ?3');
    		$qb->setParameter(1, $this->item);
    		$qb->setParameter(2, $this->item);
    		$qb->setParameter(3, $this->item);
    	}
    	if($order == 'alfabetica')
    	{
    	    $qb->orderBy('i.titulo');
    	}
    	if($order == 'menor_preco')
    	{
    	    $qb->orderBy('i.valor');
    	}
    	if($order == 'maior_preco')
    	{
    	    $qb->orderBy('i.valor', 'DESC');
    	}
    	
    	$query = $qb->getQuery();    	
    	$results = $query->getResult();
    	return $results;
    }    
    public function resultadoBusca($order=null, $maxLimit, $offset){
        $qb =  $this->createQueryBuilder('i');
        $qb->select('i');
        $qb->innerJoin('Produto\Entity\ProdutoSubcategoria', 's', 'WITH', 'i.produtosubcategoria = s.idsubcategoria');
        $qb->innerJoin('Produto\Entity\ProdutoCategorias', 'c', 'WITH', 's.categorias = c.idcategorias');
        
        if($this->search)
        {
            $qb->where($qb->expr()->like('s.nome', '?1'));
            $qb->orWhere($qb->expr()->like('c.nome', '?2'));
            $qb->orWhere($qb->expr()->like('i.titulo', '?3'));            
            $qb->setParameter(1, "%$this->search%");
            $qb->setParameter(2, "%$this->search%");
            $qb->setParameter(3, "%$this->search%");
        }
        if($this->item)
        {
            $qb->where('s.slugSubcategoria = ?1');
            $qb->orWhere('c.slug = ?2');
            $qb->orWhere('i.slugProduto = ?3');
            $qb->setParameter(1, $this->item);
            $qb->setParameter(2, $this->item);
            $qb->setParameter(3, $this->item);           
        }
        if($order == 'alfabetica')
        {
        	$qb->orderBy('i.titulo');
        }
        if($order == 'menor_preco')
        {
            $qb->orderBy('i.valor');
        }
        if($order == 'maior_preco')
        {
            $qb->orderBy('i.valor', 'DESC');
        }     

        $qb->setFirstResult($offset);
        $qb->setMaxResults($maxLimit);
        $query = $qb->getQuery();
        #echo "<pre>", print($query->getDQL()), "</pre>";
        $results = $query->getResult();
        return $results;
    }
    
	public function setSlugProduto($slugProduto) {
		$this->slugProduto = $slugProduto;
	}

	public function setSlugCategoria($slugCategoria) {
		$this->slugCategoria = $slugCategoria;
	}

	public function setSlugSubcategoria($slugSubcategoria) {
		$this->slugSubcategoria = $slugSubcategoria;
	}
	
	public function setSearch($search) {
		$this->search = $search;
	}

	public function setItem($item) {
		$this->item = $item;
	}
    
	
}