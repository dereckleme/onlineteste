<?php

namespace Produto\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select,
    Zend\Form\Element\Radio,
    Zend\Form\Element\Hidden,
    Zend\Form\Element\File;
use Doctrine\DBAL\Event\SchemaEventArgs;

class Produto extends Form {
	
	public function __construct($name = null) {
		parent::__construct("produto");
		
		$this->setAttribute('method','post')
			 ->setAttribute('id','formProduto')
			 ->setAttribute('class', 'form-horizontal')
		     ->setAttribute('enctype', 'multipart/form-data');
		
		$this->setInputFilter(new ProdutoFilter);
		
		$hidden = new Hidden('ativo');
		$hidden->setValue('1');
		$this->add($hidden);
		
		$id_produto = new Hidden('id');
		$this->add($id_produto);
		
		$select = new Select('inputCategoria');
		$select->setAttribute('id', 'inputCategoria');
		$this->add($select);		
		
		$select2 = new Select('inputSubCategoria');
		$select2->setAttribute('id', 'inputSubCategoria');
		$select2->setValueOptions(array(''=>'--SELECIONE--'));
		$this->add($select2);
		
		
		$this->add(array(
				'name' => 'titulo',
				'options' => array(
					'type' => 'text',
				),
				'attributes' => array(
					'placeholder' => 'Titulo',
					'id' => 'inputTitulo'
				)
		));
		
		$this->add(array(
				'name' => 'valor',
				'options' => array(
					'type' => 'text',
				),
				'attributes' => array(
					'placeholder' => 'R$ 0,00',
					'id' => 'inputValor'
				)
		));
		
		$this->add(array(
		    'name'    =>    'peso',
		    'options' =>    array(
		        'type'    =>    'text',
		    ),
		    'attributes'   =>    array(
		        'placeholder' => '0.000',
		        'id' => 'inputPeso'
		    )
		));
		
		$this->add(array(
			'name'    =>    'comprimento',
			'options' =>    array(
				'type'    =>    'text'
			),
			'attributes'   =>    array(
				'placeholder' => '0',
				'class'       => 'input-medium myConfig'
			)
		));
		
		$this->add(array(
			'name'    =>    'altura',
			'options' =>    array(
				'type'    =>    'text'
			),
			'attributes'   =>    array(
				'placeholder' => '0',
				'class'       => 'input-medium myConfig'
			)
		));
		
		$this->add(array(
			'name'    =>    'largura',
			'options' =>    array(
				'type'    =>    'text'
			),
			'attributes'   =>    array(
				'placeholder' => '0',
				'class'       => 'input-medium myConfig'
			)
		));

		$this->add(array(
			'name'    =>    'quantidade',
			'options' =>    array(
				'type'    =>    'text'
			),
			'attributes'   =>    array(
				'placeholder' => '0',
				'class'       => 'input-mini'
			)
		));
		
		$file = new File('foto');
		$file->setAttribute('multiple', true);		
		$this->add($file);
		
	}
		
	
}