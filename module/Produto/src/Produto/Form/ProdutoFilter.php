<?php
namespace Produto\Form;

use Zend\InputFilter\InputFilter;

class ProdutoFilter extends InputFilter {
    
    public function __construct(){
    	
        $this->add(array(
            'name'    => 'inputCategoria',
            'required'   => true,
            'filters'    => array(
        		array('name'=>'Int')
            ),
        ));

        $this->add(array(
        	'name'    => 'inputSubCategoria',
        	'required'   => true,
        	'filters'    => array(
        		array('name'=>'Int')
        	),
        ));
        
        $this->add(array(
            'name'       => 'titulo',
            'required'   => true,
            'filters'    => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name'     => 'NotEmpty',
                    'options'  => array(
                        'messages' => array('isEmpty'=>'Favor preencher corretamente o campo titulo')
                    )    
                )
            )
        ));
        
       $this->add(array(
    		'name'       => 'valor',
    		'required'   => true,
    		'filters'    => array(
				array('name'=>'StripTags'),
				array('name'=>'StringTrim')
    		)
        ));
        
        $this->add(array(
    		'name'       => 'peso',
    		'required'   => true,
    		'filters'    => array(
    				array('name'=>'StripTags'),
    				array('name'=>'StringTrim')
    		)
        ));
        
        $this->add(array(
    		'name'       => 'comprimento',
    		'required'   => true,
    		'filters'    => array(
    				array('name'=>'StripTags'),
    				array('name'=>'StringTrim')
    		)
        ));
        
        $this->add(array(
    		'name'       => 'altura',
    		'required'   => true,
    		'filters'    => array(
    				array('name'=>'StripTags'),
    				array('name'=>'StringTrim')
    		)
        ));
        
        $this->add(array(
    		'name'       => 'largura',
    		'required'   => true,
    		'filters'    => array(
    				array('name'=>'StripTags'),
    				array('name'=>'StringTrim')
    		)
        ));
        
        $this->add(array(
    		'name'       => 'foto',
    		'required'   => true,
    		'filters'    => array(
    				array('name'=>'StripTags'),
    				array('name'=>'StringTrim')
    		)
        ));
        
    }
    
}