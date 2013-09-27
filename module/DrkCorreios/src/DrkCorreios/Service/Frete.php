<?php
namespace DrkCorreios\Service;

use Base\Http\AbstractCurl;

class Frete extends AbstractCurl
{
    protected $service;
    
    
    protected $sCepDestino;
    protected $nVlPeso = 0;
    protected $nCdFormato;
    protected $nVlComprimento = 0;
    protected $nVlAltura = 0;
    protected $nVlLargura = 0;
    protected $nVlDiametro;
    
    
    protected $dados;
    public function __construct($service){
        parent::__construct();
        $this->service = $service;
    	$this->action = 'GET';
    }
    public function calcular()
    {
        unset($this->dados);
        $this->dados[] ="nCdEmpresa=09146920";
        $this->dados[] ="sDsSenha=123456";
        $this->dados[] ="sCepOrigem=01144010";
        $this->dados[] ="sCepDestino=".$this->sCepDestino;
        $this->dados[] ="nVlPeso=".$this->nVlPeso;
        $this->dados[] ="nCdFormato=1";
        $this->dados[] ="nVlComprimento=".$this->nVlComprimento;
        $this->dados[] ="nVlAltura=".$this->nVlAltura;
        $this->dados[] ="nVlLargura=".$this->nVlLargura;
        $this->dados[] ="sCdMaoPropria=n";
        $this->dados[] ="nVlValorDeclarado=0";
        $this->dados[] ="sCdAvisoRecebimento=n";
        $this->dados[] ="nCdServico=41106";
        $this->dados[] ="nVlDiametro=0";
        $this->dados[] ="StrRetorno=xml";
        $this->dados[] ="nIndicaCalculo=3";
        $dados = implode("&", $this->dados);
        $this->uri = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?$dados";
        
        #print $this->uri;
        $content = parent::requisicao(array());
        return $content;
    }
    public function calcularFrete()
    {
        $serviceCarrinho = $this->service->get('CarrinhoCompras\Model\Carrinho');
        $listItens = $serviceCarrinho->lista();
        if(!empty($listItens))
        {
            foreach($listItens AS $produto)
            {
            	for($i=1;$i<=$produto['quantidade']; $i++)
            	{
                	$this->nVlComprimento = $this->nVlComprimento+$produto['produto']->getComprimento();
                	$this->nVlAltura = $this->nVlAltura+$produto['produto']->getAltura();
                	$this->nVlLargura = $this->nVlLargura+$produto['produto']->getLargura();
                	$this->nVlPeso = $this->nVlPeso+$produto['produto']->getPeso();
            	}
            }
        }
        //Formula de calculo de distribuição de massa.
        $total = ($this->nVlComprimento+$this->nVlAltura+$this->nVlLargura)/3;
        $this->nVlComprimento = ceil($total);
        $this->nVlAltura = ceil($total);
        $this->nVlLargura = ceil($total);
        $this->nVlPeso = ceil($this->nVlPeso);
        //final
        //minimo Frete
        if($this->nVlComprimento < 16) $this->nVlComprimento = 16;
        if($this->nVlLargura < 11) $this->nVlLargura = 11;
        if($this->nVlAltura < 2) $this->nVlAltura = 2;
        //fim
        return $this->calcular();
    }
	public function setSCepDestino($sCepDestino) {
		$this->sCepDestino = $sCepDestino;
	}

	public function setNVlPeso($nVlPeso) {
		$this->nVlPeso = $nVlPeso;
	}

	public function setNCdFormato($nCdFormato) {
		$this->nCdFormato = $nCdFormato;
	}

	public function setNVlComprimento($nVlComprimento) {
		$this->nVlComprimento = $nVlComprimento;
	}

	public function setNVlAltura($nVlAltura) {
		$this->nVlAltura = $nVlAltura;
	}

	public function setNVlLargura($nVlLargura) {
		$this->nVlLargura = $nVlLargura;
	}

	public function setNVlDiametro($nVlDiametro) {
		$this->nVlDiametro = $nVlDiametro;
	}

	public function setDados($dados) {
		$this->dados = $dados;
	}

}